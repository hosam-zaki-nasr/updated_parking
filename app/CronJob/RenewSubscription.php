<?php

namespace App\CronJob;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\Garage;
use App\Models\Subscription;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenewSubscription
{
    public static function renewSubscriptions(): void
    {
        // نوع حساب العميل
        $customerAccountType = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', UserAccountType::CUSTOMER['code'])
            ->first();

        if (!$customerAccountType) {
            // Log::error('Customer account type not found');
            return;
        }

        $today = Carbon::now()->startOfDay();

        // 1. نجيب كل المستخدمين اللي عندهم رصيد
        $users = User::where('account_type_id', $customerAccountType->id)
            ->where('current_balance', '>', 0)
            ->get();

        foreach ($users as $user) {
            self::processUserSubscriptions($user, $today);
        }

        // Log::info("Subscription renewal process completed for " . count($users) . " users");
    }

    protected static function processUserSubscriptions(User $user, Carbon $today): void
    {
        // 2. نجيب اشتراكات المستخدم المنتهية المفعل فيها التجديد التلقائي
        $subscriptions = Subscription::with('garage')
            ->where('user_id', $user->id)
            ->where('auto_renew', true)          // ✅ التجديد التلقائي مفعل
            ->whereNull('deleted_at')
            ->where('ends_at', '<=', $today)     // ✅ انتهى في الماضي
            ->orderBy('ends_at', 'asc')          // الأقدم أولاً
            ->get();

        if ($subscriptions->isEmpty()) {
            // Log::info("User {$user->id} has no expired subscriptions with auto-renew");
            return;
        }

        // Log::info("User {$user->id} has {$subscriptions->count()} expired subscriptions to process");

        // 3. نجيب الرصيد الحالي للمستخدم
        $currentBalance = $user->fresh()->current_balance;

        foreach ($subscriptions as $subscription) {
            // لو الرصيد خلص، نتوقف
            if ($currentBalance <= 0) {
                // Log::info("User {$user->id} has no remaining balance");
                break;
            }

            self::processSingleSubscription($subscription, $user, $today, $currentBalance);

            // نحدث الرصيد بعد كل عملية
            $currentBalance = $user->fresh()->current_balance;
        }
    }

    protected static function processSingleSubscription(
        Subscription $subscription,
        User $user,
        Carbon $today,
        float $currentBalance
    ): void {
        $garage = $subscription->garage;

        if (!$garage) {
            // Log::warning("Garage not found for subscription {$subscription->id}");
            return;
        }

        // 4. نجيب سعر اشتراك الجراج
        $subscriptionPrice = $garage->subscription_price ?? 0;

        if ($subscriptionPrice <= 0) {
            // Log::warning("Garage {$garage->id} has no subscription price set");
            return;
        }

        // 5. نتحقق إذا الرصيد يكفي لسعر اشتراك الجراج
        if ($currentBalance < $subscriptionPrice) {
            // Log::info("User {$user->id} has insufficient balance ({$currentBalance}) for garage {$garage->id} (needs {$subscriptionPrice})");
            return;
        }

        // 6. نتأكد مفيش اشتراك جديد بالفعل لنفس الجراج
        $existingNewSubscription = Subscription::where('user_id', $user->id)
            ->where('garage_id', $garage->id)
            ->where('starts_at', '>', $subscription->ends_at) // اشتراك جديد بعد تاريخ انتهاء القديم
            ->whereNull('deleted_at')
            ->first();

        if ($existingNewSubscription) {
            // Log::info("User {$user->id} already has a new subscription ({$existingNewSubscription->id}) for garage {$garage->id}");

            // نحذف الاشتراك القديم
            $subscription->delete();
            // Log::info("Deleted old subscription {$subscription->id} because new subscription already exists");
            return;
        }

        // 7. عملية التجديد
        DB::transaction(function () use ($subscription, $user, $garage, $subscriptionPrice, $today) {
            $endsAt = $subscription->ends_at;

            // نحسب أيام التأخير
            $delayDays = max(0, $today->diffInDays($endsAt, false));

            // نحدد تاريخ البدء
            // لو انتهى اليوم أو بالأمس، نبدأ من اليوم
            // لو تأخر كثيراً، ممكن نبدأ من تاريخ الانتهاء أو اليوم (حسب سياسة الشركة)
            $startDate = $today;

            // لو تأخر أكثر من يوم، ممكن تبدأ من تاريخ الانتهاء
            // $startDate = $delayDays > 1 ? $endsAt : $today;

            // تاريخ الانتهاء الجديد (شهر من تاريخ البدء)
            $newEndsAt = $startDate->copy()->addMonth();

            // 8. إنشاء اشتراك جديد
            $newSubscription = Subscription::create([
                'garage_id' => $garage->id,
                'user_id' => $user->id,
                'creator_id' => $user->id,
                'starts_at' => $startDate,
                'ends_at' => $newEndsAt,
                'amount' => $subscriptionPrice,
                'auto_renew' => true, // نستمر في التجديد التلقائي
            ]);

            // 9. خصم سعر اشتراك الجراج من رصيد المستخدم
            $user->decrement('current_balance', $subscriptionPrice);

            // 10. حذف الاشتراك القديم (حذف ناعم)
            $subscription->delete();

            // Log::info("✅ Subscription RENEWED:
            //     User: {$user->id} ({$user->current_balance} balance remaining)
            //     Garage: {$garage->id} ({$garage->name})
            //     Old subscription: {$subscription->id} (expired {$delayDays} days ago)
            //     New subscription: {$newSubscription->id}
            //     Amount: {$subscriptionPrice}
            //     Period: {$startDate->format('Y-m-d')} to {$newEndsAt->format('Y-m-d')}
            // ");
        });
    }
}

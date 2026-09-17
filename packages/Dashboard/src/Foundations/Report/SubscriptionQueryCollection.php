<?php

namespace Dashboard\Foundations\Report;

use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionQueryCollection
{
    public static function searchAllSubscriptionReports(
        $user_id = -1,
        $garage_id = -1,
        $starts_at = -1,
        $ends_at = -1,
        $is_active = -1,
        $is_deleted = -1,
    ) {
        $query = Subscription::query();

        // FIRST: Apply soft delete filters (before other conditions)
        if ($is_deleted === true) {
            $query->onlyTrashed();  // Only soft-deleted records
        } elseif ($is_deleted === false) {
            $query->withoutTrashed();  // Only active records (default)
        } else {
            $query->withTrashed();  // All records including trashed
        }

        // THEN: Apply other filters
        if ($user_id && $user_id != -1) {
            $query->where('user_id', $user_id);
        }

        if ($garage_id && $garage_id != -1) {
            $query->where('garage_id', $garage_id);
        }

        if ($starts_at && $starts_at != -1 && $ends_at && $ends_at != -1) {
            $query->whereBetween('starts_at', [
                Carbon::create($starts_at),
                Carbon::create($ends_at)->endOfDay()
            ])->whereBetween('ends_at', [
                Carbon::create($starts_at),
                Carbon::create($ends_at)->endOfDay()
            ]);
        } else if ($starts_at && $starts_at != -1) {
            $query->whereBetween('starts_at', [
                Carbon::create($starts_at)->startOfDay(),
                Carbon::create(3000, 01, 01)
            ]);
        } else if ($ends_at && $ends_at != -1) {
            $query->whereBetween('ends_at', [
                Carbon::create(1900, 01, 01),
                Carbon::create($ends_at)->endOfDay()
            ]);
        }

        if ($is_active === true) {
            $query->where('ends_at', '>=', Carbon::now()->startOfDay());
        } elseif ($is_active === false) {
            $query->where('ends_at', '<', Carbon::now()->endOfDay());
        }

        return $query->orderBy('created_at', 'DESC');
    }
}

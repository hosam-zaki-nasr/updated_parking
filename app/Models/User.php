<?php

namespace App\Models;

use App\Notifications\ResetPasswordEmail;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        'qr_id',

        'name',

        'email',

        'password',

        'phone',

        'gender',

        'birthday',

        'image_url',

        'api_token',

        'email_verification_code',

        'mobile_verification_code',

        'reset_password_code',

        'account_type_id',

        'garage_id',

        'country_id',

        'governorate_id',

        'customer_id',

        'file_id',

        'creator_id',

        'email_verified_at',

        'mobile_verified_at',

        'notification_status',

        'current_balance',
    ];

    protected $hidden = [

        'password',

        'api_token',

        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',

        'notification_status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {

            static::creating(function ($model) {
                $model->creator_id = auth()->id();
            });
        }

        static::creating(function ($model) {
            $model->qr_id = "DI" . $model->id;
        });
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendResetPasswordCodeNotification()
    {
        $this->notify(new ResetPasswordEmail);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'governorate_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'account_type_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(User::class, 'customer_id', 'id');
    }

    public function userChargeOperations(): HasMany
    {
        return $this->hasMany(UserChargeOperation::class, 'user_id', 'id');
    }

    public function notificationTokens(): HasMany
    {
        return $this->hasMany(UserNotificationToken::class, 'user_id', 'id');
    }

    public function parkings(): HasMany
    {
        return $this->hasMany(Parking::class, 'user_id', 'id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'creator_id', 'id')
            ->whereNull('deleted_at');
    }

    public function getHasActiveSubscriptionAttribute(): bool
    {
        // Check if subscriptions are loaded and any is active
        if ($this->relationLoaded('subscriptions')) {
            return $this->subscriptions
                ->where('ends_at', '>', Carbon::now())
                ->isNotEmpty();
        }

        // Fallback to query if not loaded
        return $this->subscriptions()
            ->where('ends_at', '>', Carbon::now())
            ->exists();
    }
}

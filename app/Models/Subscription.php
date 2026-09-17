<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'garage_id',
        'starts_at',
        'ends_at',
        'amount',
        'auto_renew',
        'user_id',
        'creator_id',
    ];

    protected $appends = [
        'remaining_days',
        'is_ended',
    ];

    // REMOVED: protected $dates (deprecated in Laravel)
    // Using $casts instead

    protected $casts = [
        'starts_at' => 'datetime:Y-m-d H:i',
        'ends_at' => 'datetime:Y-m-d H:i',
        'auto_renew' => 'boolean',
        // Add these to handle Carbon instances properly
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Only set if not already provided and user is authenticated
            if (Auth::check() && !$model->user_id) {
                $model->user_id = Auth::id();
            }

            if (Auth::check() && !$model->creator_id) {
                $model->creator_id = Auth::id();
            }
        });
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function getRemainingDaysAttribute(): string
    {
        // Return formatted date as in your original code
        return trans('general.expires_at') . ' : ' . $this->ends_at->format('Y-m-d');
    }

    public function getIsEndedAttribute(): bool
    {
        return $this->ends_at->endOfDay()->isPast();
    }

    // Helper method to check if subscription is expiring soon
    public function isExpiringSoon(int $days = 1): bool
    {
        return Carbon::now()->startOfDay()
            ->diffInDays($this->ends_at->endOfDay(), false) <= $days;
    }
}

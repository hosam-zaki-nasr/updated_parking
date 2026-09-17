<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    use HasFactory, HasUuids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_code',
        'module_prefix',
        'module_name',
        'module_name_ar',

        'event_id',
        'event_action',
        'event_table_name',
        'event_code',
        'event_prefix',
        'event_name',
        'event_name_ar',
        'event_content',
        'event_content_ar',
        'event_reference_code',

        'data',

        'actor_id',
        'occurred_at',
        'watched_at',
    ];

    protected $casts = [

        'occurred_at' => 'datetime',

        'watched_at' => 'datetime'

    ];

    final public static function loadNotification($notification_id)
    {
        return
            Notification::where('id', $notification_id)
            ->where('archived_at', null)
            ->first();
    }

    final public static function getById($id)
    {
        return Notification::where('id', $id)->first();
    }

    /**
     * Get the actor that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id', 'id');
    }

    /**
     * Get all of the recipients for the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipients(): HasMany
    {
        return $this->hasMany(NotificationRecipient::class, 'notification_id', 'id');
    }

    /**
     * Get the recipient associated with the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipient(): HasOne
    {
        return $this->hasOne(NotificationRecipient::class, 'notification_id', 'id');
    }
}

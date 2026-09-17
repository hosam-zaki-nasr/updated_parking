<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationRecipient extends Model
{
    use HasFactory, HasUuids;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id',
        'recipient_id',
        'watched_at',
        'stopped_at'
    ];

    protected $casts = [

        'watched_at' => 'datetime',

        'stopped_at' => 'datetime'
    ];

    protected $appends = ['watched'];

    public function getWatchedAttribute()
    {
        return $this->watched_at ? true : false;
    }

    final public static function loadNotificationRecipient($notification_recipient_id)
    {
        return
            NotificationRecipient::where('id', $notification_recipient_id)
            ->where('stopped_at', null)
            ->first();
    }

    final public static function getById($id)
    {
        return NotificationRecipient::where('id', $id)->first();
    }


    /**
     * Get the notification that owns the NotificationEntity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    /**
     * Get the user that owns the NotificationRecipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }
}

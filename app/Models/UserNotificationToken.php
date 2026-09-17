<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotificationToken extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'user_id',
        'notification_token',
        'current_user_token',
        'type_id'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function notificationType(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'type_id', 'id');
    }
}

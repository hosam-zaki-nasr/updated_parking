<?php

namespace App\Models;

use App\Foundations\LookupType\RequestDriverStatusCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestDriver extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'details',

        'repeated_times',

        'longitude',

        'latitude',

        'garage_id',

        'user_id',

        'driver_id',

        'creator_id',

        'status_id',

        'type_id',

        'parking_id',

        'canceler_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->user_id = auth()->id();

            $model->creator_id = auth()->id();

            $model->status_id = RequestDriverStatusCollection::pending()->id;

            $model->repeated_times = 1;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function canceler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'canceler_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'status_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'type_id', 'id');
    }

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class, 'parking_id', 'id');
    }
}

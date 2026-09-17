<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'starts_at',

        'ends_at',

        'force_closed',

        'total_cost',

        'hour_cost',

        'free_hours',

        'garage_id',

        'user_id',

        'car_id',

        'longitude',

        'latitude',


        'start_confirmed_at',

        'start_driver_id',

        'end_driver_id',

        ////////////

        "QueryDate",

        "VehicleClass",

        "IdentificationType",

        "IdentificationNumber",

        "ClientId",

        "SiteNumber",

        "ParcNumber",

        "ZoneNumber",

        "EquipmentNumber",

        "EntryDate",

        "TicketId",

        /////////////
        "ExitDate",

        "Amount",

        "ClosingType"
    ];

    protected $casts = [

        'starts_at' => 'datetime:Y-m-d H:i',

        'ends_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function requestDriver(): HasOne
    {
        return $this->hasOne(RequestDriver::class, 'parking_id');
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function startDriver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'start_driver_id');
    }

    public function endDriver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'end_driver_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function parkingFiles(): HasMany
    {
        return $this->hasMany(ParkingFile::class, 'parking_id');
    }
}

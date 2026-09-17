<?php

namespace App\Models;

use App\Constants\HasLookupType\CountryType;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'garage_id',

        'name',

        'name_ar',

        'site_number',

        'free_hours',

        'hour_cost',

        'vip_cost',

        'valet_cost',

        'fine_cost',

        'subscription_price',

        'max_car_count',

        'longitude',

        'latitude',

        'country_id',

        'governorate_id',

        'type_id',

        'open_at',

        'close_at',

        'creator_id',
    ];

    protected $appends = [

        'reserved_car_count',

        'available_car_count',

        'is_available',
    ];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {

            static::creating(function ($model) {

                $model->creator_id = auth()->id();
            });
        }
    }

    public function parking(): HasMany
    {
        return $this->hasMany(Parking::class, 'garage_id');
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'type_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')
            ->where('type', CountryType::COUNTRY['code']);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'governorate_id', 'id')
            ->where('type', CountryType::GOVERNORATE['code']);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    //attributes
    public function getReservedCarCountAttribute()
    {
        return $this->parking->where('ends_at', null)->count();
    }

    public function getAvailableCarCountAttribute()
    {
        return $this->max_car_count - $this->reserved_car_count;
    }

    public function getIsAvailableAttribute()
    {
        return $this->available_car_count ? true :  false;
    }
}

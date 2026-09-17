<?php

namespace App\Models;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',

        'name_ar',

        'phone_code',

        'flag',

        'prefix',

        'longitude',

        'latitude',

        'type',

        'country_id',

        'governorate_id',

        'city_id',

        'zone_id',

        'creator_id',

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->creator_id = auth()->id();
        });
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  app()->getLocale() == "en" ? $this->attributes['name'] : $this->attributes['name_ar'],
        );
    }

    final static public function loadCountry($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::COUNTRY['code'])
            ->first();
    }

    final static public function loadGovernorate($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->first();
    }

    final static public function loadCity($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::CITY['code'])
            ->first();
    }

    final static public function loadZone($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::ZONE['code'])
            ->first();
    }

    final static public function loadDistrict($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::DISTRICT['code'])
            ->first();
    }

    /* HasMany */
    public function governorates(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::GOVERNORATE['code']);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::CITY['code']);
    }

    public function zones(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::ZONE['code']);
    }

    public function districts(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::DISTRICT['code']);
    }

    /* BelongsTo */
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'city_id', 'id')
            ->where('type', CountryType::CITY['code']);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'zone_id', 'id')
            ->where('type', CountryType::ZONE['code']);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}

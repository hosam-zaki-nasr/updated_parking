<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'name',

        'number',

        'text',

        'full_number',

        'details',

        'random_code',

        'file_id',

        'car_color_id',

        'car_type_id',

        'creator_id',
    ];

    protected static function boot()
    {
        parent::boot();


        static::creating(function ($model) {
            if (auth()->check()) {
                $model->creator_id = auth()->id();
            }

            $model->random_code = Str::random(10);
        });
    }

    public static function loadByRandomCode($code)
    {

        return Car::where('random_code', $code)->first();
    }

    public static function loadByNumber($number)
    {

        return Car::where('number', $number)->first();
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function carColor(): BelongsTo
    {
        return $this->belongsTo(CarColor::class, 'car_color_id', 'id');
    }

    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'title',

        'details',

        'amount',

        'link',

        'file_id',

        'creator_id',

        'client_name',

        'client_phone',

        'client_field',

        'starts_at',

        'ends_at',

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

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}

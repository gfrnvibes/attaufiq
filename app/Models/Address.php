<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'dusun',
        'rt',
        'rw',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'postal_code',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            \Illuminate\Support\Facades\Log::debug('Membuat alamat baru untuk:', [
                'addressable_type' => $model->addressable_type,
                'addressable_id' => $model->addressable_id,
                'data' => $model->toArray()
            ]);
        });

        static::created(function ($model) {
            \Illuminate\Support\Facades\Log::debug('Alamat berhasil dibuat ID:', ['id' => $model->id]);
        });
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regency extends Model
{
    protected $fillable = ['id', 'province_id', 'name'];
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    public $timestamps = false;

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'regency_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'regency_id');
    }
}

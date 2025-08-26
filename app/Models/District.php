<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    protected $fillable = ['id', 'regency_id', 'name'];
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    public $timestamps = false;

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'district_id');
    }
}

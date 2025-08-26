<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = ['id', 'name'];
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    public $timestamps = false;

    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class, 'province_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'province_id');
    }
}

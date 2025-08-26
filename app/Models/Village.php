<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Village extends Model
{
    protected $fillable = ['id', 'district_id', 'name'];
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    public $timestamps = false;

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'village_id');
    }
}

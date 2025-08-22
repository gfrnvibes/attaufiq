<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $fillable = [
        'web_name',
        'web_tagline',
        'web_description',
        'sambutan_kepsek',
        'visi',
        'misi',
        'sejarah',
    ];

    protected $casts = [
        'misi' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

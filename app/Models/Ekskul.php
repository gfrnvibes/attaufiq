<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ekskul extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'nama_ekskul',
        'deskripsi_ekskul',
    ];
}

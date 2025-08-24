<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Prestasi extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'nama_prestasi',
        'deskripsi_prestasi',
    ];
}

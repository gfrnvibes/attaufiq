<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Fasilitas extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'nama_fasilitas',
        'deskripsi_fasilitas',
    ];
}

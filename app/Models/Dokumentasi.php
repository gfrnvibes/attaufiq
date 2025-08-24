<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Dokumentasi extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = [
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'tgl_kegiatan',
    ];
}

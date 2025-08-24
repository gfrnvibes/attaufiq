<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Guru extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'mata_pelajaran_id',
        'nip',
        'nuptk',
        'email',
        'phone',
        'jabatan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajarans')->withTimestamps();
    }
}

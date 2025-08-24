<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $fillable = ['nama_mapel', 'deskripsi_mapel'];

    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_mata_pelajarans')->withTimestamps();
    }
}

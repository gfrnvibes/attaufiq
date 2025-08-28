<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTuaSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'nomor_kartu_keluarga',
        'tipe',
        'nama',
        'nik',
        'pendidikan',
        'pekerjaan',
        'no_hp',
        'keadaan',
        'hubungan',
    ];

    // Relasi dengan Siswa
    public function pendaftaranSiswa()
    {
        return $this->belongsTo(PendaftaranSiswa::class, 'pendaftaran_siswa_id');
    }
}

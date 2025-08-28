<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PendaftaranSiswa extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'asal_sekolah',
        'nisn',
        'anak_ke',
        'jumlah_saudara_kandung',
        'no_hp',
        'prestasi',
    ];

    protected $casts = [
        'prestasi' => 'json',
    ];

    // Relasi dengan Orang Tua Siswa
    public function orangTuaSiswa()
    {
        return $this->hasOne(OrangTuaSiswa::class, 'siswa_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file_siswa')
            ->singleFile();
    }

}
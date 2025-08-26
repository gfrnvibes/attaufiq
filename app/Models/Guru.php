<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function addresses(): MorphMany
    {
        \Illuminate\Support\Facades\Log::debug('Mengakses relasi addresses untuk guru ID: ' . $this->id);
        return $this->morphMany(Address::class, 'addressable');
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
        $this->addMediaCollection('avatar')
            ->singleFile();
    }
}
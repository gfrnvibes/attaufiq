<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProfilSekolah extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'address',
        'tagline',
        'description',
        'sambutan_kepsek',
        'visi',
        'misi',
        'sejarah',
        'social',
        'static',
    ];

    protected function casts(): array
    {
        return [
            'misi' => 'array',
            'social' => 'array',
            'static' => 'array',
        ];
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
        $this->addMediaCollection('web_logo')
            ->singleFile();
    }
}

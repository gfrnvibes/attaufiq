<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WebSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'web_name',
        'web_tagline',
        'web_description',
        'sambutan_kepsek',
        'visi',
        'misi',
        'sejarah',
    ];

    protected $casts = [
        'misi' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'misi' => 'array',
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
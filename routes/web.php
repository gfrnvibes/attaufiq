<?php

use App\Livewire\Home;
use App\Livewire\Kesiswaan;
use App\Livewire\ProfilMadrasah;
use App\Livewire\PendaftaranSiswa;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

Route::get('/', Home::class)->name('/');

Route::get('ppdb', PendaftaranSiswa::class)->name('ppdb');
Route::get('profil-madrasah', ProfilMadrasah::class)->name('profil-madrasah');
Route::get('kesiswaan', Kesiswaan::class)->name('kesiswaan');

Route::get('/media/{media}', function (Media $media) {
    return response()->file($media->getPath());
})->name('media.show');
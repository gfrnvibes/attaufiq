<?php

use App\Livewire\Home;
use App\Livewire\Kesiswaan;
use App\Livewire\PendaftaranSiswa;
use App\Livewire\ProfilMadrasah;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('/');

Route::get('ppdb', PendaftaranSiswa::class)->name('ppdb');
Route::get('profil-madrasah', ProfilMadrasah::class)->name('profil-madrasah');
Route::get('kesiswaan', Kesiswaan::class)->name('kesiswaan');

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\PeriodePendaftaran;

#[Title('Pendaftaran Peserta Didik Baru')]
class PendaftaranSiswa extends Component
{
    public function render()
    {
        $periodeAktif = PeriodePendaftaran::active()->first();

        return view('livewire.pendaftaran-siswa', [
            'periodeAktif' => $periodeAktif
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WebSetting;
use App\Models\Guru;
use App\Models\Fasilitas;
use App\Models\ProfilSekolah;
use Livewire\Attributes\Title;

#[Title('Profil Madrasah')]
class ProfilMadrasah extends Component
{
    public function render()
    {
        $profil = ProfilSekolah::firstOrFail();
        $gurus = Guru::with('media')->get();
        $fasilitas = Fasilitas::with('media')->get();
        return view('livewire.profil-madrasah', compact('profil', 'gurus', 'fasilitas'));
    }
}

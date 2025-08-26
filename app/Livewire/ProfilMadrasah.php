<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WebSetting;
use App\Models\Guru;
use App\Models\Fasilitas;
use Livewire\Attributes\Title;

#[Title('Profil Madrasah')]
class ProfilMadrasah extends Component
{
    public function render()
    {
        $webSetting = WebSetting::firstOrFail();
        $gurus = Guru::with('media')->get();
        $fasilitas = Fasilitas::with('media')->get();
        return view('livewire.profil-madrasah', compact('webSetting', 'gurus', 'fasilitas'));
    }
}

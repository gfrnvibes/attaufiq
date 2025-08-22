<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WebSetting;
use Livewire\Attributes\Title;

#[Title('Profil Madrasah')]
class ProfilMadrasah extends Component
{
    public function render()
    {
        $webSetting = WebSetting::firstOrFail();
        return view('livewire.profil-madrasah', compact('webSetting'));
    }
}

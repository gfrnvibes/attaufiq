<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Profil Madrasah')]
class Kesiswaan extends Component
{
    public function render()
    {
        return view('livewire.kesiswaan');
    }
}

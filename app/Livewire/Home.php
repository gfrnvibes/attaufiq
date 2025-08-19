<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('MTs At-Taufiq Cisurupan')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}

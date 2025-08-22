<?php

namespace App\Livewire;

use App\Models\WebSetting;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('MTs At-Taufiq Cisurupan')]
class Home extends Component
{
    public function render()
    {
        $webSetting = WebSetting::firstOrFail();

        return view('livewire.home', compact('webSetting'));
    }
}

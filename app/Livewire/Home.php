<?php

namespace App\Livewire;

use App\Models\ProfilSekolah;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('MTs At-Taufiq Cisurupan')]
class Home extends Component
{
    public function render()
    {
        $profilSekolah = ProfilSekolah::firstOrFail();

        // User dengan jabatan Kepala Sekolah
        

        return view('livewire.home', compact('profilSekolah'));
    }
}

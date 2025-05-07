<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class InputTanggal extends Component
{
    #[Modelable] //agar model bisa diakses dari luar
    public string $tanggal = '';

    public string $class = '';
    public function render()
    {
        return view('livewire.components.input-tanggal');
    }
}

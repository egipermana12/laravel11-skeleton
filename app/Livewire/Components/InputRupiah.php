<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class InputRupiah extends Component
{
    #[Modelable] //agar model bisa diakses dari luar
    public int $harga = 0;

    public string $class = '';

    public function render()
    {
        return view('livewire.components.input-rupiah');
    }
}

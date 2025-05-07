<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Illuminate\Support\Collection;

class SelectCombo extends Component
{
    #[Modelable]
    public $selectedValue = null;

    public Collection $selectOpsi;
    public bool $disable = false;

    public string $textAtas = 'Pilih';
    public string $class = '';

    public function render()
    {
        return view('livewire.components.select-combo');
    }
}

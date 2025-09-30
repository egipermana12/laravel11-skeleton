<?php

namespace App\Livewire\Components;

use App\Models\Akun;
use Livewire\Attributes\Modelable;

use Livewire\Component;

class SelectAkun extends Component
{
    #[Modelable]
    public $selectedValue; // wire:model binding
    public $options = [];

    public string $class = '';


    protected $listeners = ['akun-saved' => 'loadOptions'];

    public function mount($selectedValue = null)
    {
        $this->selectedValue = $selectedValue;
        $this->loadOptions();
    }
    public function loadOptions()
    {
        $query = Akun::select('akun_id', 'kd_akun1', 'nama_akun');
        $this->options = $query->orderBy('kd_akun1', 'asc')
            ->where('kd_akun2', '0')
            ->where('kd_akun3', '00')
            ->orderBy('nama_akun', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.components.select-akun');
    }
}

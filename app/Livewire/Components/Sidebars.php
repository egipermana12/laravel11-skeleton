<?php

namespace App\Livewire\Components;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Menu;

class Sidebars extends Component
{
    public Collection $menus;

    public  function mount(): void {
        $call = new Menu();
        $this->menus = $call->tree();
    }

    public function render()
    {
        return view('livewire.components.sidebars');
    }
}

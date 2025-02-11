<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Counter extends Component
{
    public function render()
    {
        return view('livewire.counter');
    }
}

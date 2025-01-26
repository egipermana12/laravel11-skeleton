<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment(): int
    {
        return $this->count++;
    }

    public function decrement(): int
    {
        return $this->count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}

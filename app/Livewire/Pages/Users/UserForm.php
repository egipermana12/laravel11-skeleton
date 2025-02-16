<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;

class UserForm extends Component
{
    public $isOpen = false;

    public $listeners = ['openUserForm' => 'openModal'];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.pages.users.user-form');
    }
}

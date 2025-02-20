<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\UserFormAction;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UserForm extends Component
{
    public UserFormAction $form;

    public $isOpen = false;

    public $listeners = ['openUserForm' => 'openModal'];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->form->reset();
        $this->resetErrorBag();
    }

    public function store()
    {
        $save = $this->form->store();
        if($save){
            $this->dispatch('notify', type: 'success', message: 'Berhasil menambahkan data');
            $this->closeModal();
            $this->dispatch('refreshPageUser');
        }else{
            $this->dispatch('notify', type: 'fails', message: 'Gagal menambahkan data');
            $this->closeModal();
            $this->dispatch('refreshPageUser');
        }
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.pages.users.user-form')->with(compact('roles'));
    }
}

<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\UserFormAction;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public UserFormAction $form;

    #[Locked]
    public $id;

    public $openModalEdit = false;

    #[On('openUserEdit')]
    public function openModal(User $id)
    {
        $this->form->setUser($id);
        $this->openModalEdit = true;
    }

    public function update(){}

    public function render()
    {
        $roles = Role::all();
        return view('livewire.pages.users.user-edit')->with(compact('roles'));
    }
}

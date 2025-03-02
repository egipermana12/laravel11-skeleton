<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\UserFormAction;
use App\Models\User;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Lazy]
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

    public function closeModal()
    {
        $this->openModalEdit = false;
        $this->form->reset();
        $this->resetErrorBag();
    }

    public function update(){
        $update = $this->form->update();
        if($update){
            $this->dispatch('notify', type: 'success', message: 'Berhasil mengubah data');
            $this->closeModal();
            $this->dispatch('refreshPageUser');
        }else{
            $this->dispatch('notify', type: 'fails', message: 'Gagal mengubah data');
            $this->closeModal();
            $this->dispatch('refreshPageUser');
        }
    }

    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all()->groupBy(function($item){
            return explode('.',$item->name)[0];
        });
        return view('livewire.pages.users.user-edit')->with(compact('roles'))->with(compact('permissions'));
    }
}

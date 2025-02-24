<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\UserFormAction;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UserDelete extends Component
{
    public UserFormAction $form;

    #[Locked]
    public $id;

    #[Locked]
    public $name;

    public $openModalDelete = false;

    #[On('openUserDelete')]
    public function openModal($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->openModalDelete = true;
    }

    public function delete()
    {
        $find = User::findOrFail($this->id);
        if($find) {
            $delete = $this->form->delete($find);
            if ($delete) {
                $this->dispatch('notify', type: 'success', message: 'Berhasil menghapus data');
            } else {
                $this->dispatch('notify', type: 'fails', message: 'Gagal menghapus data');
            }
        }else{
            $this->dispatch('notify', type: 'fails', message: 'Data tidak ditemukan');
        }
        $this->openModalDelete = false;
        $this->dispatch('refreshPageUser');
    }

    public function render()
    {
        return view('livewire.pages.users.user-delete');
    }
}

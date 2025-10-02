<?php

namespace App\Livewire\Pages\Akun;

use Livewire\Component;
use App\Livewire\Forms\AkunForm;
use Livewire\Attributes\Locked;
use App\Models\Akun;
use Livewire\Attributes\On;

class AkunDelete extends Component
{
    public AkunForm $form;

    #[Locked]
    public $akun_id;

    public $openModalDelete = false;

    #[On('akun-delete')]
    public function openModal($akun_id)
    {
        $this->form->akun_id = $akun_id;
        $this->openModalDelete = true;
    }

    public function delete()
    {
        $find = Akun::findorFail($this->form->akun_id);
        if ($find) {
            $delete = $this->form->deleteAkun($find);
            if ($delete === true) {
                $this->dispatch('notify', type: 'success', message: 'Berhasil menghapus data');
            } elseif (is_int($delete) && $delete > 0) {
                $this->dispatch('notify', type: 'fails', message: 'Akun masih memiliki sub akun');
            } else {
                $this->dispatch('notify', type: 'fails', message: 'Gagal menghapus data');
            }
        } else {
            $this->dispatch('notify', type: 'fails', message: 'Data tidak ditemukan');
        }
        $this->openModalDelete = false;
        $this->dispatch('akunChanged')->to(Akuntable::class);
    }

    public function render()
    {
        return view('livewire.pages.akun.akun-delete');
    }
}

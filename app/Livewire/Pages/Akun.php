<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\On;
use App\Livewire\Forms\AkunForm;
use App\Livewire\Pages\Akun\Akuntable;
use App\Models\Akun as ModelsAkun;
use Livewire\Component;

class Akun extends Component
{
    public $modalAddAkun = false;
    public $modalEditAkun = false;
    public $disableJnsAkun = true;

    public AkunForm $form;

    #[On('akun-add-modal')]
    public function openModalAddAkun()
    {
        $this->modalAddAkun = true;
    }

    public function closeModalAddAkun()
    {
        $this->modalAddAkun = false;
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('modal-edit-akun')]
    public function openModalEditAkun(ModelsAkun $id)
    {
        $this->form->setAkun($id);
        if ($this->form->kd_akun3 == '00') {
            $this->disableJnsAkun = false;
        }
        $this->modalEditAkun = true;
    }

    public function closeModalEditAkun()
    {
        $this->modalEditAkun = false;
        $this->reset();
        $this->resetErrorBag();
    }

    public function storeAkun1()
    {
        $akun = $this->form->storeAkun1();
        if ($akun) {
            $this->dispatch('akun-saved');
            $this->dispatch('notify', type: 'success', message: 'Berhasil menambahkan data');
            $this->modalAddAkun = false;
            $this->form->reset();
        } else {
            $this->dispatch('notify', type: 'error', message: 'Gagal menambahkan data');
            $this->modalAddAkun = false;
            $this->form->reset();
        }
        $this->dispatch('akunChanged')->to(Akuntable::class);
    }

    public function updateAkun()
    {
        $saved = $this->form->updateAkun();
        if ($saved) {
            $this->dispatch('akun-saved');
            $this->dispatch('notify', type: 'success', message: 'Berhasil mengubah data');
            $this->modalEditAkun = false;
            $this->form->reset();
        } else {
            $this->dispatch('notify', type: 'error', message: 'Gagal mengubah data');
            $this->modalEditAkun = false;
            $this->form->reset();
        }
        $this->dispatch('akunChanged')->to(Akuntable::class);
    }

    public function render()
    {
        return view('livewire.pages.akun');
    }
}

<?php

namespace App\Livewire\Pages\Anggota;

use App\Livewire\Forms\AnggotaForm;
use App\Models\Anggota;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class AnggotaDelete extends Component
{
    public AnggotaForm $form;

    #[Locked]
    public $id;

    #[Locked]
    public $nama;

    public $openModalDelete = false;

    #[On('anggota-delete')]
    public function openModal($id, $nama)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->openModalDelete = true;
    }

    public function delete()
    {
        $find = Anggota::findorFail($this->id);
        if ($find) {
            $delete = $this->form->delete($find);
            if ($delete === true) {
                $this->dispatch('notify', type: 'success', message: 'Berhasil menghapus data');
            } else if (is_int($delete) && $delete > 0) {
                $this->dispatch('notify', type: 'fails', message: 'Anggota masih memiliki simpanan atau pinjaman');
            } else {
                $this->dispatch('notify', type: 'fails', message: 'Gagal menghapus data');
            }
        } else {
            $this->dispatch('notify', type: 'fails', message: 'Data tidak ditemukan');
        }
        $this->openModalDelete = false;
        $this->dispatch('anggotaChanged')->to(AnggotaTable::class);
    }

    public function render()
    {
        return view('livewire.pages.anggota.anggota-delete');
    }
}

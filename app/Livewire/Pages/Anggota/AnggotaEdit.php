<?php

namespace App\Livewire\Pages\Anggota;

use App\Livewire\Forms\AnggotaForm;
use App\Models\Anggota;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Lazy()]
class AnggotaEdit extends Component
{

    use WithFileUploads;

    public AnggotaForm $form;

    public $editDrawerOpen = false;

    public function mount(){
        $this->form->tgl_gabung = Carbon::now()->format('Y-m-d');
        $this->form->path_image = null;
    }

    #[On('anggota-edit-drawer')]
    public function openAddDrawerEdit(Anggota $id){
        $this->form->setAnggota($id);
        $this->editDrawerOpen = true;
    }

    #[On('anggota-edit-drawer-close')]
    public function closeEditDrawer(){
        $this->editDrawerOpen = false;
        $this->form->resetExcept(['tgl_gabung']);
        $this->resetErrorBag();
    }

    public function deleteImage(Anggota $id){
        $this->form->deletImage($id);
        $this->form->path_image = null;
    }

    public function update(){}

    public function render()
    {
        return view('livewire.pages.anggota.anggota-edit');
    }
}

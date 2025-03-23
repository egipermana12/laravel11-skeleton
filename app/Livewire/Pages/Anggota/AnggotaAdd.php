<?php

namespace App\Livewire\Pages\Anggota;

use App\Livewire\Forms\AnggotaForm;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Livewire\WithFileUploads;

#[Lazy]
class AnggotaAdd extends Component
{
    use WithFileUploads;

    public AnggotaForm $form;

    public $addDrawerOpen = false;

    public function mount(){
        $this->form->tgl_gabung = Carbon::now()->format('Y-m-d');
        $this->form->path_image = null;
    }
    
    #[On('anggota-add-drawer')]
    public function openAddDrawer(){
        $this->addDrawerOpen = true;
    }

    #[On('anggota-add-drawer-close')]
    public function closeAddDrawer(){
        $this->addDrawerOpen = false;
        $this->form->resetExcept(['tgl_gabung']);
        $this->resetErrorBag();
    }

    public function store(){
        $save = $this->form->store();
        if($save){
            $this->dispatch('anggota-add-drawer-close');
            $this->dispatch('notify', type:'success', message: 'Berhasil menambahkan data');
        }else{
            $this->dispatch('anggota-add-drawer-close');
            $this->dispatch('notify', type: 'fails', message: 'Gagal menambahkan data');
        }
        $this->dispatch('anggotaChanged')->to(AnggotaTable::class);
    }

    public function render()
    {
        return view('livewire.pages.anggota.anggota-add');
    }
}

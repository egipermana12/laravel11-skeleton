<?php

namespace App\Livewire\Pages\Akun;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Livewire\Forms\AkunForm;
use Livewire\Attributes\Lazy;
use App\Models\Akun;
use Livewire\Attributes\On;

class Akunadd extends Component
{
    //utuk auto ketika select kd-akun1 change
    public $kdAkun1 = '';
    public $addDrawerOpen = false;

    public AkunForm $form;

    #[On('akun-add-drawer')]
    public function openAddDrawer()
    {
        $this->addDrawerOpen = true;
    }

    #[On('akun-add-drawer-close')]
    public function closeAddDrawer()
    {
        $this->addDrawerOpen = false;
        $this->resetErrorBag();
        $this->reset();
    }

    //untuk auto update jenisakun
    public function updatedFormKdAkun1($value)
    {
        if ($value !== null) {
            $value = explode('.', $value);
            $qry = Akun::select('jenis_akun')
                ->where('akun_id', $value[0])
                ->first();
            $qry2 = Akun::select(
                DB::raw('MAX(kd_akun3) as max_kd_akun3')
            )
                ->where('kd_akun1', $value[1])
                ->first();

            $this->form->jenis_akun = $qry["jenis_akun"];
            $char = $qry2["max_kd_akun3"];
            $angka = (int)$char + 1;
            $this->form->kd_akun3 = str_pad($angka, 2, '0', STR_PAD_LEFT);
        }
    }

    public function kdAkun1()
    {
        return $kd_akun1 = Akun::select(
            DB::raw("akun_id as id"),
            DB::raw("CONCAT(kd_akun1,'.',' ',nama_akun ) as nama")
        )
            ->where('kd_akun2', '0')
            ->where('kd_akun3', '00')
            ->orderBy('kd_akun1', 'ASC')
            ->orderBy('kd_akun3', 'ASC')
            ->pluck('nama', 'id');
    }

    public function store()
    {
        $akun3 = $this->form->storeAkun3();
        if ($akun3) {
            $this->dispatch('notify', type: 'success', message: 'Berhasil menambahkan data');
            $this->closeAddDrawer();
        } else {
            $this->dispatch('notify', type: 'error', message: 'Gagal menambahkan data');
            $this->closeAddDrawer();
        }
        $this->dispatch('akunChanged')->to(Akuntable::class);
    }

    public function render()
    {
        $kd_akun1 = $this->kdAkun1();
        return view('livewire.pages.akun.akunadd', compact('kd_akun1'));
    }
}

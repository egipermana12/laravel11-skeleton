<?php

namespace App\Livewire\Pages\Simpanan;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Livewire\Forms\SimpananForm;
use Carbon\Carbon;
use App\Models\Akun;
use App\Traits\MappingAkunSimpanan;

class SimpananAdd extends Component
{
    use MappingAkunSimpanan;

    public $modalCariUser = false;

    public SimpananForm $form;

    public function mount()
    {
        $this->form->jenis_simpanan = 'pokok';
        $this->form->jumlah = 0;
        $this->form->tgl_simpanan = Carbon::now()->format('Y-m-d');
        $this->form->kd_akun_debet = '2.1.0.01';
    }

    #[On('carimodaluser')]
    public function openModalCariUser()
    {
        $this->modalCariUser = true;
    }

    #[On('pilihanggota-simpanan')]
    public function pilihAnggota($nik, $nama, $anggota_id)
    {
        $this->form->nik = $nik;
        $this->form->nama = $nama;
        $this->form->id_anggota = $anggota_id;
        $this->modalCariUser = false;
    }

    /**
     * untuk update select combo
     * * */


    public function updatedFormKdAkunKredit($value)
    {
        $this->form->jenis_simpanan = $this->getJenisSimpanan($value) ?? 'pokok';
    }

    public function store()
    {
        $save = $this->form->store();
        if ($save) {
            $this->form->reset();
            $this->dispatch('notify', type: 'success', message: 'Berhasil menambahkan data');
            return redirect()->route('simpanan');
        } else {
            $this->dispatch('notify', type: 'error', message: 'Gagal menambahkan data');
        }
    }

    public function akunDebet()
    {
        return $kd_akundebet = Akun::select(
            DB::raw("CONCAT(akun_id, '.', kd_akun1, '.', kd_akun2, '.', kd_akun3) as id"),
            DB::raw("CONCAT(kd_akun1, '.', kd_akun3,'.',' ',nama_akun ) as nama")
        )
            ->where('kd_akun1', '1')
            ->where('kd_akun2', '0')
            ->where('kd_akun3', '01')
            ->orderBy('nama_akun', 'ASC')
            ->pluck('nama', 'id');
    }

    public function akunKredit()
    {
        return $kd_akunkredit = Akun::select(
            DB::raw("CONCAT(akun_id, '.', kd_akun1, '.', kd_akun2, '.', kd_akun3) as id"),
            DB::raw("CONCAT(kd_akun1, '.', kd_akun3,'.',' ',nama_akun ) as nama")
        )
            ->where('kd_akun1', '2')
            ->where('kd_akun2', '0')
            ->where('kd_akun3', '!=', '00')
            ->where('kd_akun3', '<=', '03')
            ->orderBy('kd_akun3', 'ASC')
            ->pluck('nama', 'id');
    }

    public function render()
    {
        $kd_akundebet = $this->akunDebet();
        $kd_akunkredit = $this->akunKredit();
        return view('livewire.pages.simpanan.simpanan-add', compact('kd_akundebet', 'kd_akunkredit'));
    }
}

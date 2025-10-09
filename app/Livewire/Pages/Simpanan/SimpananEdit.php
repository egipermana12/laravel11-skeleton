<?php

namespace App\Livewire\Pages\Simpanan;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Livewire\Forms\SimpananForm;
use Carbon\Carbon;
use App\Models\Simpanan;
use App\Models\Akun;
use App\Models\Anggota;
use App\Traits\MappingAkunSimpanan;


class SimpananEdit extends Component
{
    use MappingAkunSimpanan;

    #[Locked]
    public $simpanan_id;

    public SimpananForm $form;

    public function mount(Simpanan $id)
    {
        $this->form->setSimpanan($id);
        $this->form->kd_akun_debet = '2.1.0.01';
        if ($this->form->jenis_simpanan == 'pokok') {
            $this->form->kd_akun_kredit = '8.2.0.01';
        } elseif ($this->form->jenis_simpanan == 'wajib') {
            $this->form->kd_akun_kredit = '9.2.0.02';
        } elseif ($this->form->jenis_simpanan == 'sukarela') {
            $this->form->kd_akun_kredit = '10.2.0.03';
        }
        $anggota = $this->getDataAnggota();
        if ($anggota) {
            $this->form->nama = $anggota->nama;
            $this->form->nik = $anggota->nik;
        }
    }

    public function getDataAnggota()
    {
        $anggota = Anggota::select('nik', 'nama')
            ->where('id', $this->form->id_anggota)
            ->first();
        return $anggota;
    }

    public function update()
    {
        $update = $this->form->update();
        if ($update) {
            $this->dispatch('notify', type: 'success', message: 'Berhasil memperbarui data');
            // return redirect()->route('transaksianggota.simpanan');
        } else {
            $this->dispatch('notify', type: 'fails', message: 'Gagal memperbarui data');
            // return redirect()->route('transaksianggota.simpanan');
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
        return view('livewire.pages.simpanan.simpanan-edit', compact('kd_akundebet', 'kd_akunkredit'));
    }
}

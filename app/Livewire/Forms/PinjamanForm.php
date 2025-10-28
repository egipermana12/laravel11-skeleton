<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Pinjaman;
use Livewire\Attributes\Locked;

class PinjamanForm extends Form
{
    public ?Pinjaman $pinjaman;

    #[Locked]
    public $pinjaman_id;

    public $id_anggota;
    public $jumlah;
    public $tgl_pinjaman;
    public $status;
    public $lama_angsuran;
    public $keterangan;
    //tambahan
    public $nama_anggota;
    public $nik_anggota;

    public function setPinjaman(Pinjaman $pinjaman)
    {
        $this->pinjaman = $pinjaman;
        $this->pinjaman_id = $pinjaman->pinjaman_id;
        $this->id_anggota = $pinjaman->id_anggota;
        $this->jumlah = $pinjaman->jumlah;
        $this->tgl_pinjaman = $pinjaman->tgl_pinjaman;
        $this->status = $pinjaman->status;
        $this->lama_angsuran = $pinjaman->lama_angsuran;
        $this->keterangan = $pinjaman->keterangan;
    }
}

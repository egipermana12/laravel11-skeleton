<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Simpanan;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;

class SimpananForm extends Form
{
    public ?Simpanan $simpanan;
    #[Locked]
    public $simpanan_id;

    #[Locked]
    public $id_anggota;
    public $jenis_simpanan;
    public $jumlah = 0;
    public $tgl_simpanan;
    public $keterangan;
    public $nama;
    public $nik;
    #[Locked]
    public $kd_akun_debet;

    public $kd_akun_kredit;

    public function rules()
    {
        return [
            'id_anggota' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'jenis_simpanan' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tgl_simpanan' => 'required',
            'keterangan' => 'string',
            'kd_akun_debet' => 'required',
            'kd_akun_kredit' => 'required'
        ];
    }

    public function setSimpanan(Simpanan $simpanan)
    {
        $this->simpanan = $simpanan;
        $this->simpanan_id = $simpanan->simpanan_id;
        $this->id_anggota = $simpanan->id_anggota;
        $this->jenis_simpanan = $simpanan->jenis_simpanan;
        $this->jumlah = $simpanan->jumlah;
        $this->tgl_simpanan = $simpanan->tgl_simpanan;
        $this->keterangan = $simpanan->keterangan;
    }

    public function store()
    {
        $this->validate();
    }
}

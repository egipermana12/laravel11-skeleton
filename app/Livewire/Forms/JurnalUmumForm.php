<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Models\Jurnal;
use Livewire\Attributes\Locked;
use Livewire\Form;

class JurnalUmumForm extends Form
{
    public ?Jurnal $jurnal;

    #[Locked]
    public int $jurnal_id;

    public $tanggal;
    public $transaksi_id;
    public $akun_id;
    public $kd_akun1;
    public $kd_akun2;
    public $kd_akun3;
    public $debet;
    public $kredit;
    public function setJurnal(Jurnal $jurnal): void
    {
        $this->jurnal = $jurnal;
        $this->jurnal_id = $jurnal->jurnal_id;
        $this->tanggal = $jurnal->tanggal;
        $this->transaksi_id = $jurnal->transaksi_id;
        $this->akun_id = $jurnal->akun_id;
        $this->kd_akun1 = $jurnal->kd_akun1;
        $this->kd_akun2 = $jurnal->kd_akun2;
        $this->kd_akun3 = $jurnal->kd_akun3;
        $this->debet = $jurnal->debet;
        $this->kredit = $jurnal->kredit;
    }
}

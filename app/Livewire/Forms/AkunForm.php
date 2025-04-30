<?php

namespace App\Livewire\Forms;

use App\Models\Akun;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AkunForm extends Form
{
    public ?Akun $akun;
    #[Locked]
    public $akun_id;

    public string $kd_akun1 = '';
    public string $kd_akun2 = '';
    public string $kd_akun3 = '';
    public string $nama_akun = '';
    public string $jenis_akun = '';
    public string $ket = '';

    public function rules(): array
    {
        return [
            'kd_akun1' => [
                'required',
                'string',
                'max:1',
                Rule::unique('t_akun', 'kd_akun1')->ignore($this->akun_id),
            ],
            'nama_akun' => [
                'required',
                'string',
                'max:255',
            ],
            'jenis_akun' => [
                'required',
                'string',
                Rule::in(['debet', 'kredit']),
            ],
        ];
    }

    public function setAkun(Akun $akun): void
    {
        $this->akun = $akun;
        $this->akun_id = $akun->akun_id;
        $this->kd_akun1 = $akun->kd_akun1;
        $this->kd_akun2 = $akun->kd_akun2;
        $this->kd_akun3 = $akun->kd_akun3;
        $this->nama_akun = $akun->nama_akun;
        $this->jenis_akun = $akun->jenis_akun;
        $this->ket = $akun->ket;
    }
}

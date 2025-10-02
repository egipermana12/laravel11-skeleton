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

    public function setAkun(Akun $akun): void
    {
        $this->akun = $akun;
        $this->akun_id = $akun->akun_id;
        $this->kd_akun1 = $akun->kd_akun1;
        $this->kd_akun2 = $akun->kd_akun2;
        $this->kd_akun3 = $akun->kd_akun3;
        $this->nama_akun = $akun->nama_akun;
        $this->jenis_akun = $akun->jenis_akun;
        $this->ket = $akun->ket ?? '';
    }

    public function storeAkun1()
    {
        $this->validate([
            'kd_akun1' => 'required|string|max:1|unique:t_akun,kd_akun1',
            'nama_akun' => 'required|string|max:255',
            'jenis_akun' => 'required|string',
        ]);

        $akun = new Akun();
        $akun->kd_akun1 = $this->kd_akun1;
        $akun->nama_akun = $this->nama_akun;
        $akun->jenis_akun = $this->jenis_akun;
        $akun->ket = $this->ket;
        $akun->save();
        return $akun;
    }

    public function storeAkun3()
    {
        $this->validate([
            'kd_akun1' => 'required|string|max:1',
            'kd_akun3' => ['required', 'string', 'min:2', 'max:2', Rule::unique('t_akun', 'kd_akun3')->where(function ($qurey) {
                $qurey->where('kd_akun1', $this->kd_akun1);
            })],
            'nama_akun' => 'required|string|max:255',
            'jenis_akun' => 'required|string',
        ]);

        $akun = new Akun();
        $akun->kd_akun1 = $this->kd_akun1;
        $akun->kd_akun3 = $this->kd_akun3;
        $akun->jenis_akun = $this->jenis_akun;
        $akun->ket = $this->ket;
        $akun->nama_akun = $this->nama_akun;
        $akun->save();
        return $akun;
    }

    public function updateAkun()
    {
        $this->validate([
            'nama_akun' => 'required|string|max:255',
            'jenis_akun' => 'required|string',
            'ket' => 'nullable|string|max:255',
        ]);

        $akun = Akun::findOrFail($this->akun_id);

        $akun->fill([
            'nama_akun' => $this->nama_akun,
            'jenis_akun' => $this->jenis_akun,
            'ket' => $this->ket,
        ]);

        $saved = $akun->save();

        if ($saved && $akun->kd_akun3 === '00') {
            Akun::where('kd_akun1', $this->kd_akun1)->update(['jenis_akun' => $this->jenis_akun]);
        }
        return $saved;
    }

    public function deleteAkun(Akun $akun)
    {
        if ($akun->kd_akun3 === '00') {
            $count = Akun::where('kd_akun1', $akun->kd_akun1)->where('kd_akun3', '!=', '00')->count();
            if ($count > 0) {
                return $count;
            }
        }
        $deleted =  $akun->delete();
        return $deleted ? true : false;
    }
}

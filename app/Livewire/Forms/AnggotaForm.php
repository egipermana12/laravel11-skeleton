<?php

namespace App\Livewire\Forms;

use App\Models\Anggota;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AnggotaForm extends Form
{

    use WithFileUploads;

    public ?Anggota $anggota;

    #[Locked]
    public $id;

    public string $nik = '';
    public string $nik_masking = '';
    public string $nama = '';
    public string $tgl_lahir = '1990-01-01';
    public string $jenis_kelamin = 'L';
    public string $alamat = '';
    public string $no_telp = '';
    public string $tgl_gabung = '';
    public string $status = 'aktif';
    public $path_image;
    public $path_newImage;


    public function rules()
    {
        return [
            'nik' => [
                'required',
                'string',
                'max:16',
                'min:16',
                Rule::unique('t_anggota')->ignore($this->id)
            ],
            'nama' => [
                'required',
                'string',
                'max:50',
            ],
            'tgl_lahir' => [
                'required',
                'string',
                'max:10',
            ],
            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
                'string',
                'max:1',
            ],
            'alamat' => [
                'nullable',
                'string',
                'max:255',
            ],
            'no_telp' => [
                'nullable',
                'string',
                'max:13',
            ],
            'tgl_gabung' => [
                'required',
                'string',
                'max:10',
            ],
            'status' => [
                'required',
                Rule::in(['aktif', 'tidak aktif']),
                'string',
                'max:12',
            ],
            'path_image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1048',
            ],
            'path_newImage' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1048',
            ],
        ];
    }

    public function setAnggota(Anggota $anggota)
    {
        $this->anggota = $anggota;
        $this->id = $anggota->id;
        $this->nik = $anggota->nik;
        $this->nama = $anggota->nama;
        $this->tgl_lahir = $anggota->tgl_lahir;
        $this->jenis_kelamin = $anggota->jenis_kelamin;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->tgl_gabung = $anggota->tgl_gabung;
        $this->status = $anggota->status;
        $this->path_image = $anggota->path_image;
    }

    public function store()
    {
        $this->validate();

        $anggota = new Anggota();
        $anggota->nik = $this->nik;
        $anggota->nama = $this->nama;
        $anggota->tgl_lahir = $this->tgl_lahir;
        $anggota->jenis_kelamin = $this->jenis_kelamin;
        $anggota->alamat = $this->alamat;
        $anggota->no_telp = $this->no_telp;
        $anggota->tgl_gabung = $this->tgl_gabung;
        $anggota->status = $this->status;
        if ($this->path_image) {
            $anggota->path_image = $this->path_image->store('images/anggota', 'private');
        }
        $anggota->save();
        return $anggota;
    }

    public function update()
    {
        $this->validate();
        $this->anggota->nik = $this->nik;
        $this->anggota->nama = $this->nama;
        $this->anggota->tgl_lahir = $this->tgl_lahir;
        $this->anggota->jenis_kelamin = $this->jenis_kelamin;
        $this->anggota->alamat = $this->alamat;
        $this->anggota->no_telp = $this->no_telp;
        $this->anggota->tgl_gabung = $this->tgl_gabung;
        $this->anggota->status = $this->status;
        if ($this->path_newImage) {
            $this->anggota->path_image = $this->path_newImage->store('images/anggota', 'private');
        }
        $this->anggota->save();
        return $this->anggota;
    }

    public function deletImage(Anggota $anggota)
    {
        if ($anggota->path_image && Storage::disk('private')->exists($anggota->path_image)) {
            Storage::disk('private')->delete($anggota->path_image);
        }
        $anggota->path_image = null;
        $anggota->save();
        return $anggota;
    }

    public function delete(Anggota $anggota)
    {
        if ($anggota->path_image && Storage::disk('private')->exists($anggota->path_image)) {
            Storage::disk('private')->delete($anggota->path_image);
        }
        return $anggota->delete();
    }
}

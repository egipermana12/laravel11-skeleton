<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Anggota extends Model
{
    use SoftDeletes;

    protected $table = 't_anggota';

    protected $fillable = [
        'nik',
        'nik_masking',
        'nama',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'tgl_gabung',
        'status',
        'path_image',
    ];

    /**
     * Set the nik attribute. for encrypt nik
     */
    public function setNikAttribute($value){
        $this->attributes['nik'] = Crypt::encryptString($value);
        $this->attributes['nik_masking'] = $this->setNikMasking($value);
    }

    // Akses untuk dekripsi NIK
    public function getNikAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function setNikMasking($value){
        return  '****' . substr($value, -8);
    }
}

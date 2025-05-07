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
     * RELASY MANY TO MANY
     * antara anggota dan simpanan
     * * */

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'id_anggota');
    }

    /**
     * Set the nik attribute. for encrypt nik
     */
    public function setNikAttribute($value)
    {
        // $this->attributes['nik'] = Crypt::encryptString($value);
        // $this->attributes['nik_hash'] = hash('sha256', $value); // Simpan hash untuk validasi unik, gunakan jika suatu saat butuh untuk di ecrypt
        $this->attributes['nik'] = $value;
        $this->attributes['nik_masking'] = $this->setNikMasking($value);
    }

    // Akses untuk dekripsi NIK
    public function getNikAttribute($value)
    {
        // return $value ? Crypt::decryptString($value) : null;
        return $value;
    }

    public function setNikMasking($value)
    {
        return  '****' . substr($value, -8);
    }
}

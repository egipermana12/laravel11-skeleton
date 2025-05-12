<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akun extends Model
{
    use SoftDeletes;
    protected $table = 't_akun';

    protected $fillable = [
        'kd_akun',
        'nama_akun',
        'jenis_akun',
    ];

    public function jurnal()
    {
        return $this->hasMany(Jurnal::class, 'akun_id');
    }
}

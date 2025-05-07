<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 't_simpanan';
    protected $primaryKey = 'simpanan_id';
    protected $fillable = [
        'id_anggota',
        'jenis_simpanan',
        'jumlah',
        'tgl_simpanan',
        'keterangan'
    ];

    /***
     * RELASY MANY TO MANY
     * ke table anggota
     * * */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id');
    }
}

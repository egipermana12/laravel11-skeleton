<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 't_pinjaman';
    protected $primaryKey = 'pinjaman_id';
    protected $fillable = [
        'id_anggota',
        'jumlah',
        'tgl_pinjaman',
        'status',
        'lama_angsuran',
        'keterangan'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id');
    }
}

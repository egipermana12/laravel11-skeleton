<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 't_transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = [
        'tanggal',
        'jenis_transaksi',
        'refid_transaksi',
        'keterangan'
    ];

    public function jurnal()
    {
        return $this->hasMany(Jurnal::class, 'transaksi_id');
    }
}

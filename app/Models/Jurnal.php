<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 't_jurnal';
    protected $primaryKey = 'jurnal_id';
    protected $fillable = [
        'tanggal',
        'transaksi_id',
        'akun_id',
        'kd_akun1',
        'kd_akun2',
        'kd_akun3',
        'debet',
        'kredit',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'akun_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'transaksi_id');
    }
}

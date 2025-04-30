<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_jurnal', function (Blueprint $table) {
            $table->id('jurnal_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('akun_id');
            $table->decimal('debet', 10, 2);
            $table->decimal('kredit', 10, 2);

            $table->foreign('transaksi_id')->references('transaksi_id')->on('t_transaksi');
            $table->foreign('akun_id')->references('akun_id')->on('t_akun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

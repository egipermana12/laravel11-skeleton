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
        Schema::create('t_pembayaran_pinjaman', function (Blueprint $table) {
            $table->id('pembayaran_pinjaman_id');
            $table->unsignedBigInteger('pinjaman_id');
            $table->date('tgl_pembayaran');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->string('ket')->nullable();

            $table->foreign('pinjaman_id')->references('pinjaman_id')->on('t_pinjaman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pembayaran_pinjaman');
    }
};

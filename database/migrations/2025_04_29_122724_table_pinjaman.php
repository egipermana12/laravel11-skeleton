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
        Schema::create('t_pinjaman', function (Blueprint $table) {
            $table->id('pinjaman_id');
            $table->unsignedBigInteger('id_anggota');
            $table->decimal('jumlah', 10, 2);
            $table->date('tgl_pinjaman');
            $table->enum('status', ['disetujui', 'ditolak', 'lunas', 'belum_lunas'])->default('ditolak');
            $table->integer('lama_angsuran');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_anggota')->references('id')->on('t_anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pinjaman');
    }
};

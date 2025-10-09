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
        Schema::create('t_simpanan', function (Blueprint $table) {
            $table->id('simpanan_id');
            $table->unsignedBigInteger('id_anggota');
            $table->enum('jenis_simpanan', ['pokok', 'wajib', 'sukarela']);
            $table->decimal('jumlah', 10, 2);
            $table->date('tgl_simpanan');
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
        Schema::dropIfExists('t_simpanan');
    }
};

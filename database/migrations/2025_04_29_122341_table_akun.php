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
        Schema::create('t_akun', function (Blueprint $table) {
            $table->id('akun_id');
            $table->char('kd_akun1', 1)->default('0');
            $table->char('kd_akun2', 1)->default('0');
            $table->char('kd_akun3', 2)->default('00');
            $table->string('nama_akun');
            $table->enum('jenis_akun', ['debet', 'kredit']);
            $table->string('ket', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['kd_akun1', 'kd_akun2', 'kd_akun3']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_akun');
    }
};

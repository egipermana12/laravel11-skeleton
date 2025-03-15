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
        Schema::table('t_anggota', function (Blueprint $table) {
            $table->string('nik_masking')->nullable()->after('nik');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_anggota', function (Blueprint $table) {
            $table->dropColumn('nik_masking');
            $table->dropIndex('status');
        });
    }
};

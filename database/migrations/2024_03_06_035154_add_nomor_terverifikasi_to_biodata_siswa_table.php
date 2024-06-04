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
        Schema::table('biodata_siswa', function (Blueprint $table) {
            $table->boolean('nomor_terverifikasi')->default(0)->after('nomor_hp_ortu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_siswa', function (Blueprint $table) {
            $table->dropColumn('nomor_terverifikasi');
        });
    }
};

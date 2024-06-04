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
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->dropColumn('fonnte_batas_pesan_bulanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->integer('fonnte_batas_pesan_bulanan')->after('fonnte_otorisasi_umum');
        });
    }
};

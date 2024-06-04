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
            $table->string('aplikasi_nama')->nullable()->after('fonnte_batas_pesan_bulanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->dropColumn('aplikasi_nama');
        });
    }
};

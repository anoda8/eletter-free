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
        Schema::table('format_keterangan_siswa', function (Blueprint $table) {
            $table->string('arsip_keluar_id')->nullable(true)->change();
            $table->string('yang_menerangkan')->after('nisn')->nullable();
            $table->string('kota_surat')->after('nip_pejabat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('format_keterangan_siswa', function (Blueprint $table) {
            $table->string('arsip_keluar_id')->nullable(false)->change();
            $table->dropColumn(['yang_menerangkan', 'kota_surat']);
        });
    }
};

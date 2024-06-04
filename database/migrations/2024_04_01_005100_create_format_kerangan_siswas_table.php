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
        Schema::create('format_kerangan_siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('arsip_keluar_id');
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kelas')->nullable();
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('menerangkan')->nullable();
            $table->string('keperluan')->nullable();
            $table->date('tanggal_surat');
            $table->string('pejabat');
            $table->string('nama_pejabat');
            $table->string('nip_pejabat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format_kerangan_siswa');
    }
};

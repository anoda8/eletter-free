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
        Schema::create('format_surat_tugas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('arsip_masuk_id')->nullable();
            $table->string('arsip_keluar_id')->nullable();
            $table->string('dasar_perihal')->nullable();
            $table->string('dasar_asal')->nullable();
            $table->string('dasar_nomor')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('tempat_kegiatan')->nullable();
            $table->string('alamat_kegiatan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('pejabat')->nullable();
            $table->string('nama_pejabat')->nullable();
            $table->string('nip_pejabat')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format_surat_tugas');
    }
};

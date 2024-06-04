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
        Schema::create('arsip_masuk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id')->nullable();
            $table->string('perihal')->nullable();
            $table->string('asal_surat')->nullable();
            $table->string('nomor_agenda');
            $table->string('nomor_klasifikasi');
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_target_selesai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->date('tanggal_disposisi')->nullable();
            $table->string('sifat_surat')->nullable();
            $table->string('catatan')->nullable();
            $table->string('catatan_tambahan')->nullable();
            $table->string('yang_menyelesaikan')->nullable();
            $table->string('file_arsip_masuk_id')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('status')->nullable();
            $table->string('tahun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_masuk');
    }
};

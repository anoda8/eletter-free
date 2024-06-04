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
        Schema::create('arsip_masuk_disposisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('arsip_masuk_id');
            $table->string('biodata_pegawai_id');
            $table->string('jabatan_pegawai_id')->nullable();
            $table->datetime('terkirim')->nullable();
            $table->datetime('diterima')->nullable();
            $table->datetime('tanggal_diselesaikan')->nullable();
            $table->string('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_masuk_disposisi');
    }
};

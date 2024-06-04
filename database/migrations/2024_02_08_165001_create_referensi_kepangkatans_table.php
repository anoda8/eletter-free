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
        Schema::create('referensi_kepangkatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("referensi_gtk_id");
            $table->string("riwayat_kepangkatan_id")->nullable();
            $table->string("nomor_sk")->nullable();
            $table->date("tanggal_sk")->nullable();
            $table->date("tmt_pangkat")->nullable();
            $table->integer("masa_kerja_gol_tahun")->nullable();
            $table->integer("masa_kerja_gol_bulan")->nullable();
            $table->string("pangkat_golongan_id_str")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_kepangkatan');
    }
};

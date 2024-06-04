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
        Schema::create('biodata_pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("user_id");
            $table->string("referensi_gtk_id")->nullable();
            $table->string("nama")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->string("tempat_lahir")->nullable();
            $table->string("tanggal_lahir")->nullable();
            $table->string("agama_id_str")->nullable();
            $table->string("nuptk")->nullable();
            $table->string("nik")->nullable();
            $table->string("jenis_ptk_id_str")->nullable();
            $table->string("status_kepegawaian_id_str")->nullable();
            $table->string("nip")->nullable();
            $table->string("pendidikan_terakhir")->nullable();
            $table->string("bidang_studi_terakhir")->nullable();
            $table->string("pangkat_golongan_terakhir")->nullable();
            $table->string("gelar_depan")->nullable();
            $table->string("gelar_belakang")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_pegawai');
    }
};

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
        Schema::create('referensi_siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("registrasi_id")->nullable();
            $table->integer("jenis_pendaftaran_id")->nullable();
            $table->string("jenis_pendaftaran_id_str")->nullable();
            $table->string("nipd")->nullable();
            $table->date("tanggal_masuk_sekolah")->nullable();
            $table->string("sekolah_asal")->nullable();
            $table->string("peserta_didik_id")->nullable();
            $table->string("nama")->nullable();
            $table->string("nisn")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->string("nik")->unique();
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->integer("agama_id")->nullable();
            $table->string("agama_id_str")->nullable();
            $table->string("alamat_jalan")->nullable();
            $table->string("nomor_telepon_rumah")->nullable();
            $table->string("nomor_telepon_seluler")->nullable();
            $table->string("nama_ayah")->nullable();
            $table->integer("pekerjaan_ayah_id")->nullable();
            $table->string("pekerjaan_ayah_id_str")->nullable();
            $table->string("nama_ibu")->nullable();
            $table->integer("pekerjaan_ibu_id")->nullable();
            $table->string("pekerjaan_ibu_id_str")->nullable();
            $table->string("nama_wali")->nullable();
            $table->integer("pekerjaan_wali_id")->nullable();
            $table->string("pekerjaan_wali_id_str")->nullable();
            $table->integer("anak_keberapa")->nullable();
            $table->integer("tinggi_badan")->nullable();
            $table->integer("berat_badan")->nullable();
            $table->string("email")->nullable();
            $table->string("semester_id")->nullable();
            $table->string("anggota_rombel_id")->nullable();
            $table->string("rombongan_belajar_id")->nullable();
            $table->integer("tingkat_pendidikan_id")->nullable();
            $table->string("nama_rombel")->nullable();
            $table->string("kurikulum_id")->nullable();
            $table->string("kurikulum_id_str")->nullable();
            $table->string("kebutuhan_khusus")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_siswa');
    }
};

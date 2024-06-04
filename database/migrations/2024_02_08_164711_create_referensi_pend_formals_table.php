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
        Schema::create('referensi_pend_formal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("referensi_gtk_id");
            $table->string("riwayat_pendidikan_formal_id")->nullable();
            $table->string("satuan_pendidikan_formal")->nullable();
            $table->string("fakultas")->nullable();
            $table->boolean("kependidikan")->nullable();
            $table->string("tahun_masuk")->nullable();
            $table->string("tahun_lulus")->nullable();
            $table->string("nim")->nullable();
            $table->string("status_kuliah")->nullable();
            $table->string("semester")->nullable();
            $table->decimal("ipk",10,2)->nullable();
            $table->string("prodi")->nullable();
            $table->string("id_reg_pd")->nullable();
            $table->string("bidang_studi_id_str")->nullable();
            $table->string("jenjang_pendidikan_id_str")->nullable();
            $table->string("gelar_akademik_id_str")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_pend_formal');
    }
};

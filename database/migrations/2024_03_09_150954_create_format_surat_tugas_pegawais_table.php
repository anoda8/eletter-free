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
        Schema::create('format_surat_tugas_pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fromat_surat_tugas_id');
            $table->string('biodata_pegawai_id');
            $table->string('jabatan_pegawai_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('format_surat_tugas_pegawai');
    }
};

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
        Schema::create('whatsapp_registrasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('biodata_siswa_id');
            $table->string('user_id')->nullable();
            $table->string('nomor_hp_lama')->nullable();
            $table->string('nomor_hp_baru')->nullable();
            $table->string('nomor_hp_ortu_lama')->nullable();
            $table->string('nomor_hp_ortu_baru')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_registrasi');
    }
};

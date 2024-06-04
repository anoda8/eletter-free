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
        Schema::create('setting_aplikasi', function (Blueprint $table) {
            $table->id();
            $table->string('fonnte_alamat_kirim')->nullable();
            $table->string('fonnte_kode_negara')->nullable();
            $table->string('fonnte_otorisasi_umum')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_aplikasi');
    }
};

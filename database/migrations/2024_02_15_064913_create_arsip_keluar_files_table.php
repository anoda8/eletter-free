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
        Schema::create('arsip_keluar_file', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('arsip_keluar_id');
            $table->enum('mode_berkas', ['draf', 'arsip']);
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_keluar_file');
    }
};

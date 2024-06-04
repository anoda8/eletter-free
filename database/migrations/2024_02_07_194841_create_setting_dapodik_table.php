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
        Schema::create('setting_dapodik', function (Blueprint $table) {
            $table->string('nama_koneksi');
            $table->string('ip_aplikasi');
            $table->string('ip_dapodik');
            $table->string('key');
            $table->string('npsn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_dapodik');
    }
};

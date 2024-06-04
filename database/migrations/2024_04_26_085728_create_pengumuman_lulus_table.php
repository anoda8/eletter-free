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
        Schema::create('pengumuman_lulus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('biodata_siswa_id');
            $table->datetime('upload_time')->nullable();
            $table->boolean('status')->default(0);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman_lulus');
    }
};

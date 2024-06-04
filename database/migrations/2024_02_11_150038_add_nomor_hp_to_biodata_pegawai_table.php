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
        Schema::table('biodata_pegawai', function (Blueprint $table) {
            $table->string('nomor_hp')->after('gelar_belakang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_pegawai', function (Blueprint $table) {
            $table->dropColumn('nomor_hp');
        });
    }
};

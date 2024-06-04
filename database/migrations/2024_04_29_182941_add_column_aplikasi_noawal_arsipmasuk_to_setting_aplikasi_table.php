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
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->integer('aplikasi_noawal_arsipkeluar')->after('aplikasi_nama')->nullable();
            $table->integer('aplikasi_noawal_arsipmasuk')->after('aplikasi_nama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->dropColumn(['aplikasi_noawal_arsipkeluar', 'aplikasi_noawal_arsipmasuk']);
        });
    }
};

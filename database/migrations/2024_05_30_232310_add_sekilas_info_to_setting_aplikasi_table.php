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
            $table->boolean('sekilas_info')->after('aplikasi_noawal_arsipkeluar')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_aplikasi', function (Blueprint $table) {
            $table->dropColumn('sekilas_info');
        });
    }
};

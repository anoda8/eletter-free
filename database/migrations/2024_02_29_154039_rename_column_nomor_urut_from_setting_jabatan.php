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
        Schema::table('setting_jabatan', function (Blueprint $table) {
            $table->renameColumn('nomor_urut', 'sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_jabatan', function (Blueprint $table) {
            $table->renameColumn('sort', 'nomor_urut');
        });
    }
};

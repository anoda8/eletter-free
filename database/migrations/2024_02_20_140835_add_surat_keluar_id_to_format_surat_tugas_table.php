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
        Schema::table('format_surat_tugas', function (Blueprint $table) {
            $table->string('surat_keluar_id')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('format_surat_tugas', function (Blueprint $table) {
            $table->dropColumn('surat_keluar_id');
        });
    }
};

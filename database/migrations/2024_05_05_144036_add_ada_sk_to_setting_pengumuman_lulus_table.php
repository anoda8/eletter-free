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
        Schema::table('setting_pengumuman_lulus', function (Blueprint $table) {
            $table->boolean('ada_sk')->after('waktu_pengumuman')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_pengumuman_lulus', function (Blueprint $table) {
            $table->dropColumn('ada_sk');
        });
    }
};

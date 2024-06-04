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
        Schema::table('addons_bukutamu', function (Blueprint $table) {
            $table->text('alamat')->change();
            $table->text('keperluan')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addons_bukutamu', function (Blueprint $table) {
            $table->string('alamat')->change();
            $table->string('keperluan')->change();
        });
    }
};

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
        Schema::dropIfExists('jabatan_users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('jabatan_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jabatan_id');
            $table->string('user_id');
            $table->timestamps();
        });
    }
};

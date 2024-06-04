<?php

namespace Database\Seeders;

use App\Models\ArsipMasuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArsipMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        return ArsipMasuk::factory()->count(50)->create()->make();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingDapodikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting_dapodik')->insert([
            'nama_koneksi' => "Koneksi Dapodik",
            'ip_aplikasi' => "0.0.0.0",
            'ip_dapodik' => "0.0.0.0",
            'npsn' => "22222999",
            'key' => fake()->text(10)
        ]);
    }
}

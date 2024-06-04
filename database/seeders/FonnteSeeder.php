<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FonnteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting_aplikasi')->insert([
            'fonnte_alamat_kirim' => "https://api.fonnte.com/send",
            'fonnte_kode_negara' => "62",
            'fonnte_otorisasi_umum' => null,
        ]);
    }
}

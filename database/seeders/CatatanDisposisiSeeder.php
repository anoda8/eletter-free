<?php

namespace Database\Seeders;

use App\Models\SettingCatatanDisposisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatatanDisposisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['catatan' => "Untuk diketahui"],
            ['catatan' => "Untuk dipertimbangkan"],
            ['catatan' => "Untuk diselesaikan lebih lanjut"],
            ['catatan' => "Untuk dilaksanakan dengan penuh tanggungjawab"],
            ['catatan' => "Diusahakan untuk mengikuti"],
            ['catatan' => "Tugas sekolah diatur sebaik-baiknya"],
            ['catatan' => "Untuk diinformasikan ke pihak terkait"],
            ['catatan' => "Diteruskan kepada yang bersangkutan"],
            ['catatan' => "Untuk disalin dan dipasang di Papan Pengumuman"],
            ['catatan' => "Untuk dilengkapi Surat Tugas/SPPD"],
            ['catatan' => "Disiapkan untuk bahan briefing"],
            ['catatan' => "Diizinkan untuk melakukan penelitian"],
        ];

        foreach ($data as $key => $dt) {
            SettingCatatanDisposisi::create($dt);
        }
    }
}

<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'mode_installasi' => env('MODE_INSTALLASI', true),
    'addon_settings' => env('ADDON_SETTINGS', false),
    'addon_pengumuman_kelulusan' => env('ADDON_PENGUMUMAN_KELULUSAN', false),
    'addon_bukutamu' => env('ADDON_BUKU_TAMU', false),

    'setting_kop_bentuk_pendidikan' => [
        'SMA' => 'SEKOLAH MENENGAH ATAS',
        'SMK' => 'SEKOLAH MENENGAH KEJURUAN',
        'MA' => 'MADRASAH ALIYAH',
        'MAN' => 'MADRASAH ALIYAH NEGERI',
    ]
];

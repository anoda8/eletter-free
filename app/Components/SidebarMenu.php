<?php

namespace App\Components;

use App\Models\User;
use Livewire\Component;

class SidebarMenu extends Component
{
    public $menus = [];

    public $user;

    public function mount(){
        $this->user = auth()->user();
    }

    public function render()
    {
        $this->menus = $this->generateMenu();
        return view('components.sidebar-menu');
    }

    public function generateMenu(){
        $data = [
            [
                'nav-title' => $this->user->isAbleTo('menu-arsip-masuk|menu-arsip-keluar'),
                'text' => "Arsip Surat"
            ],
            [
                'show' => $this->user->isAbleTo('menu-arsip-masuk'),
                'text' => "Surat Masuk",
                'url' => '#',
                'icon' => 'envelope-open',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Surat Masuk",
                        'url' => route('arsip.masuk'),
                        'icon' => 'envelope-open',
                    ],
                    [
                        'show' => true,
                        'text' => "Disposisi",
                        'url' => route('arsip.disposisi-arsip-masuk'),
                        'icon' => 'envelope-letter',
                    ],
                ]
            ],
            [
                'show' => $this->user->isAbleTo('menu-arsip-keluar'),
                'text' => "Surat Keluar",
                'url' => route('arsip.keluar'),
                'icon' => 'envelope-closed',
                'opened_menu' => false,
                'children' => false
            ],
            [
                'nav-title' => $this->user->isAbleTo('menu-format-surat|menu-pesan-whatsapp'),
                'text' => "Persuratan"
            ],
            [
                'show' => $this->user->isAbleTo('menu-format-surat'),
                'text' => "Format Surat",
                'url' => '#',
                'icon' => 'newspaper',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Surat Tugas",
                        'url' => route('format.surat-tugas'),
                        'icon' => 'notes',
                    ],
                    [
                        'show' => true,
                        'text' => "Keterangan Siswa",
                        'url' => route('format.surat-keterangan-siswa'),
                        'icon' => 'notes',
                    ],
                    // [
                    //     'show' => true,
                    //     'text' => "Dispensasi Siswa",
                    //     'url' => route('referensi.data-sekolah'),
                    //     'icon' => 'notes',
                    // ],
                    // [
                    //     'show' => true,
                    //     'text' => "Surat Pengantar",
                    //     'url' => route('referensi.data-sekolah'),
                    //     'icon' => 'notes',
                    // ],
                ]
            ],
            [
                'show' => $this->user->isAbleTo('menu-pesan-whatsapp'),
                'text' => "Pesan Whatsapp",
                'url' => '#',
                'icon' => 'envelope-closed',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Registrasi Nomor",
                        'url' => route('whatsapp.daftar-registrasi-nomor'),
                        'icon' => 'playlist-add',
                    ],
                    [
                        'show' => true,
                        'text' => "Kirim Pesan",
                        'url' => route('whatsapp.kirim-pesan'),
                        'icon' => 'envelope-closed',
                    ],
                    [
                        'show' => true,
                        'text' => "Riwayat Pesan",
                        'url' => route('whatsapp.riwayat-pesan'),
                        'icon' => 'history',
                    ],
                ]
            ],
            [
                'nav-title' => (config('eletter.addon_settings') && $this->user->isAbleTo('menu-buku-tamu')),
                'text' => "Add Ons"
            ],
            [
                'show' => (config('eletter.addon_pengumuman_kelulusan') && $this->user->isAbleTo('menu-kelulusan')),
                'text' => "Kelulusan",
                'url' => '#',
                'icon' => 'envelope-closed',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Upload File",
                        'url' => route('addons.pengumuman-lulus-upload'),
                        'icon' => 'cloud-upload',
                    ],
                    [
                        'show' => true,
                        'text' => "Pengaturan",
                        'url' => route('addons.pengaturan-pengumuman-lulus'),
                        'icon' => 'cog',
                    ],
                ],
            ],
            [
                'show' => (config('eletter.addon_bukutamu') && $this->user->isAbleTo('menu-buku-tamu')),
                'text' => "Buku Tamu",
                'url' => route('addons.bukutamu-manage'),
                'icon' => 'address-book',
                'opened_menu' => false,
                'children' => false
            ],
            [
                'nav-title' => $this->user->isAbleTo('menu-database|menu-referensi-data'),
                'text' => "Database"
            ],
            [
                'show' => $this->user->isAbleTo('menu-database'),
                'text' => "Database",
                'url' => '#',
                'icon' => 'storage',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Biodata Pegawai",
                        'url' => route('settings.biodata-pegawai'),
                        'icon' => 'basket',
                    ],
                    [
                        'show' => true,
                        'text' => "Biodata Siswa",
                        'url' => route('settings.biodata-siswa'),
                        'icon' => 'basket',
                    ],
                    [
                        'show' => true,
                        'text' => "Klasifikasi Surat",
                        'url' => route('settings.klasifikasi-surat'),
                        'icon' => 'basket',
                    ],
                    [
                        'show' => true,
                        'text' => "Catatan Disposisi",
                        'url' => route('settings.catatan-disposisi'),
                        'icon' => 'basket',
                    ],
                ]
            ],
            [
                'show' => $this->user->isAbleTo('menu-referensi-data'),
                'text' => "Referensi Data",
                'url' => '#',
                'icon' => 'storage',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Data Sekolah",
                        'url' => route('referensi.data-sekolah'),
                        'icon' => 'basket',
                    ],
                    [
                        'show' => true,
                        'text' => "Data GTK",
                        'url' => route('referensi.data-gtk'),
                        'icon' => 'basket',
                    ],
                    [
                        'show' => true,
                        'text' => "Data Siswa",
                        'url' => route('referensi.data-siswa'),
                        'icon' => 'basket',
                    ],
                ]
            ],
            [
                'nav-title' => $this->user->isAbleTo('menu-pengaturan|menu-pencadangan|menu-izin-akses'),
                'text' => "Pengaturan"
            ],
            [
                'show' => $this->user->isAbleTo('menu-pencadangan'),
                'text' => "Pencadangan",
                'url' => route('arsip.keluar'),
                'icon' => 'storage',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Surat Masuk",
                        'url' => route('backup.arsip-masuk'),
                        'icon' => 'envelope-open',
                    ],
                    [
                        'show' => true,
                        'text' => "Surat Keluar",
                        'url' => route('backup.arsip-keluar'),
                        'icon' => 'envelope-open',
                    ],
                    // [
                    //     'show' => true,
                    //     'text' => "Database SQL",
                    //     'url' => route('referensi.data-sekolah'),
                    //     'icon' => 'envelope-open',
                    // ],
                ]
            ],
            [
                'show' => $this->user->isAbleTo('menu-izin-akses'),
                'text' => "Izin Akses",
                'url' => "#",
                'icon' => 'cog',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Permission",
                        'url' => route('izin-akses.permission'),
                        'icon' => 'cog',
                    ],
                    [
                        'show' => true,
                        'text' => "Permission Roles",
                        'url' => route('izin-akses.roles'),
                        'icon' => 'people',
                    ],
                ]
            ],
            [
                'show' => $this->user->isAbleTo('menu-pengaturan'),
                'text' => "Pengaturan",
                'url' => '#',
                'icon' => 'cog',
                'opened_menu' => false,
                'children' => [
                    [
                        'show' => true,
                        'text' => "Koneksi Dapodik",
                        'url' => route('settings.koneksi-dapodik'),
                        'icon' => 'cog',
                    ],
                    [
                        'show' => true,
                        'text' => "Sinkronisasi Dapodik",
                        'url' => route('settings.sinkronisasi-dapodik'),
                        'icon' => 'sync',
                    ],
                    [
                        'show' => true,
                        'text' => "Jabatan",
                        'url' => route('settings.jabatan'),
                        'icon' => 'library-building',
                    ],
                    [
                        'show' => true,
                        'text' => "Users",
                        'url' => route('settings.users'),
                        'icon' => 'people',
                    ],
                    [
                        'show' => true,
                        'text' => "Aplikasi",
                        'url' => route('settings.aplikasi'),
                        'icon' => 'diamond',
                    ]
                    ,
                    [
                        'show' => $this->renderIt('super'),
                        'text' => "Aplikasi (Super)",
                        'url' => route('setting.super'),
                        'icon' => 'diamond',
                    ]
                ]
            ]
        ];
        return $data;
    }

    public function renderIt($role){
        return $this->user->hasRole($role);
    }
}

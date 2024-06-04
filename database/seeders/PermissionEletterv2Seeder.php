<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionEletterv2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name' => "atur-nomor-surat-keluar", 'display_name' => "Atur Nomor Surat Keluar", 'description' => "Membuat nomor surat keluar"],
            ['name' => "cetak-berkas-arsip", 'display_name' => "Cetak Berkas Arsip", 'description' => "Mencetak Berkas Arsip"],
            ['name' => "hapus-berkas-arsip", 'display_name' => "Hapus Berkas Arsip", 'description' => "Menghapus Berkas Arsip"],
            ['name' => "menu-arsip-keluar", 'display_name' => "Menu Arsip Keluar", 'description' => "Akses Menu arsip keluar"],
            ['name' => "menu-arsip-masuk", 'display_name' => "Menu Arsip Masuk", 'description' => "Akses Menu arsip masuk"],
            ['name' => "menu-buku-tamu", 'display_name' => "Menu Buku Tamu", 'description' => "Akses Menu buku tamu"],
            ['name' => "menu-database", 'display_name' => "Menu Database", 'description' => "Akses menu database"],
            ['name' => "menu-format-surat", 'display_name' => "Menu Format Surat", 'description' => "Akses menu format surat"],
            ['name' => "menu-izin-akses", 'display_name' => "Menu Izin Akses", 'description' => "Akses menu izin akses"],
            ['name' => "menu-kelulusan", 'display_name' => "Menu Kelulusan", 'description' => "Akses Menu Kelulusan"],
            ['name' => "menu-pencadangan", 'display_name' => "Menu Pencadangan", 'description' => "Akses menu pencadangan"],
            ['name' => "menu-pengaturan", 'display_name' => "Menu Pengaturan", 'description' => "Dapat membuka menu pengaturan"],
            ['name' => "menu-pesan-whatsapp", 'display_name' => "Menu Pesan Whatsapp", 'description' => "Akses menu pesan whatsapp"],
            ['name' => "menu-referensi-data", 'display_name' => "Menu Referensi Data", 'description' => "Akses menu referensi data"],
            ['name' => "profile-read", 'display_name' => "Read Profile", 'description' => "Read Profile"],
            ['name' => "profile-update", 'display_name' => "Update Profile", 'description' => "Update Profile"],
            ['name' => "unggah-surat-keluar", 'display_name' => "Unggah Surat Keluar", 'description' => "Mengunggah surat keluar"],
            ['name' => "unggah-surat-masuk", 'display_name' => "Unggah Surat Masuk", 'description' => "User dapat mengunggah surat masuk"],
            ['name' => "update-berkas-arsip", 'display_name' => "Update Berkas Arsip", 'description' => "Update Berkas Arsip"],
            ['name' => "users-create", 'display_name' => "Create Users", 'description' => "Create Users"],
            ['name' => "users-delete", 'display_name' => "Delete Users", 'description' => "Delete Users"],
            ['name' => "users-read", 'display_name' => "Read Users", 'description' => "Read Users"],
            ['name' => "users-update", 'display_name' => "Update Users", 'description' => "Update Users"],
            ['name' => "tagihan-arsip", 'display_name' => "Tagihan Arsip", 'description' => "Mengirim pesan tagihan arsip"],
            ['name' => "atur-nomor-surat-keluar", 'display_name' => "Atur Nomor Surat Keluar", 'description' => "Membuat nomor surat keluar"],
        ];

        foreach ($datas as $key => $data) {
            Permission::updateOrCreate([
                'name' => $data['name']
            ],$data);
        }
    }
}

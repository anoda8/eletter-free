<?php

namespace App\Settings\Pages;

use App\Models\SettingAplikasi as ModelsSettingAplikasi;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SettingAplikasiSuper extends Component
{
    #[Validate('required')]
    public $fonnteAlamatKirim, $fonnteKodeNegara, $fonnteOtorisasiUmum;
    public $fonnteBatasPesanBulanan = 0;

    public $sekilasInfo;

    public function mount(){
        $setting = ModelsSettingAplikasi::first();
        if($setting != null){
            $this->fonnteAlamatKirim = $setting->fonnte_alamat_kirim;
            $this->fonnteKodeNegara = $setting->fonnte_kode_negara;
            $this->fonnteOtorisasiUmum = $setting->fonnte_otorisasi_umum;
            $this->fonnteBatasPesanBulanan = $setting->fonnte_batas_pesan_bulanan;

            $this->sekilasInfo = $setting->sekilas_info;
        }
    }

    public function render()
    {
        return view('settings.pages.setting-aplikasi-super');
    }

    public function simpanFonnte(){
        $this->validate();
        ModelsSettingAplikasi::first()->update([
            'fonnte_alamat_kirim' => $this->fonnteAlamatKirim,
            'fonnte_kode_negara' => $this->fonnteKodeNegara,
            'fonnte_otorisasi_umum' => $this->fonnteOtorisasiUmum,
            'fonnte_batas_pesan_bulanan' => $this->fonnteBatasPesanBulanan,
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Pengaturan Fonnte Tersimpan."
        ]);
    }

    public function simpanAplikasi(){
        ModelsSettingAplikasi::first()->update([
            'sekilas_info' => $this->sekilasInfo
        ]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Pengaturan Aplikasi Tersimpan."
        ]);
    }

}

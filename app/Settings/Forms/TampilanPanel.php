<?php

namespace App\Settings\Forms;

use App\Models\SettingAplikasi;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class TampilanPanel extends Component
{
    use WithFileUploads;

    #[Validate('nullable|mimes:png|max:500')]
    public $logoPanel;

    public $namaAplikasi, $nomorAwalArsipMasuk, $nomorAwalArsipKeluar;

    public function mount(){
        $aplikasi = SettingAplikasi::first();
        $this->namaAplikasi = $aplikasi->aplikasi_nama;
        $this->nomorAwalArsipKeluar = $aplikasi->aplikasi_noawal_arsipkeluar;
        $this->nomorAwalArsipMasuk = $aplikasi->aplikasi_noawal_arsipmasuk;
    }

    public function render()
    {
        return view('settings.forms.tampilan-panel');
    }

    public function simpanTampilan(){
        $this->validate();
        if($this->namaAplikasi != null){
            SettingAplikasi::first()->update(['aplikasi_nama' => $this->namaAplikasi]);
        }
        SettingAplikasi::first()->update([
            'aplikasi_noawal_arsipkeluar' => $this->nomorAwalArsipKeluar,
            'aplikasi_noawal_arsipmasuk' => $this->nomorAwalArsipMasuk
        ]);

        if($this->logoPanel != null){
            $this->logoPanel->storeAs("images", "eletterv2.png", "public");
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Panel Aplikasi Tersimpan."
        ]);
    }
}

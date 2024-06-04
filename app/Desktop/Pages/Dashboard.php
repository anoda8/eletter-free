<?php

namespace App\Desktop\Pages;

use App\Models\ArsipKeluar;
use App\Models\ArsipKeluarFile;
use App\Models\ArsipMasuk;
use App\Models\ArsipMasukFile;
use App\Models\SettingAplikasi;
use Livewire\Component;

class Dashboard extends Component
{
    public $setting;

    public function mount(){
        $this->setting = SettingAplikasi::first();
    }

    public function render()
    {
        $newSuratMasuk = ArsipMasukFile::where('terarsip', 0)->get()->count();
        $cSuratMasuk = ArsipMasuk::where('status', null)->orWhere('status', 0)->get()->count();
        $cSuratKeluarBaru = ArsipKeluar::where('status', 0)->get()->count();
        $cSuratKeluar = ArsipKeluar::where('status', 1)->get()->count();
        return view('desktop.pages.dashboard', compact('cSuratMasuk', 'cSuratKeluar', 'cSuratKeluarBaru', 'newSuratMasuk'));
    }
}

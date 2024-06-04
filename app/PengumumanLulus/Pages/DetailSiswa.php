<?php

namespace App\PengumumanLulus\Pages;

use App\Models\PengumumanLulus;
use App\Models\SettingPengumuman;
use Carbon\Carbon;
use Livewire\Component;

class DetailSiswa extends Component
{
    public $pengLulus;

    public $enabled = false;

    public function mount($pengLulusId){
        $this->pengLulus = PengumumanLulus::with(['siswa'])->find($pengLulusId);
        $setting = SettingPengumuman::where('tahun', $this->pengLulus->tahun)->get()->first();
        if(Carbon::now()->gte($setting->waktu_pengumuman)){
            $this->enabled = true;
        }
    }

    public function render()
    {
        // dd(Carbon::now());
        $settingPengumuman = SettingPengumuman::where('tahun', $this->pengLulus->tahun)->get()->first();
        return view('pengumuman-lulus.pages.detail-siswa', compact('settingPengumuman'));
    }
}

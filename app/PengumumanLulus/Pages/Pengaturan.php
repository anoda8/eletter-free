<?php

namespace App\PengumumanLulus\Pages;

use App\Models\SettingPengumuman;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Pengaturan extends Component
{
    #[Validate('required')]
    public $tanggal, $waktu;

    public function render()
    {
        return view('pengumuman-lulus.pages.pengaturan');
    }

    public function simpanPengaturan(){
        $tahun = Carbon::parse($this->tanggal)->year;
        $tanggalWaktu = $this->tanggal." ".$this->waktu;
        SettingPengumuman::updateOrCreate([
            'tahun' => $tahun,
        ],[
            'tahun' => $tahun,
            'waktu_pengumuman' => $tanggalWaktu
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Sukses menyimpan pengumuman kelulusan."
        ]);
        $this->dispatch('close-modal', ['modalName' => "modalTambahPengaturan"]);
        $this->dispatch('refreshDatatable');
        $this->reset(['tanggal', 'waktu']);
    }
}

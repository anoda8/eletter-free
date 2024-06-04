<?php

namespace App\Databases\Pages;

use App\Models\BiodataSiswa;
use Livewire\Component;

class BiodataSiswaView extends Component
{
    public $siswa;

    public $nomorHp, $nomorHpOrtu, $nomorTelp;

    public function mount($siswaId){
        $this->siswa = BiodataSiswa::find($siswaId);
        $this->nomorTelp = $this->siswa->nomor_telepon_rumah;
        $this->nomorHp = $this->siswa->nomor_hp;
        $this->nomorHpOrtu = $this->siswa->nomor_hp_ortu;
    }

    public function render()
    {
        return view('databases.pages.biodata-siswa-view');
    }

    public function simpanDtSiswa(){
        $this->siswa->update([
            'nomor_telepon_rumah' => $this->nomorTelp,
            'nomor_hp' => $this->nomorHp,
            'nomor_hp_ortu' => $this->nomorHpOrtu
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Update data berhasil."
        ]);
    }
}

<?php

namespace App\Referensi\Pages;

use App\Models\ReferensiSiswa;
use Livewire\Component;

class ProfilSiswa extends Component
{
    public $siswaId;
    public $siswa;

    public function mount($siswaId){
        $this->siswaId = $siswaId;
        $this->siswa = ReferensiSiswa::find($this->siswaId);
    }

    public function render()
    {
        return view('referensi.pages.profil-siswa');
    }
}

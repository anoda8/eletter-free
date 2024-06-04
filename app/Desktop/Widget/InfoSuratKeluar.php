<?php

namespace App\Desktop\Widget;

use App\Models\ArsipKeluar;
use Carbon\Carbon;
use Livewire\Component;

class InfoSuratKeluar extends Component
{
    public $tanggal;
    public $suratKeluar;

    public function mount(){
        $this->tanggal = date("Y-m-d");
        $this->suratKeluar = ArsipKeluar::whereDate('created_at', $this->tanggal)->get();
    }

    public function render()
    {
        return view('desktop.widget.info-surat-keluar');
    }
}

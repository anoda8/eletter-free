<?php

namespace App\Desktop\Widget;

use App\Models\ArsipMasuk;
use Carbon\Carbon;
use Livewire\Component;

class InfoSuratMasuk extends Component
{
    public $tanggal;
    public $suratMasuk;

    public function mount(){
        $this->tanggal = Carbon::parse(date("Y-m-d"))->locale('id')->translatedFormat("l, d F Y");
        $this->suratMasuk = ArsipMasuk::whereDate('created_at', date("Y-m-d"))->get();
    }

    public function render()
    {
        return view('desktop.widget.info-surat-masuk');
    }
}

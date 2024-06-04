<?php

namespace App\Arsip\Pages;

use App\Arsip\Tables\TabelArsipMasuk;
use App\Models\ArsipMasuk as ModelsArsipMasuk;
use Livewire\Component;

class ArsipMasuk extends Component
{
    public $tahun;

    public $filterAs;

    public $tanggalAwal, $tanggalAkhir;

    public function mount(){
        $this->tahun = date("Y");
    }

    public function render()
    {
        $jmlSuratBaru = ModelsArsipMasuk::where('tahun', $this->tahun)->where('status', null)->orWhere('status', 0)->get()->count();
        return view('arsip.pages.arsip-masuk', compact('jmlSuratBaru'));
    }

}

<?php

namespace App\Mobile\Components;

use App\Models\ArsipMasuk;
use App\Models\DisposisiArsipMasuk;
use Livewire\Component;

class DisposisiView extends Component
{
    public $suratMasukId;

    public function mount($suratMasukId){
        $this->suratMasukId = $suratMasukId;
    }

    public function render()
    {
        $suratMasuk = ArsipMasuk::with('disposisi')->find($this->suratMasukId);
        $catatans = json_decode($suratMasuk->catatan);
        return view('mobile.components.disposisi-view', compact('suratMasuk', 'catatans'));
    }
}

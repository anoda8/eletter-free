<?php

namespace App\Referensi\Pages;

use App\Models\ReferensiGtk;
use Livewire\Component;

class ProfilGtk extends Component
{
    public $gtkId;
    public $gtk;

    public function mount($gtkId){
        $this->gtkId = $gtkId;
        $this->gtk = ReferensiGtk::with(['rwyPendidikanFormal', 'rwyKepangkatan'])->find($this->gtkId);
    }
    public function render()
    {
        return view('referensi.pages.profil-gtk');
    }
}

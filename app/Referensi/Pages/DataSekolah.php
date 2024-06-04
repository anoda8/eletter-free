<?php

namespace App\Referensi\Pages;

use App\Models\ReferensiSekolah;
use Livewire\Component;

class DataSekolah extends Component
{
    public $dtSekolah;

    public function mount(){
        $this->dtSekolah = ReferensiSekolah::first();
    }

    public function render()
    {
        return view('referensi.pages.data-sekolah');
    }
}

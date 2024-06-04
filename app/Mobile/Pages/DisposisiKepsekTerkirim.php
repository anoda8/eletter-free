<?php

namespace App\Mobile\Pages;

use App\Models\ArsipMasuk;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DisposisiKepsekTerkirim extends Component
{
    public $data;

    public function mount(){
        $this->data = session()->get('data');
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        $jmlSuratBaru = ArsipMasuk::where('status', 0)->get()->count();
        return view('mobile.pages.disposisi-kepsek-terkirim', compact('jmlSuratBaru'));
    }
}

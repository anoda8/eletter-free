<?php

namespace App\Mobile\Pages;

use App\Models\ArsipMasuk;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DisposisiKepsekDaftar extends Component
{
    use WithPagination;

    public $status;

    public function mount(){
        $this->status = 0;
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        $suratMasuk = ArsipMasuk::where('tahun', date("Y"))->where('status', $this->status)->paginate(10);
        if($suratMasuk->count() < 1){
            $suratMasuk = ArsipMasuk::where('tahun', date("Y"))->whereNot('status', 0)->paginate(10);
        }
        return view('mobile.pages.disposisi-kepsek-daftar', compact('suratMasuk'));
    }

    public function gotoDetail($srtMasukId){
        $this->redirect('/disposisi-kepsek/'.$srtMasukId, true);
    }

    public function updatingStatus(){
        $this->resetPage();
    }
}

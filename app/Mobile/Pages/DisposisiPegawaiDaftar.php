<?php

namespace App\Mobile\Pages;

use App\Models\BiodataPegawai;
use App\Models\DisposisiArsipMasuk;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class DisposisiPegawaiDaftar extends Component
{
    use WithPagination;

    public $user;
    public $perpage = 10;

    public $status;

    public function mount(){
        $this->user = User::with('biodataPegawai')->find(auth()->user()->id);
        $this->status = 'baru';
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        $disposisis = DisposisiArsipMasuk::where('biodata_pegawai_id', $this->user->biodataPegawai->id)->where('diterima', null)->paginate(10);
        if(($disposisis->count() == 0) || ($this->status == 'dibaca')){
            $disposisis = DisposisiArsipMasuk::where('biodata_pegawai_id', $this->user->biodataPegawai->id)->whereNot('diterima', null)->paginate(10);
        }
        return view('mobile.pages.disposisi-pegawai-daftar', compact('disposisis'));
    }

    public function gotoDetail($srtMasukId){
        $this->redirect("/disposisi-kepsek/".$srtMasukId, true);
    }
}

<?php

namespace App\Mobile\Pages;

use App\Models\BiodataSiswa;
use App\Models\PengumumanLulus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VerifikasiUserSiswa extends Component
{
    #[Validate('digits:10|numeric')]
    public $nisn;

    #[Validate('date')]
    public $tanggalLahir;

    public $segment2;

    public function mount(){
        $this->segment2 = request()->segment(2);
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        // dd($this->segment2);
        return view('mobile.pages.verifikasi-user-siswa');
    }

    public function cekBiodata(){
        $this->validate();
        $bioFound = BiodataSiswa::where('nisn', $this->nisn)->where('tanggal_lahir', $this->tanggalLahir)->get()->first();
        if($bioFound != null){
            // dd($bioFound->count());
            $password = Carbon::parse($bioFound->tanggal_lahir)->format("ddmmYY");
            // dd($this->segment2);
            if($this->segment2 == 'pengumuman-kelulusan'){
                if(Auth::attempt(array('username'=>$bioFound->nipd, 'password' => $password), true)){
                    $pengumumanLulus = PengumumanLulus::where('biodata_siswa_id', $bioFound->id)->get()->first();
                    return $this->redirect('/addons/pengumuman-lulus/'.$pengumumanLulus->id);
                }else{
                    return Response::make("Invalid login credentials, please try again.", 401);
                }
            }else{
                // return $this->redirect('/registrasi-nomor/'.$bioFound->first()->id, true);
            }
        }
    }
}

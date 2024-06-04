<?php

namespace App\Mobile\Pages;

use App\Models\BiodataSiswa;
use App\Models\RegistrasiWhatsapp;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegistrasiNomorWhatsapp extends Component
{
    public $biodataSiswaId;

    public $tersimpan = false;

    #[Validate('numeric|required')]
    public $nomorHp, $nomorHpOrtu;

    public function mount($biodataSiswaId){
        $this->biodataSiswaId = $biodataSiswaId;
    }

    #[Layout('layouts.mobile')]
    public function render()
    {
        $biodataSiswa = BiodataSiswa::find($this->biodataSiswaId);
        return view('mobile.pages.registrasi-nomor-whatsapp', compact('biodataSiswa'));
    }

    public function simpanBiodata(){
        $this->validate();

        $biodata = BiodataSiswa::find($this->biodataSiswaId);

        RegistrasiWhatsapp::create([
            'biodata_siswa_id' => $biodata->id,
            'nomor_hp_lama' => $biodata->nomor_hp,
            'nomor_hp_baru' => $this->nomorHp,
            'nomor_hp_ortu_lama' => $biodata->nomor_hp_ortu,
            'nomor_hp_ortu_baru' => $this->nomorHpOrtu
        ]);

        $biodata->update([
            "nomor_hp" => $this->nomorHp,
            "nomor_hp_ortu" => $this->nomorHpOrtu,
            "nomor_terverifikasi" => true
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Tersimpan."
        ]);

        $this->tersimpan = true;
        // $this->redirect()
    }
}

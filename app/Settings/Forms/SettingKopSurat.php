<?php

namespace App\Settings\Forms;

use App\Models\SettingKopSurat as ModelsSettingKopSurat;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingKopSurat extends Component
{
    use WithFileUploads;

    #[Validate('nullable|mimes:png|max:1024')]
    public $logo;

    public $instansiBaris1, $instansiBaris2, $namaSekolah, $alamat, $telepon, $fax, $kotaKabupaten, $kodePos, $email, $website;

    public function mount(){
        $settingKop = ModelsSettingKopSurat::first();
        if($settingKop != null){
            $this->instansiBaris1 = $settingKop->line1;
            $this->instansiBaris2 = $settingKop->line2;
            $this->namaSekolah = $settingKop->nama_sekolah;
            $this->alamat = $settingKop->alamat;
            $this->telepon = $settingKop->telepon;
            $this->fax = $settingKop->fax;
            $this->kotaKabupaten = $settingKop->kota_kabupaten;
            $this->kodePos = $settingKop->kode_pos;
            $this->email = $settingKop->email;
            $this->website = $settingKop->website;
        }
    }

    public function render()
    {
        return view('settings.forms.setting-kop-surat');
    }

    public function simpanKop(){
        $this->validate();

        $settingKop = ModelsSettingKopSurat::get()->first();

        if($this->logo != null){
            $this->logo->storeAs('images', "logo-kop.png", 'public');
        }

        $settingKop->update([
            "line1" => $this->instansiBaris1,
            "line2" => $this->instansiBaris2,
            "nama_sekolah" => $this->namaSekolah,
            "alamat" => $this->alamat,
            "telepon" => $this->telepon,
            "fax" => $this->fax,
            "kota_kabupaten" => $this->kotaKabupaten,
            "kode_pos" => $this->kodePos,
            "email" => $this->email,
            "website" => $this->website,
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Kop surat tersimpan."
        ]);
    }

    public function updatingLogo(){
        $this->logo = "....";
    }
}

<?php

namespace App\PengumumanLulus\Pages;

use App\Models\SettingPengumuman;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailPengaturan extends Component
{
    use WithFileUploads;

    public $setPengLulus;

    #[Validate('required|mimes:pdf|max:2048')]
    public $fileSk;

    public function mount($pengLulusId){
        $this->setPengLulus = SettingPengumuman::find($pengLulusId);
    }

    public function render()
    {
        return view('pengumuman-lulus.pages.detail-pengaturan');
    }

    public function uploadSk(){
        if($this->fileSk != null){
            $this->fileSk->storeAs(path: 'public/pengumuman-lulus/sk/'.$this->setPengLulus->tahun.'/', name: $this->setPengLulus->id.".pdf");
            $this->setPengLulus->update([
                'ada_sk' => true
            ]);
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Nomor Agenda baru dibuat."
            ]);
            $this->dispatch('close-modal', ["modalName" => "modalUpload"]);
            $this->reset(['fileSk']);
        }

    }
}

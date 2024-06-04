<?php

namespace App\Settings\Pages;

use App\Models\SettingCatatanDisposisi as ModsCatatan;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CatatanDisposisi extends Component
{
    #[Validate('required')]
    public $isiCatatan;

    public function render()
    {
        return view('settings.pages.catatan-disposisi');
    }

    public function simpanCatatan(){
        $this->validate();
        ModsCatatan::create([
            'catatan' => $this->isiCatatan
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('close-modal', ['modalName' => "modalTambahCatatan"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Catatan tersimpan."
        ]);
    }

    public function deleteRecord($catatanId){
        ModsCatatan::find($catatanId)->delete();
        return redirect('/settings/catatan-disposisi');
    }
}

<?php

namespace App\Bukutamu\Pages;

use App\Models\AddonsBukutamu;
use Livewire\Component;
use Livewire\WithPagination;

class ManageBukutamu extends Component
{
    use WithPagination;
    public $perpage = 12;

    public $bukutamuTerpilih;


    public function render()
    {
        $bukutamus = AddonsBukutamu::paginate($this->perpage);
        return view('bukutamu.pages.manage-bukutamu', compact('bukutamus'));
    }

    public function pilihBukutamu($bukutamuId){
        $this->bukutamuTerpilih = AddonsBukutamu::find($bukutamuId);
    }

    public function hapusBukutamu(){
        if($this->bukutamuTerpilih != null){
            $this->bukutamuTerpilih->delete();
            $this->dispatch('close-modal', ['modalName' => "modalViewBukutamu"]);

            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Bukutamu Terhapus."
            ]);

            $this->dispatch('$refresh');
        }
    }
}

<?php

namespace App\Components;

use Livewire\Component;

class RowDetailThree extends Component
{
    public $judul, $isi, $widthJudul;

    public function mount($judul, $isi, $width = 0){
        $this->judul = $judul;
        $this->isi = $isi;
        $this->widthJudul = $width;
    }

    public function render()
    {
        return view('components.row-detail-three');
    }
}

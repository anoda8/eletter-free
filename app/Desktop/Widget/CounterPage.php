<?php

namespace App\Desktop\Widget;

use App\Models\ArsipMasuk;
use Livewire\Component;

class CounterPage extends Component
{
    public $color, $number, $text, $link, $textdarklight;

    public function mount($color, $number = "0", $text = "lorem", $link = "#", $textdarklight = 0){
        $this->color = $color;
        $this->number = $number;
        $this->text = $text;
        $this->link = $link;
        $this->textdarklight = $textdarklight;
    }

    public function render()
    {

        return view('desktop.widget.counter-page');
    }

    public function gotoLink(){
        $this->redirect($this->link);
    }
}

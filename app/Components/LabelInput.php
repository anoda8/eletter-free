<?php

namespace App\Components;

use Livewire\Component;

class LabelInput extends Component
{
    public $label, $placeholder, $value, $disabled;

    public function mount($label, $value, $disabled = false, $placeholder = ""){
        $this->label = $label;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.label-input');
    }
}

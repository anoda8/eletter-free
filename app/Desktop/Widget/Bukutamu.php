<?php

namespace App\Desktop\Widget;

use App\Models\AddonsBukutamu;
use Livewire\Component;

class Bukutamu extends Component
{
    public function render()
    {
        $bukutamus = AddonsBukutamu::latest()->take(8)->get();
        return view('desktop.widget.bukutamu', compact('bukutamus'));
    }
}

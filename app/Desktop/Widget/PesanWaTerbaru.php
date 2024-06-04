<?php

namespace App\Desktop\Widget;

use App\Models\WhatsappLogs;
use Livewire\Component;

class PesanWaTerbaru extends Component
{
    public function render()
    {
        $pesan = WhatsappLogs::get()->last();
        return view('desktop.widget.pesan-wa-terbaru', compact('pesan'));
    }
}

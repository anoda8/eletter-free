<?php

namespace App\Whatsapp\Pages;

use App\Models\WhatsappLogs;
use Livewire\Component;

class RiwayatPesan extends Component
{
    public function render()
    {
        return view('whatsapp.pages.riwayat-pesan');
    }

    public function clearLog(){
        WhatsappLogs::truncate();
        $this->dispatch('close-modal', ['modalName' => "modalKonfirmasiBersihkanLog"]);
        $this->dispatch('refreshDatatable');
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Riwayat pesan dibersihkan."
        ]);
    }
}

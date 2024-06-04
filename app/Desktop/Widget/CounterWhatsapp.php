<?php

namespace App\Desktop\Widget;

use App\Models\SettingAplikasi;
use App\Models\WhatsappLogs;
use Carbon\Carbon;
use Livewire\Component;

class CounterWhatsapp extends Component
{
    public $setting;
    public $waLogsLeft;

    public $date;
    public $start, $end;

    public function mount(){
        $this->date = Carbon::now();
        $this->setting = SettingAplikasi::first();
    }

    public function render()
    {
        $start = $this->date->format("Y-m-01");
        $end = $this->date->format("Y-m-t");
        $this->waLogsLeft = ($this->setting->fonnte_batas_pesan_bulanan - WhatsappLogs::whereBetween('created_at', [$start, $end])->get()?->count());
        return view('desktop.widget.counter-whatsapp');
    }
}

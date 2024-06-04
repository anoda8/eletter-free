<?php

namespace App\Installasi\Pages;

use App\Models\SettingAplikasi;
use Livewire\Component;

class AkhiriProses extends Component
{
    public function render()
    {
        return view('installasi.pages.akhiri-proses');
    }

    public function akhiriInstallasi(){
        $setting = SettingAplikasi::first();

        $setting->update([
            'mode_installasi' => false
        ]);

        $this->redirect('/login');
    }
}

<?php

namespace App\Installasi\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Migration extends Component
{
    public function mount(){
        Artisan::call("migrate");
        Artisan::call("db:seed");
        redirect('installasi/mode-user');
    }

    public function render()
    {
        return view('installasi.pages.migration');
    }

}

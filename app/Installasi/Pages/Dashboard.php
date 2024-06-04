<?php

namespace App\Installasi\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Component;

class Dashboard extends Component
{
    // #[Session()]
    public $mode = 'database';

    public function mount(){
        switch (request()->segment(2)) {
            case 'mode-user':
                $this->mode = 'user';
                break;
            case 'mode-dapodik':
                $this->mode = 'dapodik';
                break;
            case 'mode-finish':
                $this->mode = 'finish';
                break;
            default:
                # code...
                break;
        }
    }

    #[Layout('installasi/layout')]
    public function render()
    {
        // dd($this->mode);
        return view('installasi.pages.dashboard');
    }

    #[On('change-step-user')]
    public function changeStepUser(){
        $this->mode = "user";
        // dd($this->mode);
    }
}

<?php

namespace App\Desktop\Widget;

use Livewire\Component;
use App\Traits\OnlineData;

class MessageInfo extends Component
{
    use OnlineData;
    public $listMessages, $showMessage;

    public function mount(){
        $this->listMessages = $this->getMessageInfo();
        if($this->listMessages != null){
            $randomKey = rand(0, count($this->listMessages) - 1);
            $this->showMessage = $this->listMessages[$randomKey];
        }
    }

    public function render()
    {
        return view('desktop.widget.message-info');
    }

}

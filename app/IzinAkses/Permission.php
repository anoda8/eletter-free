<?php

namespace App\IzinAkses;

use App\Models\Permission as ModelsPermission;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Permission extends Component
{
    #[Validate('required')]
    public $displayName, $name;

    public $description;

    public function render()
    {
        $this->name = str_replace(" ", "-", strtolower($this->displayName));
        return view('izin-akses.permission');
    }

    public function simpanTambahIzin(){
        $this->validate();
        ModelsPermission::create([
            'name' => $this->name,
            'display_name' => $this->displayName,
            'description' => $this->description
        ]);

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Permission created."
        ]);

        $this->dispatch('close-modal', ['modalName' => "modalTambahIzin"]);
        $this->dispatch('refreshDatatable');
        $this->reset();
    }

    public function view($permissionId){

    }

    public function delete($permissionId){
        ModelsPermission::find($permissionId)->delete();
        return redirect("/izin-akses/permission");
    }
}

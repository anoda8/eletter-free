<?php

namespace App\Desktop\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $fotoProfil;

    public $oldPassword, $newPassword, $rePassword;

    public function render()
    {
        return view('desktop.pages.profile');
    }

    public function uploadFoto(){
        $this->validate([
            'fotoProfil' => 'required|mimes:jpg,jpeg|max:500'
        ]);

        $user = auth()->user();
        $this->fotoProfil->storeAs(path: 'public/foto-profil/', name: $user->id.".jpg");

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Foto tersimpan."
        ]);
    }

    public function ubahPassword(){
        $this->validate([
            'oldPassword' => 'required',
            'newPassword' => 'min:6|required_with:rePassword|same:rePassword|different:oldPassword',
            'rePassword' => 'min:6'
        ]);

        $user = User::find(auth()->user()->id);
        if(Hash::check($this->oldPassword, $user->password)){
            $user->update([
                'password' => Hash::make($this->newPassword)
            ]);
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Password baru disimpan."
            ]);
        }else{
            $this->dispatch('show-alert', [
                'icon' => 'error', 'message' => "Password lama tidak sama."
            ]);
        }
    }
}

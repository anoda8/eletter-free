<?php

namespace App\Installasi\Pages;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserAdministrator extends Component
{
    #[Validate('required|min:3')]
    public $nama;

    #[Validate('min:6')]
    public $password;

    #[Validate('required_with:password|same:password|min:6')]
    public $password_confirmation;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|string|regex:/\w*$/|max:255', message: "Format username belum benar")]
    public $username;

    public function render()
    {
        return view('installasi.pages.user-administrator');
    }

    public function simpan(){
        $this->validate();
        $this->removeUser();
        $newUser = User::create([
            'name' => $this->nama,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password)
        ]);
        $newUser->addRole('administrator');
        //userSuper
        $superUser = User::where('username', 'super')->get()->first();
        //beri permission administrator & Super User
        $permissions = Permission::all();
        foreach ($permissions as $key => $permission) {
            $newUser->givePermission($permission->name);
            $superUser->givePermission($permission->name);
        }

        Artisan::call("storage:link");

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Suksess, User Administrator berhasil dibuat."
        ]);



        return $this->redirect('/installasi/mode-dapodik');
    }

    public function removeUser(){
        User::whereIn('username', ['administrator', 'kepsek', 'waka', 'taus', 'guru', 'siswa'])->delete();
    }
}

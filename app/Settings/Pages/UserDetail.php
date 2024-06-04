<?php

namespace App\Settings\Pages;

use App\Models\BiodataSiswa;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserDetail extends Component
{
    public $user;
    public $isPegawai = false;

    public $roles;

    #[Validate('required')]
    public $level;

    public $levelDelete;

    public $userPermissions = [];

    public function mount($userId){
        $this->user = User::find($userId);
        if(!$this->user->hasRole('siswa')){
            $this->isPegawai = true;
            $this->loadRole();
        }

        // $this->userPermissions = $this->user->allPermissions();
        foreach ($this->user->allPermissions() as $key => $prms) {
            $this->userPermissions[] = $prms->name;
        }
    }

    public function render()
    {
        $listPermission = Permission::orderBy('name', 'asc')->get()->chunk(2);
        return view('settings.pages.user-detail', compact('listPermission'));
    }

    public function simpanUser(){
        // foreach($this->userPermissions as $permission){
            $this->user->syncPermissions($this->userPermissions);
        // }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Sukses menyimpan user."
        ]);
    }

    public function aturUlangPassword(){

        if($this->user->hasRole('siswa')){

            $siswa = BiodataSiswa::where('user_id', $this->user->id)->get()->first();
            $password = Carbon::parse($siswa->tanggal_lahir)->format("ddmmYY");
            User::where('id', $this->user->id)->update([
                'password' => bcrypt($password)
            ]);

            $this->dispatch('close-modal', ['modalName' => "konfirmasiResetPassword"]);
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Sukses mereset password siswa."
            ]);
        }else{

            User::where('id', $this->user->id)->update([
                'password' => bcrypt($this->user->username)
            ]);

            $this->dispatch('close-modal', ['modalName' => "konfirmasiResetPassword"]);
            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Sukses mereset password pegawai."
            ]);
        }

    }

    public function addLevel(){
        $this->validate();
        $this->dispatch('close-modal', ["modalName" => "modalTambahLevel"]);
        if(!$this->user->hasRole($this->level)){
            $this->user->addRole($this->level);

            $this->dispatch('show-alert', [
                'icon' => 'success', 'message' => "Level berhasil ditambahkan."
            ]);
            return;
        }
        $this->dispatch('show-alert', [
            'icon' => 'error', 'message' => "Level sudah ada."
        ]);
    }

    public function selectDeleteLevel($levelDelete){
        $this->levelDelete = $levelDelete;
    }

    public function deleteLevel(){
        $this->user->removeRole($this->levelDelete);
        $this->dispatch('close-modal', ['modalName' => "konfirmasiHapusLevel"]);
        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Sukses menghapus level pegawai."
        ]);
    }

    public function loadRole(){
        $this->roles = Role::whereNotIn('name', ['siswa', 'super'])->get();
    }
}

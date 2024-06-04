<?php

namespace App\IzinAkses;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RolesView extends Component
{
    #[Validate('required')]
    public $displayName;

    public $name, $description;

    public $roles;

    public $rolePermission = [];

    public function mount($roleId){
        $this->roles = Role::find($roleId);
        $this->name = $this->roles->name;
        $this->displayName = $this->roles->display_name;
        $this->description = $this->roles->description;
        foreach ($this->roles->permissions as $key => $permission) {
            $this->rolePermission[] = $permission->name;
        }
    }

    public function render()
    {
        $listPermission = Permission::orderBy('name', 'asc')->get();
        return view('izin-akses.roles-view', compact('listPermission'));
    }

    public function simpan(){
        $this->validate();
        $this->roles->update([
            'display_name' => $this->displayName,
            'description' => $this->description
        ]);

        DB::table('permission_role')->where('role_id', $this->roles->id)->delete();

        foreach ($this->rolePermission as $key => $permission) {
            $permis = Permission::where('name', $permission)->get()->first();
            DB::table('permission_role')->updateOrInsert([
                'permission_id' => $permis->id,
                'role_id' => $this->roles->id
            ]);
        }

        $this->dispatch('show-alert', [
            'icon' => 'success', 'message' => "Role Permission updated."
        ]);
    }
}

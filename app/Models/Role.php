<?php

namespace App\Models;

use App\Traits\UUID;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    use UUID;
    public $guarded = [];
    protected $casts = [
        'id' => 'string'
    ];
}

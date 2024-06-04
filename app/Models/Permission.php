<?php

namespace App\Models;

use App\Traits\UUID;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use UUID;
    public $guarded = [];
    protected $casts = [
        'id' => 'string'
    ];
}

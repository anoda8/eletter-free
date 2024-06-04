<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDapodik extends Model
{
    use HasFactory;
    protected $table = "setting_dapodik";
    public $guarded = [];
    public $primary = 'id';
}

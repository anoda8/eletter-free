<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAplikasi extends Model
{
    use HasFactory;
    protected $table = "setting_aplikasi";
    public $guarded = [];
}

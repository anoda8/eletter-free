<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCatatanDisposisi extends Model
{
    use HasFactory;
    protected $table = 'setting_catatan_disposisi';
    public $timestamps = false;
    public $guarded = [];
}

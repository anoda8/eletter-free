<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPengumuman extends Model
{
    use HasFactory, UUID;
    protected $table = "setting_pengumuman_lulus";
    public $guarded = [];

    protected $dates = ['waktu_pengumuman'];
}

<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingJabatan extends Model
{
    use HasFactory, UUID;
    protected $table = "setting_jabatan";
    public $guarded = [];

    public function jabatanPegawai(){
        return $this->hasOne(\App\Models\JabatanPegawai::class, 'setting_jabatan_id');
    }
}

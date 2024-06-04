<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPegawai extends Model
{
    use HasFactory, UUID;
    protected $table = "jabatan_pegawai";
    public $guarded = [];

    public function pegawai(){
        return $this->belongsTo(\App\Models\BiodataPegawai::class, 'biodata_pegawai_id');
    }

    public function jabatan(){
        return $this->belongsTo(\App\Models\SettingJabatan::class, 'setting_jabatan_id');
    }
}

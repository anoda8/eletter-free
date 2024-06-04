<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiArsipMasuk extends Model
{
    use HasFactory, UUID;
    protected $table = 'arsip_masuk_disposisi';
    public $guarded = [];

    public function pegawai(){
        return $this->belongsTo(\App\Models\BiodataPegawai::class, 'biodata_pegawai_id');
    }

    public function jabatan(){
        return $this->belongsTo(\App\Models\SettingJabatan::class, 'jabatan_pegawai_id');
    }

    public function surat(){
        return $this->belongsTo(\App\Models\ArsipMasuk::class, 'arsip_masuk_id');
    }
}

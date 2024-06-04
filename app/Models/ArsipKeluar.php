<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipKeluar extends Model
{
    use HasFactory, UUID;
    protected $table = "arsip_keluar";
    public $guarded = [];

    public function klasifikasi(){
        return $this->belongsTo(\App\Models\KlasifikasiSurat::class, 'nomor_klasifikasi');
    }

    public function file(){
        return $this->hasOne(\App\Models\ArsipKeluarFile::class, 'arsip_keluar_id');
    }

    public function author(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}

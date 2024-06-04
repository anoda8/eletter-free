<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatSuratTugas extends Model
{
    use HasFactory, UUID;
    public $guarded = [];

    public function suratkeluar(){
        return $this->belongsTo(\App\Models\ArsipKeluar::class, 'surat_keluar_id');
    }

    public function arsipmasuk(){
        return $this->belongsTo(\App\Models\ArsipMasuk::class);
    }

    public function pegawai(){
        return $this->hasMany(\App\Models\FormatSuratTugasPegawai::class, 'fromat_surat_tugas_id');
    }
}

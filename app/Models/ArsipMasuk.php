<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipMasuk extends Model
{
    use HasFactory, UUID;
    protected $table = "arsip_masuk";
    public $guarded = [];

    protected $casts = [
        'tanggal_diterima' => 'datetime',
    ];

    public function klasifikasi(){
        return $this->belongsTo(\App\Models\KlasifikasiSurat::class, 'nomor_klasifikasi');
    }

    public function file(){
        return $this->hasOne(\App\Models\FileArsipMasuk::class);
    }

    public function disposisi(){
        return $this->hasMany(\App\Models\DisposisiArsipMasuk::class);
    }
}

<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPegawai extends Model
{
    use HasFactory, UUID;
    protected $table = "biodata_pegawai";
    public $guarded = [];

    public function jabatans(){
        return $this->hasMany(\App\Models\JabatanPegawai::class, 'biodata_pegawai_id');
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}

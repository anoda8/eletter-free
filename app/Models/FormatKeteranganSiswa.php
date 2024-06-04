<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatKeteranganSiswa extends Model
{
    use HasFactory, UUID;
    protected $table = "format_keterangan_siswa";
    public $guarded = [];

    public function arsipKeluar(){
        return $this->belongsTo(\App\Models\ArsipKeluar::class);
    }
}

<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanLulus extends Model
{
    use HasFactory, UUID;
    protected $table = "pengumuman_lulus";
    public $guarded = [];

    public function siswa(){
        return $this->belongsTo(\App\Models\BiodataSiswa::class, 'biodata_siswa_id');
    }
}

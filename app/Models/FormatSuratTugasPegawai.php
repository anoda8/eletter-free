<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatSuratTugasPegawai extends Model
{
    use HasFactory, UUID;
    public $guarded = [];
    protected $table = 'format_surat_tugas_pegawai';

    public function suratTugas(){
        return $this->belongsTo(\App\Models\FormatSuratTugas::class, 'format_surat_tugas_id');
    }

    public function pegawai(){
        return $this->belongsTo(\App\Models\BiodataPegawai::class, 'biodata_pegawai_id');
    }

    public function jabatan(){
        return $this->belongsTo(\App\Models\JabatanPegawai::class, 'jabatan_pegawai_id');
    }
}

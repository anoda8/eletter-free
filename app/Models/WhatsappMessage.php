<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory, UUID;
    public $guarded = [];

    public function suratKeluar(){
        return $this->belongsTo(\App\Models\ArsipKeluar::class, 'surat_keluar_id');
    }
}

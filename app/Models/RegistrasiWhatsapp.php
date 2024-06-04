<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiWhatsapp extends Model
{
    use HasFactory, UUID;
    protected $table = "whatsapp_registrasi";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}

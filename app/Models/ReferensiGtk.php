<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiGtk extends Model
{
    use HasFactory, UUID;
    protected $table = "referensi_gtk";
    protected $guarded = [];

    public function rwyPendidikanFormal(){
        return $this->hasMany(\App\Models\ReferensiPendFormal::class);
    }

    public function rwyKepangkatan(){
        return $this->hasMany(\App\Models\ReferensiKepangkatan::class);
    }
}

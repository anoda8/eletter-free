<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiPendFormal extends Model
{
    use HasFactory, UUID;
    protected $table = "referensi_pend_formal";
    protected $guarded = [];
}

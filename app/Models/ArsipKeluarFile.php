<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipKeluarFile extends Model
{
    use HasFactory, UUID;
    protected $table = "arsip_keluar_file";
    public $guarded = [];
}

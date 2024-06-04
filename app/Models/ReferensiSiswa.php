<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiSiswa extends Model
{
    use HasFactory, UUID;
    protected $table = 'referensi_siswa';
    protected $guarded = [];
}

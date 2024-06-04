<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInstansi extends Model
{
    use HasFactory, UUID;
    protected $table = "data_instansi";
    public $guarded = [];
}

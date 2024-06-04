<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory, UUID;
    public $guarded = [];
}

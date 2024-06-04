<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonsBukutamu extends Model
{
    use HasFactory, UUID;
    protected $table = "addons_bukutamu";
    public $guarded = [];

    public function bertemu(){
        return $this->belongsTo(\App\Models\BiodataPegawai::class, 'bertemu_dengan');
    }
}

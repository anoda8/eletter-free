<?php

namespace App\Traits;

use App\Models\WhatsappLogs;

trait Fonnte{

    public function sendMessage($nomor, $pesan, $kelompok){
        return ['status' => false, 'data' => null];
    }

    public function saveLogMessage($data){
        WhatsappLogs::create($data);
    }
}

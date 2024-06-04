<?php

namespace App\Traits;

use App\Models\SettingAplikasi;
use App\Models\WhatsappLogs;

trait Fonnte{

    public function sendMessage($nomor, $pesan, $kelompok){
        $settingApp = SettingAplikasi::get()->first();
        // dd($settingApp);
        if($settingApp == null){
            return false;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $settingApp->fonnte_alamat_kirim,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $nomor,
                'message' => $pesan,
                'countryCode' => $settingApp->fonnte_kode_negara, //optional
            ),
            CURLOPT_HTTPHEADER => array(
                // 'Authorization: xSiip#BVQ0#HBgn3hw28' //change TOKEN to your actual token
                'Authorization: '.$settingApp->fonnte_otorisasi_umum
            ),
          )
        );

        $response = curl_exec($curl);
        // curl_close($curl);
        $responseData = json_decode($response);

        if ($responseData->status != null) {
            $this->saveLogMessage([
                'nomor' => $nomor,
                'pesan' => $pesan,
                'kelompok' => $kelompok,
                'status' => $responseData->status,
                'log_message' => property_exists($responseData, 'detail') ? $responseData->detail : $responseData->reason
            ]);
        }

        return ['status' => $responseData != null ? true : false, 'data' => $responseData];
    }

    public function saveLogMessage($data){
        WhatsappLogs::create($data);
    }
}

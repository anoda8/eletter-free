<?php
namespace App\Traits;

use App\Models\SettingDapodik;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

trait Dapodik{
    public function dataSekolah(){
        $dapodik = SettingDapodik::first();
        $collection = $message = null;
        try{
            $get_data_ptk =  Http::acceptJson()->withToken($dapodik->key)->get('http://' . $dapodik->ip_dapodik . ':5774/WebService/getSekolah?npsn=' . $dapodik->npsn);
            $collection = json_decode($get_data_ptk);
        }catch (ConnectionException $e) {
            $message = "Koneksi gagal";
        }
        // dd($collection);
        return is_object($collection) ? $collection : $message;
    }

    public function dataDapodik($jenisData){
        $dapodik = SettingDapodik::first();
        $collection = $message = null;
        try{
            $get_data_ptk =  Http::acceptJson()->withToken($dapodik->key)->get('http://' . $dapodik->ip_dapodik . ':5774/WebService/'.$jenisData.'?npsn=' . $dapodik->npsn);
            $collection = json_decode($get_data_ptk);
        }catch (ConnectionException $e) {
            $message = "Koneksi gagal";
        }
        return is_object($collection) ? $collection : $message;
    }
}

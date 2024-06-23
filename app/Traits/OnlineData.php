<?php

namespace App\Traits;

trait OnlineData{

    public function getPangkatGolongan(){
        $dtPangkatGolongan = [
            "I/a"=> "Juru Muda",
            "I/b"=> "Juru Muda Tk.1",
            "I/c"=> "Juru",
            "I/d"=> "Juru Tk.1",
            "II/a"=> "Pengatur Muda",
            "II/b"=> "Pengatur Muda Tk.1",
            "II/c"=> "Pengatur",
            "II/d"=> "Pengatur Tk.1",
            "III/a"=> "Penata Muda",
            "III/b"=> "Penata Muda Tk.1",
            "III/c"=> "Penata",
            "III/d"=> "Penata Tk.1",
            "IV/a"=> "Pembina",
            "IV/b"=> "Pembina Tk.1",
            "IV/c"=> "Pembina Utama Muda",
            "IV/d"=> "Pembina Utama Madya",
            "IV/e"=> "Pembina Utama",
            "IX"=> ""
        ];
        // $url = "https://api.npoint.io/45998907f28e624eec57";
        // $data = $this->getMessage($url);
        // if(!isset($data['Offline'])){
        //     return $data;
        // }
        return $dtPangkatGolongan;
    }

    public function getMessageInfo(){
        $url = "https://api.npoint.io/b5eed7b33f350fd50cfc";
        $data = $this->getMessage($url);
        if(!isset($data['Offline'])){
            return $data;
        }
        return [];
    }

    public function getMessage($url) : array{
        $messages = [];
        if(($getMessage = @file_get_contents($url)) === false){
            $error = error_get_last();
            $messages = ['Tidak terhubung ke internet' => $error];
        }else{
            $messages = (array)json_decode($getMessage);
        }
        return $messages;
    }
}


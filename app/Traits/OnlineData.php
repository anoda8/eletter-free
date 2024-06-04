<?php

namespace App\Traits;

trait OnlineData{

    public function getPangkatGolongan(){
        $url = "https://api.npoint.io/45998907f28e624eec57";
        $data = $this->getMessage($url);
        if(!isset($data['error'])){
            return $data;
        }
        return [];
    }

    public function getMessageInfo(){
        $url = "https://api.npoint.io/b5eed7b33f350fd50cfc";
        $data = $this->getMessage($url);
        if(!isset($data['error'])){
            return $data;
        }
        return [];
    }

    public function getMessage($url) : array{
        $messages = [];
        if(($getMessage = @file_get_contents($url)) === false){
            $error = error_get_last();
            $messages = ['error' => $error];
        }else{
            $messages = (array)json_decode($getMessage);
        }
        return $messages;
    }
}


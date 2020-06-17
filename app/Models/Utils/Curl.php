<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Model;

class Curl extends Model
{
    private $objCurl;

    private function init(){
        $this->objCurl = curl_init();
    }
    private function close(){
        curl_close($this->objCurl);
    }

    public function get($url){
        $this->init();        
        curl_setopt_array($this->objCurl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ]);
        $result = json_decode(curl_exec($this->objCurl), true);
        $this->close();
        return $result['results'];
    }
    public function post($url, $data){
        $this->init();        
        curl_setopt_array($this->objCurl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => [
                $data
            ]
        ]);
        $result = curl_exec($this->objCurl);
        $this->close();
        return $result['results'];

    }
}

<?php

namespace App\Models\Utils;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utils\Curl;
use Illuminate\Support\Str;

class GoogleApi extends Model
{
    public static function getGeocode($address){
        $urlApiGoogle = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.env('GOOGLE_KEY');
        $curl = new Curl();
        return $curl->get($urlApiGoogle);
    }
    public static function addresGeolocation($data){
        
        $address = Str::slug($data['street'], '+').' '
            .Str::slug($data['number'], '+').' '
            .Str::slug($data['neighborhood'], '+').' '
            .Str::slug($data['city'], '+').' '
            .Str::slug($data['state'], '+');

        return Str::slug($address, '+');
    }
}

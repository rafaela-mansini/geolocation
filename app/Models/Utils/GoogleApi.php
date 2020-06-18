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
        return $curl->get($urlApiGoogle)['results'];
    }
    public static function addresGeolocation($data){
        
        $address = Str::slug($data['street'], '+').' '
            .Str::slug($data['number'], '+').' '
            .Str::slug($data['neighborhood'], '+').' '
            .Str::slug($data['city'], '+').' '
            .Str::slug($data['state'], '+');

        return Str::slug($address, '+');
    }
    public static function distance($lat, $lng){
        $urlApiGoogle = 'https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.env('INITIAL_LAT').','.env('INITIAL_LNG').'|&destinations='.$lat.','.$lng.'&key='.env('GOOGLE_KEY');
        $curl = new Curl();
        return $curl->get($urlApiGoogle)['rows'][0]['elements'][0]['distance'];        
    }
}

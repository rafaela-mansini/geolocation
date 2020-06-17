<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [ 'name', 'email', 'birth' ];

    public function adresses(){
        return $this->hasMany('App\Models\Adresses');
    }

    public static function createImport($client, $address=null){
        $clientInsert = $addressInsert = null;
        try {
            $clientInsert = Clients::create([
                'name' => $client[0],
                'email' => $client[1],
                'birth' => date('Y-m-d', strtotime($client[2])),
            ]);
    
            $addressInsert = $client->adresses()->create([
                'zipcode'       => $address[0]['address_components'][6]['long_name'],
                'street'        => $address[0]['address_components'][1]['long_name'],
                'number'        => $address[0]['address_components'][0]['long_name'],
                'neighborhood'  => $address[0]['address_components'][2]['long_name'],
                'state'         => $address[0]['address_components'][3]['short_name'],
                'city'          => $address[0]['address_components'][4]['long_name'], 
                'lat'           => $address[0]['geometry']['location']['lat'],
                'lng'           => $address[0]['geometry']['location']['lng'],
            ]);
        } catch (\Throwable $th) {
            if($clientInsert !== null) $clientInsert->delete();
            if($addressInsert !== null) $addressInsert->delete();
            return back()->withInput()->with([ 'success' => false, 'message' => 'Ops, ocorreu um erro: '.$th->getMessage() ]);
        }
    }

}

<?php

namespace App\Imports;

use App\Models\Clients;
use App\Models\Adresses;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use App\Models\Utils\GoogleApi;

class ClientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        // row retorna array de chave(todos os campos de header) com seu valor com virgulas.
        // separar as virgulas com o explode dentro da key com todos os campos informados.
        $data = explode(';', $row[key($row)]);
        
        // formato aceito para api do google é com "+" no lugar dos espaços e sem traços/virgulas
        $address = str_replace(' ', '+', str_replace(',', '', str_replace('-', '', trim($data[4]))));
        $result_address = GoogleApi::getGeocode($address);
        
        $client =  Clients::create([
            'name' => $data[0],
            'email' => $data[1],
            'birth' => date('Y-m-d', strtotime($data[2])),
        ]);
        $address = Adresses::create([
            'zipcode'       => $result_address[0]['address_components'][6]['long_name'],
            'street'        => $result_address[0]['address_components'][1]['long_name'],
            'number'        => $result_address[0]['address_components'][0]['long_name'],
            'neighborhood'  => $result_address[0]['address_components'][2]['long_name'],
            'state'         => $result_address[0]['address_components'][3]['short_name'],
            'city'          => $result_address[0]['address_components'][4]['long_name'], 
            'lat'           => $result_address[0]['geometry']['location']['lat'],
            'lng'           => $result_address[0]['geometry']['location']['lng'],
            'clients_id'    => $client->id
        ]);
        
        return $client;
        
    }
    public function headingRow():int{
        return 1;
    }

}

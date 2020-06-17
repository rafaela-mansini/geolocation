<?php

namespace App\Imports;

use App\Models\Clients;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

use App\Models\Utils\Curl;

class ClientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        // row retorna array de chave(todos os campos de header) com seu valor com virgulas.
        // separar as virgulas com o explode dentro da key com todos os campos informados.
        $data = explode(';', $row[key($row)]);
        // formato aceito para api do google é com "+" no lugar dos espaços e sem traços/virgulas
        $address = str_replace(' ', '+', str_replace(',', '', str_replace('-', '', trim($data[4]))));
        $urlApiGoogle = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.env('GOOGLE_KEY');
        $curl = new Curl();
        $result_address = $curl->get($urlApiGoogle);

        return Clients::createImport($data, $result_address);
        
    }
    public function headingRow():int{
        return 1;
    }

}

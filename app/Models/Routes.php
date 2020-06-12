<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    protected $fillable = [ 'code_shipping', 'route', 'order', 'adresses_id' ];

    public function adresses(){
        return $this->belongsTo('App\Models\Adresses');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adresses extends Model
{
    protected $fillable = [ 'zipcode', 'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'lat', 'lng', 'clients_id' ];

    public function clients(){
        return $this->belongsTo('App\Models\Clients');
    }
    public function routes(){
        return $this->hasMany('App\Models\Routes');
    }
}

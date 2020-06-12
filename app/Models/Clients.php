<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [ 'name', 'email', 'birth' ];

    public function adresses(){
        return $this->hasMany('App\Models\Adresses');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //A category has many leves
    public function levels(){
        return $this->hasMany('\App\Level');
    }
}

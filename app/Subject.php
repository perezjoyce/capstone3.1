<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //A subject has many modules
    public function modules(){
        return $this->hasMany('\App\Module');
    }

    //A subject has many sections
    public function sections(){
        return $this->hasMany('\App\Section');
    }
}

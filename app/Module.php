<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //A module has many topics
    public function topics(){
        return $this->hasMany('\App\Topic');
    }

    //A module belongs to a subject
    public function subject(){
        return $this->belongsTo('\App\Subject');
    }
}

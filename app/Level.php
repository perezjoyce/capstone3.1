<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //A level belongs to a category
    public function category(){
        return $this->belongsTo('\App\Category');
    }

    //A level has many topics
    public function topics(){
    	return $this->hasMany('\App\Topic');
    }

    //A level has many sections
    public function sections(){
    	return $this->hasMany('\App\Section');
    }
}

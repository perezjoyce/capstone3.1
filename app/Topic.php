<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //A topic belongs to a module
    public function module(){
        return $this->belongsTo('\App\Module');
    }

    //A topic belongs to a level
    public function level(){
    	return $this->belongsTo('\App\Level');
    }

    //A topic has many chapters
    public function chapters(){
    	return $this->hasMany('App\Chapter');
    }
}

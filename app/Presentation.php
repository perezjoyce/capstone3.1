<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    //A presentation has many activities
    public function activities(){
    	return $this->hasMany('\App\Activity');
    }
}

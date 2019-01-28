<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    //A purpose has many activities
    public function activities(){
    	return $this->hasMany('\App\Activity');
    }
}

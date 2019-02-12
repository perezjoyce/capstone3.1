<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //a record has many users
    public function users(){
        return $this->hasMany('\App\User');
    }

    //a record has many activities
    public function activities(){
        return $this->hasMany('\App\Activity');
    }

    // a record has many questions
    public function questions(){
        return $this->hasMany('\App\Question');
    }
}

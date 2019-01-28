<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //A chapter belongs to a topic
    public function topic(){
    	return $this->belongsTo('\App\Topic');
    }

    //A chapter has many questions
    public function questions(){
    	return $this->hasMany('\App\Question');
    }
}

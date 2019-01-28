<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //A choice belongs to a question
    public function question(){
    	return $this->belongsTo('\App\Question');
    }
}

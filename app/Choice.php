<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'choice', 'is_correct', 'question_id', 'order',
    ];

    //A choice belongs to a question
    public function question(){
    	return $this->belongsTo('\App\Question');
    }
}

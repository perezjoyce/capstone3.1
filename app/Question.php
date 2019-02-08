<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'question', 'hint', 'discussion', 'explanation', 'order', 'chapter_id', 'user_id', 'is_approved',
    ];

    //a question belongs to a user
    public function user(){
    	return $this->belongsTo('\App\User')->where('role', 'teacher')->withDefault();
    }

    //a question belongs to a chapter
     public function chapter(){
    	return $this->belongsTo('\App\Chapter');
    }

    //a question has many choices
    public function choices(){
    	return $this->hasMany('\App\Choice');
    }
}

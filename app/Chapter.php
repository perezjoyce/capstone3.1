<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{

    protected $fillable = [
        'name', 'objective', 'discussion', 'example', 'guided_practice', 'tip', 'key_point', 'topic_id',
    ];

    //A chapter belongs to a topic
    public function topic(){
    	return $this->belongsTo('\App\Topic');
    }

    //A chapter has many questions
    public function questions(){
    	return $this->hasMany('\App\Question', 'chapter_id');
    }

    //A chapter has many activities
    public function activities(){
        return $this->hasMany('\App\Activity', 'chapter_id');
    }

    //A chapter has many reports
    public function reports(){
        return $this->hasMany('\App\Report');
    }
}

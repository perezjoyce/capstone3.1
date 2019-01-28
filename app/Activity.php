<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //An activity belongs to one purpose
    public function purpose(){
    	return $this->belongsTo('\App\Purpose');
    }

    //An activity belongs to one presentation
    public function presentation(){
    	return $this->belongsTo('\App\Presentation');
    }

    //An activity belongs to one section
    public function section(){
    	return $this->belongsTo('\App\Section');
    }

    //PIVOT TABLES
    public function questions(){
        return $this->belongsToMany('\App\Question', 'activity_question')->withPivot('item_number')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany('\App\User', 'activity_user')->withPivot('score')->withTimestamps();
    }
}

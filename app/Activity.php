<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deadline'
    ];

    //An activity belongs to one chapter
    public function chapter(){
        return $this->belongsTo('\App\Chapter');
    }

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
    	return $this->belongsTo('\App\Section')->orderBy('deadline');
    }

    //PIVOT TABLES
    //CAN'T BE DONE FOR NOW. THIS NEEDS TO BE EDITED TO ACTIVITY_CHAPTER AND SHOULD BE IN A CART FORMAT SO THAT
    //TEACHERS CAN ADD MULTIPLE CHAPTERS TO ONE ACTIVITY. HOWEVER, REFLECTING RESULTS AND PROGRESS WILL BE MUCH MORE COMPLICATED THIS WAY.
    //AT THE MOMENT, I ADDED A ONE TO ONE RELATIONSHIP BETWEEN ACTIVITY AND CHAPTER.
    public function questions(){
        return $this->belongsToMany('\App\Question', 'activity_question')->withPivot('item_number')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany('\App\User', 'activity_user')->withPivot('score')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

	//A section belongs to a level
	 public function level(){
        return $this->belongsTo('\App\Level');
    }

    //A section belongs to a subject
    public function subject(){
        return $this->belongsTo('\App\Subject');
    }

    //A section has many activities
    public function activities(){
        return $this->hasMany('\App\Activity');
    }

    //PIVOT TABLE
    // a section has many users who are both teachers and students
    // a user has many sections
    public function users(){
        return $this->belongsToMany('\App\User', 'section_user')->withTimestamps();
    }





}

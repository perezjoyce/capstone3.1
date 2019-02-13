<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [
        'chapter_id', 'user_id', 'field', 'message', 'status',
    ];


    //a report belongs to a user
    public function user(){
        return $this->belongsTo('\App\User');
    }

    //a report belongs to a chapter
    public function chapter(){
        return $this->belongsTo('\App\Chapter');
    }
}

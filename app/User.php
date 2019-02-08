<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin',
    ];

    //A user has many submitted questions?
    public function questions(){
        return $this->hasMany('\App\Question');
    }

    //A user has many reports
    public function reports(){
        return $this->hasMany('\App\Report');
    }

    public function activities(){
        return $this->belongstoMany('\App\Activity');
    }


}

    class UsersModel extends Model {
        /**  https://github.com/staudenmeir/eloquent-has-many-deep#belongstomany */
        public function activities()
        {
            return $this->hasManyDeep('App\Activity', ['section_user', 'App\Section']);
        }

}





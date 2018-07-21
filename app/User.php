<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //A user has many cases
    public function case(){
        return $this->hasMany('App\Model\Case');
    }

    //A user has many case progresses
    public function caseProgress(){
        return $this->hasMany('App\Model\CaseProgress');
    }

    //A user has one device
    public function device(){
        return $this->hasOne('App\Model\Device');
    }


    //For roles middleware
    public function roles(){
        return $this->belongsToMany('App\Model\Role', 'user_role', 'user_id', 'role_id');
    }
    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}

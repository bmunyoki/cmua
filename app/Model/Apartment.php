<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model{
    //An apartment has many rooms
    public function rooms(){
    	return $this->hasMany('App\Model\Room');
    }
}

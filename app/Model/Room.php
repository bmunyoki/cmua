<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model{
    //A rooms belongs to an apartment
    public function apartment(){
    	return $this->belongsTo('App\Model\Apartment');
    }
}

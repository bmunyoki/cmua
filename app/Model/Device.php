<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model{
    protected $table = 'targets';
    
    //A device has many audios
    public function audio(){
    	return $this->hasMany('App\Model\Audio', 'recording_gsm_id');
    }

    //A device belongs to a user
    public function user(){
    	return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model{
    protected $table = 'recording_gsm';
    
    //An audio belongs to a device
    public function device(){
    	return $this->belongsTo('App\Model\Device', 'target_id');
    }

    //A audio has a case (one to one)
    public function case(){
    	return $this->hasOne('App\Model\CaseModel', 'recording_gsm_id');
    }
}

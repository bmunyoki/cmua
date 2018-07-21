<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CaseProgress extends Model{
    protected $table = "case_progress";

    //A case progress belongs to a case
    public function case(){
    	return $this->belongsTo('App\Model\CaseModel');
    }

    //A case progress belongs to a user
    public function user(){
    	return $this->belongsTo('App\User');
    }
}

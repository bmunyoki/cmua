<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model {
    protected $table = 'cases';
    
    //A case belongs to audio
    public function audio(){
    	return $this->belongsTo('App\Model\Audio', 'recording_gsm_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Model\Tag', 'case_tag', 'case_id', 'tag_id');
    }

    //A case has many case progresses
    public function caseProgress(){
    	return $this->hasMany('App\Model\CaseProgress');
    }

    //A case belongs to a user
    public function user(){
    	return $this->belongsTo('App\User');
    }
}

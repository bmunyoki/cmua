<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model{
	protected $table = 'tags';
    //A tag belongs to many cases
    public function cases(){
        return $this->belongsToMany('App\Model\CaseModel', 'case_tag', 'tag_id', 'case_id');
    }
}

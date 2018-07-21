<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomsController extends Controller{
    //Get allocated rooms
    public function getAllocatedRooms(){
    	return view('backend.allocated', [
    		'title' => 'Allocated Rooms'
    	]);
    }
}

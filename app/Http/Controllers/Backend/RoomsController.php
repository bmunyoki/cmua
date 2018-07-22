<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class RoomsController extends Controller{
    //Get allocated rooms
    public function getAllocatedRooms(){
    	$students = User::whereNotNull('room')->paginate(10);
    	return view('backend.allocated', [
    		'title' => 'Allocated Rooms',
    		'students' => $students
    	]);
    }
}

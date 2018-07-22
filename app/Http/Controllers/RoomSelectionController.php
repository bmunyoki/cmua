<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

use App\User;
use App\Model\Apartment;
use App\Model\Room;

class RoomSelectionController extends Controller{
    //Get home page
    public function getHomePage(){
    	if(!empty(Cookie::get('roomRemember'))){
    		$email = Cookie::get('roomRemember');
    		$aptName = User::where('email', $email)->value('apartment');
    		$room = User::where('email', $email)->value('room');

    		return view('room-details', [
    			'title' => 'Room Details',
    			'apartment' => $aptName,
    			'email' => $email,
    			'room' => $room
    		]);
    	}else {
    		$students = User::whereNotIn('email', ['bmunyoki@africa.cmu.edu'])->whereNull('room')->get();
	    	return view('select-room', [
	    		'title' => 'Room Selection',
	    		'students' => $students
	    	]);
    	}
    }

    //Select room
    public function selectRoom(Request $req){
    	$email = $req->input('email');
    	$aptId = $req->input('apartment');
    	$room = $req->input('rooms');
    	$aptName = User::where('email', $email)->value('apartment');

    	$desc = $this->getRoomDetails($room);

    	if(Room::where('apartment_id', $aptId)->where('number', $room)->update([
    			'taken' => 1
    		])
    	){
    		User::where('email', $email)->update(['room' => $room, 'room_description' => $desc]);
    		Cookie::queue(Cookie::make('roomRemember', $email, 10080));

    		return view('room-details', [
    			'title' => 'Room Details',
    			'success' => 'Your room selection has been recorded',
    			'apartment' => $aptName,
    			'email' => $email,
    			'room' => $room
    		]);
    	}else{
    		return Redirect::back()->withErrors(['Error selecting room', 'Error selecting room. Refresh browser and try again' ]);
    	}
    }

    public function loadStudentDetails(Request $req){
    	$apartment = User::where('email', $req->input('email'))->value('apartment');
    	$aptId = Apartment::where('name', trim($apartment))->value('id');
    	$rooms = Room::where('apartment_id', $aptId)->get();

    	$res = '';

    	$res .= '<div class="wrap-input100" style="border: none;">';
			$res .= '<span class="label-input100">Apartment:</span>';
			$res .= '<select name="apartment" id="apartment">';
				$res .= '<option value="'.$aptId.'">'.$apartment.'</option>';
			$res .= '</select>';
		$res .= '</div>';

		$res .= '<div class="wrap-input100" style="border: none;">';
			$res .= '<span class="label-input100">Room:</span>';
			$res .= '<ul class="rooms">';

				for($i = 0; $i < sizeof($rooms); $i++){
					$x = $this->getRoomDetails((int)$rooms[$i]->number);
					$res .= '<li>';
						$res .= '<label class="container">'.$rooms[$i]->number;
							if ($rooms[$i]->taken == 0) {
								$res .= '<input type="radio" name="rooms" value="'.$rooms[$i]->number.'">';
						  		$res .= '<span class="checkmark" title="Room is available"></span>';
							} else {
								$res .= '<input type="radio" name="rooms" value="'.$rooms[$i]->number.'" disabled="true">';
						  		$res .= '<span class="checkmarkd" title="Room is taken"></span>';
							}
						$res .= '</label>';
					$res .= '</li>';
				}

			$res .= '</ul>';
		$res .= '</div>';

		return $res;
    }

    public function getRoomDetails($num){
    	$ret = '';
    	if($num == '1'){
    		$ret = 'Normal';
    	}
    	if($num == '2'){
    		$ret = 'Normal';
    	}
    	if($num == '3'){
    		$ret = 'Master';
    	}
    	if($num == '4'){
    		$ret = 'Normal';
    	}
    	if($num == '5'){
    		$ret = 'Normal';
    	}

    	return $ret;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Model\Apartment;
use App\Model\Room;

class RoomSelectionController extends Controller{
    //Get home page
    public function getHomePage(){
    	$students = User::whereNotIn('email', ['bmunyoki@africa.cmu.edu'])->get();

    	return view('select-room', [
    		'title' => 'Room Selection',
    		'students' => $students
    	]);
    }


    public function loadStudentDetails(Request $req){
    	$apartment = User::where('email', $req->input('email'))->value('apartment');
    	$aptId = Apartment::where('name', trim($apartment))->value('id');
    	$rooms = Room::where('apartment_id', $aptId)->get();

    	$res = '';

    	$res .= '<div class="wrap-input100" style="border: none;">';
			$res .= '<span class="label-input100">Apartment:</span>';
			$res .= '<select name="apartment" id="apartment">';
				$res .= '<option value="'.$apartment.'">'.$apartment.'</option>';
			$res .= '</select>';
		$res .= '</div>';

		$res .= '<div class="wrap-input100" style="border: none;">';
			$res .= '<span class="label-input100">Room:</span>';
			$res .= '<ul class="rooms">';
				$res .= '<li>';
				    $res .= '<input type="radio" id="room1" name="radio-group">';
				    $res .= '<label for="room1">One</label>';
				$res .= '</li>';
				$res .= '<li>';
				    $res .= '<input type="radio" id="room2" name="radio-group">';
				    $res .= '<label for="room2">Two</label>';
				$res .= '</li>';
					$res .= '<li>';
				    $res .= '<input type="radio" id="room3" name="radio-group">';
				    $res .= '<label for="room3">Three</label>';
				$res .= '</li>';
				$res .= '</li>';
					$res .= '<li>';
				    $res .= '<input type="radio" id="room4" name="radio-group">';
				    $res .= '<label for="room4">Four</label>';
				$res .= '</li>';
				$res .= '</li>';
					$res .= '<li>';
				    $res .= '<input type="radio" id="room5" name="radio-group">';
				    $res .= '<label for="room5">Five</label>';
				$res .= '</li>';
			$res .= '</ul>';
		$res .= '</div>';

		$res .= '<div class="container-login100-form-btn">';
			$res .= '<div class="wrap-login100-form-btn">';
				$res .= '<div class="login100-form-bgbtn"></div>';
				$res .= '<button class="login100-form-btn" id="submitRoom">Submit Selection</button>';
			$res .= '</div>';
		$res .= '</div>';

		return $res;
    }
}

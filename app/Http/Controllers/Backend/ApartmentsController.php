<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Apartment;
use App\User;
use App\Model\Room;

class ApartmentsController extends Controller{
    //Get all apartments
    public function getApartments(){
        $apartments = Apartment::paginate(5);
    	return view('backend.apartments', [
    		'title' => 'Apartments',
            'apartments' => $apartments
    	]);
    }

    //Add apartment
    public function addApartment(Request $req){
    	$apartment = new Apartment();
    	$apartment->name = trim($req->input('name'));
    	$apartment->save();

    	if ($apartment->id > 0) {
    		//Add rooms
    		$this->addRooms($apartment->id);
    		return array(
    			'res' => 1,
    			'message' => 'Apartment and respective rooms added'
    		);
    	} else {
    		return array(
    			'res' => 0,
    			'message' => 'Error adding apartment'
    		);
    	}
    	
    }

    //Add rooms
    public function addRooms($apartmentId){
    	for ($i = 1; $i <= 5; $i++){
    		$desc = 'Normal';
    		if($i == 3){
    			$desc = 'Master';
    		}

    		$room = new Room();
    		$room->apartment_id = $apartmentId;
    		$room->number = $i;
    		$room->description = $desc;
    		$room->save();
    	}

    	return true;
    }
}

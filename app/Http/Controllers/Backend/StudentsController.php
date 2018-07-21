<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Model\Apartment;

use Hash;

class StudentsController extends Controller{
    //Get all students
    public function getStudents(){
    	$apartments = Apartment::get();
    	$students = User::whereNotIn('email', ['bmunyoki@africa.cmu.edu'])->orderBy('id', 'DESC')->paginate(10);

    	return view('backend.students', [
    		'title' => 'Students',
    		'apartments' => $apartments,
    		'students' => $students
    	]);
    }

    //Add a student
    public function addStudent(Request $req){
    	$student = new User();
    	$student->fname = ucfirst(strtolower($req->input('fname')));
    	$student->lname = ucfirst(strtolower($req->input('lname')));
    	$student->email = strtolower($req->input('email'));
    	$student->gender = $req->input('gender');
    	$student->apartment = $req->input('apartment');
    	$student->password = Hash::make('Student', ['rounds' => 10]);
    	$student->save();

    	if ($student->id > 0) {
    		return array(
    			'res' => 1,
    			'message' => 'Student record added'
    		);
    	} else {
    		return array(
    			'res' => 0,
    			'message' => 'Error adding student'
    		);
    	}
    }
}

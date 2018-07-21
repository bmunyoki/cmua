<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

use App\User;
use App\Model\Device;
use App\Model\Role;

class UserController extends Controller{
    //Load admins page
    public function getAdmins(){
        $devices = Device::get();
        $admins = User::where('role', 2)->paginate(10);
        return view('users.admins', [
            'title' => 'Administrators - RecReporter',
            'devices' => $devices,
            'admins' => $admins
        ]);
    }

    //Delete a user
    public function deleteUser(Request $request){
        if (User::where('id', $request->input('userId'))->delete()) {
            return array(
                'res' => 1,
                'message' => 'User deleted successfully'
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error deleting user. Referesh browser and try again'
            );
        }
        
    }

    //Update a user
    public function updateUser(Request $request){
        $targetId = Device::where('mobilenumber', $request->input('device'))->value('id');

        if (User::where('id', $request->input('userId'))->update([
            'firstname' => $request->input('fName'),
            'lastname' => $request->input('lName'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'target_id' => $targetId
        ])) {
            return array(
                'res' => 1,
                'message' => 'User details updated successfully'
            );
        } else {
            return array(
                'res' => 0,
                'message' => 'Error updating user details. Referesh browser and try again'
            );
        }
        
    }

    //Fetch user details for editing
    public function getUserDetails(Request $request){
        $user = User::where('id', $request->input('userId'))->first();
        $devices = Device::get();
        $details = '';

        if ($user) {
            $details .= '<div class="row">';
                $details .= '<div class="col-12 response">';
                $details .= '</div>';
            $details .= '</div>';
            $details .= '<div class="row">';
                $details .= '<div class="col-6">';
                    $details .= '<div class="form-group">';
                        $details .= '<label for="lname" class="col-form-label">First Name:</label>';
                        $details .= '<input type="text" class="form-control" id="uFName" name="uFName" value="'.$user->firstname.'">';
                    $details .= '</div>';
                $details .= '</div>';
                $details .= '<div class="col-6">';
                    $details .= '<div class="form-group">';
                        $details .= '<label for="lname" class="col-form-label">Last Name:</label>';
                        $details .= '<input type="text" class="form-control" id="uLName" name="uLName" value="'.$user->lastname.'">';
                    $details .= '</div>';
                $details .= '</div>';
            $details .= '</div>';

            $details .= '<div class="row">';
                $details .= '<div class="col-6">';
                    $details .= '<div class="form-group">';
                        $details .= '<label for="email" class="col-form-label">Email Address:</label>';
                        $details .= '<input type="email" class="form-control" id="uEmail" name="uEmail" value="'.$user->email.'">';
                        $details .= '<input type="hidden" class="form-control" id="uUserId" name="uUserId" value="'.$user->id.'">';
                    $details .= '</div>';
                $details .= '</div>';
                $details .= '<div class="col-6">';
                    $details .= '<div class="form-group">';
                        $details .= '<label for="phone" class="col-form-label">Personal Phone:</label><br>';
                        $details .= '<input type="text" class="form-control" id="uIntPhone" name="uIntPhone" value="'.$user->phone.'">';
                    $details .= '</div>';
                $details .= '</div>';
            $details .= '</div>';

            $details .= '<div class="row">';
                $details .= '<div class="col-6">';
                    $details .= '<div class="form-group">';
                        $details .= '<label for="device" class="col-form-label">Assigned Phone [Optional]:</label>';
                        $details .= '<select class="form-control" id="uDevice" name="uDevice">';
                            foreach($devices as $device){
                                $details .= '<option name="'.$device->mobilenumber .'">'.$device->mobilenumber.'</option>';
                            }
                            
                        $details .= '</select>';
                    $details .= '</div>';
                $details .= '</div>';
            $details .= '</div>';

            return array(
                'res' => 1,
                'details' => $details
            );
        } else {
            return array(
                'res' => 0,
                'message' => '<p style="color: red;">Failed to load user data. Refresh browser and try again</p>'
            );
        }
    }

    //Load volunteers page
    public function getVolunteers(){
        $devices = Device::get();
        $vols = User::where('role', 1)->orderBy('id', 'DESC')->paginate(4);

        return view('users.volunteers', [
            'title' => 'Volunteers - RecReporter',
            'devices' => $devices,
            'vols' => $vols
        ]);
    }

    //Create an admin
    public function createAdmin(Request $request){
        $phone = '+254'.substr($request->input('phone'), 1);
        $email = $request->input('email');

        //Check if another user has the same phone or email
        if(User::where('phone', $phone)->first()){
            return array(
                'res' => 0,
                'message' => 'The phone number entered is registered to another user'
            );
        }
        if(User::where('email', $email)->first()){
            return array(
                'res' => 0,
                'message' => 'The email address entered is registered to another user'
            );
        }

        $password = $this->randomString(8);

        $user = new User();
        $user->firstname = $request->input('fName');
        $user->lastname = $request->input('lName');
        $user->email = $request->input('email');
        $user->phone = '+254'.substr($request->input('phone'), 1);
        $user->password = Hash::make($password, ['rounds' => 12]);
        $user->role = 2;
        $user->target_id = $this->getDeviceId($request->input('device'));
        $user->save();

        if($user->id > 0){
            $user_role = Role::where('name', 'Admin')->first();
            $user->roles()->attach($user_role);

            return array(
                'res' => 1,
                'message' => 'Admin created successfully. Password: '.$password
            );

        }else{
            return array(
                'res' => 0,
                'message' => 'Error creating admin. Refresh browser and try again'
            );
        }
    }

    //Create a volunteer
    public function createVolunteer(Request $request){
        $phone = '+254'.substr($request->input('phone'), 1);
        $email = $request->input('email');

        //Check if another user has the same phone or email
        if(User::where('phone', $phone)->first()){
            return array(
                'res' => 0,
                'message' => 'The phone number entered is registered to another user'
            );
        }
        if(User::where('email', $email)->first()){
            return array(
                'res' => 0,
                'message' => 'The email address entered is registered to another user'
            );
        }
        
        $password = $this->randomString(8);

        $user = new User();
        $user->firstname = $request->input('fName');
        $user->lastname = $request->input('lName');
        $user->email = $request->input('email');
        $user->phone = '+254'.substr($request->input('phone'), 1);
        $user->password = Hash::make($password, ['rounds' => 12]);
        $user->role = 1;
        $user->target_id = $this->getDeviceId($request->input('device'));
        $user->save();

        if($user->id > 0){
            $user_role = Role::where('name', 'Vol')->first();
            $user->roles()->attach($user_role);

            return array(
                'res' => 1,
                'message' => 'Volunter created successfully. Password: '.$password
            );

        }else{
            return array(
                'res' => 0,
                'message' => 'Error creating volunteer'
            );
        }
    }

    //Get device ID 
    public function getDeviceId($phoneNumber){
        return Device::where('mobilenumber', $phoneNumber)->value('id');
    }

    //Generate random string
    public function randomString($len){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $result = "";
        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }
}

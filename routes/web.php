<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Load allocated rooms page
Route::get('/', [
    'uses' => 'RoomSelectionController@getHomePage'
]);

//Load allocated rooms page
Route::get('/home', [
    'uses' => 'RoomSelectionController@getHomePage'
]);
Route::post('/selection-details', [
    'uses' => 'RoomSelectionController@loadStudentDetails'
]);

/*
    Login Routes
*/
//Load login page
Route::get('/login', 'Auth\LoginController@getLoginPage');

//Process login request
Route::post('/login', 'Auth\LoginController@processLogin');

//Logout user
Route::get('/logout', 'Auth\LoginController@logout');


//Load allocated rooms page
Route::get('/allocated-rooms', [
    'uses' => 'Backend\RoomsController@getAllocatedRooms',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Load apartments
Route::get('/apartments', [
    'uses' => 'Backend\ApartmentsController@getApartments',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//add an apartment
Route::post('/apartments/add', [
    'uses' => 'Backend\ApartmentsController@addApartment',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Load students
Route::get('/students', [
    'uses' => 'Backend\StudentsController@getStudents',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//add a student
Route::post('/students/add', [
    'uses' => 'Backend\StudentsController@addStudent',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);




Route::get('/test', function () {
    return view('test');
});


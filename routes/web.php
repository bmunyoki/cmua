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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'Auth\LoginController@logout');

/*
    Login Routes
*/
//Load login page
Route::get('/login', 'Auth\LoginController@getLoginPage');

//Process login request
Route::post('/login', 'Auth\LoginController@processLogin');

//Logout user
Route::get('/logout', 'Auth\LoginController@logout');


/*
    Protected routes.
*/
/*
    Users
*/

//Delete a user
Route::post('/users/delete', [
    'uses' => 'Users\UserController@deleteUser',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Get user details
Route::post('/users/details', [
    'uses' => 'Users\UserController@getUserDetails',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Update a user
Route::post('/users/update', [
    'uses' => 'Users\UserController@updateUser',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Load dashboard page
Route::get('/dashboard', [
    'uses' => 'Dashboard\DashboardController@getDashboard',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);


//Post a volunteer (create)
Route::post('/users/add/volunteer', [
    'uses' => 'Users\UserController@createVolunteer',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);



Route::get('/test', function () {
    return view('test');
});


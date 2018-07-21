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
//Load change password page
Route::get('/users/change-password', [
    'uses' => 'Auth\LoginController@getChangePasswordPage',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Process change password
Route::post('/auth/change-password', [
    'uses' => 'Auth\LoginController@changePassword',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

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

//Load administrators page
Route::get('/users/administrators', [
    'uses' => 'Users\UserController@getAdmins',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Load volunteers page
Route::get('/users/volunteers', [
    'uses' => 'Users\UserController@getVolunteers',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Post a volunteer (create)
Route::post('/users/add/volunteer', [
    'uses' => 'Users\UserController@createVolunteer',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

//Post an admin (create)
Route::post('/users/add/admin', [
    'uses' => 'Users\UserController@createAdmin',
    'middleware' => 'roles',
    'roles' => ['Admin']
]);

/*
    Cases
*/
//Waiting audios 
Route::get('/cases/waiting', [
    'uses' => 'Cases\AudioController@getWaitingCases',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get audio send date 
Route::post('/cases/create/get-call-date-and-phone', [
    'uses' => 'Cases\AudioController@getAudioDateAndPhone',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Discard a recording 
Route::post('/audio/discard', [
    'uses' => 'Cases\AudioController@discardRecording',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Create a case from audio 
Route::post('/cases/create', [
    'uses' => 'Cases\AudioController@createCaseFromAudio',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get received cases
Route::get('/cases/received', [
    'uses' => 'Cases\CaseController@getReceivedCases',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get a single case
Route::get('/cases/single/{uid}', [
    'uses' => 'Cases\CaseController@getASingleCase',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Create case notes 
Route::post('/cases/single/add-notes', [
    'uses' => 'Cases\CaseController@createCaseNotes',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Close a case with closure notes
Route::post('/cases/single/close-with-notes', [
    'uses' => 'Cases\CaseController@closeCaseWithNotes',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get a single case progress page
Route::get('/cases/single/progress/{uid}', [
    'uses' => 'Cases\CaseController@getASingleCaseProgress',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get a single case
Route::get('/cases/in-progress', [
    'uses' => 'Cases\CaseController@getCasesInProgress',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Close a case 
Route::post('/cases/close', [
    'uses' => 'Cases\CaseController@closeACase',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get closed cases
Route::get('/cases/resolved', [
    'uses' => 'Cases\CaseController@getResolvedCases',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);


/*
| Dashboard Routes
*/

//Get Dashboars stats
Route::post('/dashboard/get-stats', [
    'uses' => 'Dashboard\DashboardController@getDashboardStats',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Load bar chart
Route::post('/dashboard/bar-chart', [
    'uses' => 'Dashboard\DashboardController@getBarChart',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Load pie chart
Route::post('/dashboard/pie-chart', [
    'uses' => 'Dashboard\DashboardController@getPieChart',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Load prevalence map
Route::post('/dashboard/prevalence-map', [
    'uses' => 'Dashboard\DashboardController@getPrevalenceMap',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get custom report page 
Route::get('/reports/custom', [
    'uses' => 'Reports\ReportsController@getCustomReports',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);

//Get custom report with parameters
Route::get('/reports/custom/generate', [
    'uses' => 'Reports\ReportsController@generateCustomizedReport',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);


Route::get('/test', function () {
    return view('test');
});
//Close a case 
Route::get('/test2', [
    'uses' => 'Dashboard\DashboardController@getBarChart',
    'middleware' => 'roles',
    'roles' => ['Vol', 'Admin']
]);


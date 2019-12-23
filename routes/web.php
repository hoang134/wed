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

//Route::get('/', function () {
//    return view('welcome');
//});

// Login
Route::get('/', 'LoginController@login');
Route::post('login', 'LoginController@dologin');
// Register
Route::get('registration', 'RegistrationController@index');
Route::post('registration', 'RegistrationController@registration');
Route::get('subject-register', 'RegistrationController@subjectRegister');
Route::delete('registration', 'RegistrationController@registrationDelete');
Route::get('exam-register', 'RegistrationController@examRegister');
// Search
Route::post('search', 'RegistrationController@searchResign');

// Admin
Route::resource('subjects', 'SubjectController');


//Route::get('data', function () {
////    $u = new User();
////    $u->username = "hoang";
////    $u->password = bcrypt('a123456');
////    $u->save();
//
//    $u = User::find(1);
//    $u->subjects()->detach(2);
//});

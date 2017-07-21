<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['namespace'=>'Api'],function(){

    /*************** Seeker Routes ****************/
    Route::post('/register-new-seeker','SeekerController@registerSeeker');
    Route::get('register-seeker/confirm/{token}', 'SeekerController@confirmEmail');
    Route::post('login-seeker', 'SeekerController@loginSeeker');
    Route::get('/general','SeekerController@generalInfo');
    Route::post('fill-seeker-profile', 'SeekerController@fillSeekerProfile');

    /*************** Recruiter Routes ****************/
    Route::post('/register-new-recruiter','RecruiterController@registerRecruiter');
    Route::get('register-recruiter/confirm/{token}', 'RecruiterController@recruiterConfirmEmail');
    Route::post('/recruiter-login','RecruiterController@loginRecruiter');
    Route::post('/fill-recruiter-profile','RecruiterController@fillRecruiterProfile');
    Route::post('/post-job','RecruiterController@postNewJob');

});
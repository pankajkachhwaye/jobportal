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
    Route::post('fill-seeker-profile', 'SeekerController@fillSeekerProfile');
    Route::post('/active-jobs', 'SeekerController@activeJobs');
    Route::post('/apply-on-job', 'SeekerController@applyOnJob');
    Route::post('/seeker-change-password', 'SeekerController@seekerChangePassword');

    /*************** Recruiter Routes ****************/
    Route::post('/register-new-recruiter','RecruiterController@registerRecruiter');
    Route::get('register-recruiter/confirm/{token}', 'RecruiterController@recruiterConfirmEmail');
    Route::post('/recruiter-login','RecruiterController@loginRecruiter');
    Route::post('/fill-recruiter-profile','RecruiterController@fillRecruiterProfile');
    Route::post('/post-job','RecruiterController@postNewJob');
    Route::post('/get-recruiter-jobs','RecruiterController@getRecruiterJobs');
    Route::post('/job-application','RecruiterController@getJobApplications');
    Route::post('/recruiter-change-password', 'RecruiterController@recruiterChangePassword');


    /*************** Common Routes ****************/
    Route::get('/general','CommonController@basicInformation');
    Route::post('/forgot-password','CommonController@forgotPassword');


});
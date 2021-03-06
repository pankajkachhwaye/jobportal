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
    Route::post('/single-job-detail', 'SeekerController@singleJobDeatils');
    Route::post('/apply-on-job', 'SeekerController@applyOnJob');
    Route::post('/seeker-change-password', 'SeekerController@seekerChangePassword');
    Route::post('/search-job', 'SeekerController@searchJob');
    Route::post('/search-web-job', 'SeekerController@searchwebJob');
    Route::post('auth-seeker', 'SeekerController@getAuthSekeer')->middleware('jwt.auth');
    Route::post('logout-seeker', 'SeekerController@logoutSekeer')->middleware('jwt.auth');;


    /*************** Recruiter Routes ****************/
    Route::post('/register-new-recruiter','RecruiterController@registerRecruiter');
    Route::get('register-recruiter/confirm/{token}', 'RecruiterController@recruiterConfirmEmail');
    Route::post('/recruiter-login','RecruiterController@loginRecruiter');
    Route::post('/fill-recruiter-profile','RecruiterController@fillRecruiterProfile');
    Route::post('/post-job','RecruiterController@postNewJob');
    Route::post('/delete-job','RecruiterController@deleteJob');
    Route::post('/get-recruiter-jobs','RecruiterController@getRecruiterJobs');
    Route::post('/job-application','RecruiterController@getJobApplications');
    Route::post('/get-recruiter-job-detail','RecruiterController@getRecruiterJobDetail');
    Route::post('/recruiter-change-password', 'RecruiterController@recruiterChangePassword');
    Route::post('/seeker-profile-detail-on-job', 'RecruiterController@seekerProfileDetailOnJob');
    Route::post('/image-test', 'RecruiterController@test');
    Route::post('auth-recruiter', 'RecruiterController@getAuthRecruiter')->middleware('jwt.auth');
    Route::post('logout-recruiter', 'RecruiterController@logoutRecruiter')->middleware('jwt.auth');


    /*************** Common Routes ****************/
    Route::get('/general','CommonController@basicInformation');
    Route::post('/forgot-password','CommonController@forgotPassword');
    Route::post('/get-all-notifications','CommonController@getAllNotifications');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user', 'RecruiterController@getAuthUser');


    });

});
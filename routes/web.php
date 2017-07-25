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

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/dashboard','AdminController@index');
    Route::get('/all-user','AdminController@getAllUser');

    Route::get('/location','AdminController@location');
    Route::post('/add-new-location','AdminController@postLocation');
    Route::get('/area-of-sectors','AdminController@areaOfSectors');
    Route::post('/add-new-area-of-sector','AdminController@postAreaOfSectors');
    Route::get('/specialization','AdminController@specialization');
    Route::post('/add-new-specialization','AdminController@postSpecialization');
    Route::get('/qualification','AdminController@qualification');
    Route::post('/add-new-qualification','AdminController@postQualification');
    Route::get('/job-by-role','AdminController@jobByRoles');
    Route::post('/add-new-job-role','AdminController@postJobByRoles');
    Route::get('/job-types','AdminController@jobTypes');
    Route::post('/add-new-job-type','AdminController@postJobType');

});


Route::group(['namespace' => 'Admin','prefix'=>'recruiter'], function () {
    Route::get('/all-recruiter','ManageRecruiterController@getAllRecruiter');
    Route::get('/view-details/{id}','ManageRecruiterController@recruiterViewDetails');
});

Route::group(['namespace' => 'Api'],function (){
   Route::get('api-details','ApiController@index');
   Route::get('seeker-register','ApiController@seekerregister');
   Route::get('seeker-login','ApiController@showSeekerLogin');
   Route::get('seeker-profile','ApiController@showSeekerProfileForm');
   Route::get('recruiter-register','ApiController@recruiterRegister');
   Route::get('recruiter-login','ApiController@showRecruiterLogin');
   Route::get('recruiter-profile','ApiController@showRecruiterProfileForm');
   Route::get('post-new-job','ApiController@showPostJobForm');
   Route::get('active-jobs','ApiController@showActiveJobsForm');
   Route::get('apply-for-job','ApiController@showApplyForJobForm');
});

//


Auth::routes();





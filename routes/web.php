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
    Route::get('/location','AdminController@location');
    Route::post('/add-new-location','AdminController@postLocation');
    Route::get('/area-of-sectors','AdminController@areaOfSectors');
    Route::post('/add-new-area-of-sector','AdminController@postAreaOfSectors');
});


Auth::routes();





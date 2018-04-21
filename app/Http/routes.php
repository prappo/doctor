<?php

use App\Http\Controllers\CoreController;

Route::get('/', function () {
    return redirect('user/home');
});


Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/home','HomeController@index');
    Route::get('/user/add','UserController@addUserIndex');
    Route::post('/user/add','UserController@addUser');
    Route::post('/call','CallController@call');
    Route::post('/call/decline','CallController@decline');
    Route::post('/call/confirm','CallController@confirm');
    Route::post('/call/done','CallController@done');
    Route::post('/call/sync','CallController@sync');

    });


});

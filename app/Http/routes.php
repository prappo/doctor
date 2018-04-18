<?php

use App\Http\Controllers\CoreController;

Route::get('/', function () {
    return redirect('user/home');
});


Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/home','HomeController@index');

    });


});

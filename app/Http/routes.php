<?php

use App\Http\Controllers\CoreController;

Route::get('/', function () {
    return redirect('user/home');
});


Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/user/home', 'HomeController@index');
        Route::get('/user/add', 'UserController@addUserIndex');
        Route::post('/user/add', 'UserController@addUser');
        Route::post('/user/update', 'UserController@updateUser');
        Route::get('/user/edit/{id}', 'UserController@editUser');
        Route::post('/admin/user/delete', 'UserController@deleteUser');
        Route::get('/admin/user/edit', 'UserController@viewUsers');
        Route::post('/call', 'CallController@call');
        Route::post('/call/decline', 'CallController@decline');
        Route::post('/call/confirm', 'CallController@confirm');
        Route::post('/call/done', 'CallController@done');
        Route::post('/call/sync', 'CallController@sync');
        Route::get('/prescription', 'PrescriptionController@index');
        Route::get('/prescription/download', 'PrescriptionController@download');
        Route::post('/prescription/get', 'PrescriptionController@getPrescription');
        Route::get('/user/prescription/{pId}', 'PrescriptionController@getPrescriptionById');
        Route::get('/user/prescriptions', 'PrescriptionController@myPrescriptions');
        Route::get('/doctor/service', 'UserController@serviceLogs');
        Route::get('/user/profile', 'UserController@profile');

        Route::get('/settings/seed', 'SettingsController@seed');

        Route::get('/category/add', 'CategoryController@addIndex');

        Route::post('/category/assign', 'CategoryController@assign');
        Route::post('/category/add', 'CategoryController@add');
        Route::get('/doctor/category/{cat}', 'HomeController@doctors');
        Route::get('/user/calls', 'UserController@calls');
        Route::get('/admin/user/settings/update', 'SettingsController@index');
        Route::post('/settings/update', 'SettingsController@update');

    });


});

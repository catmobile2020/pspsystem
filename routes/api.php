<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::post('login', 'AuthController@login');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('reset-password', 'AuthController@resetPassword');
        });
    });
    Route::group(['middleware'=>['auth:api']],function (){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/me','ProfileController@me');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');
        });

        Route::get('/patients/{patient}','PatientController@show');
        Route::get('/patients/{patient}/orders','PatientController@patientOrders');

    });
});

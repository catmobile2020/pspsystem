<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth/{guard}'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('reset-password', 'AuthController@resetPassword');
    });

        Route::group(['prefix' => 'account/{guard}'], function () {
            Route::get('/me','ProfileController@me');
            Route::get('/my-product','ProfileController@accountProduct');
            Route::get('/my-products','ProfileController@companyProducts');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');
            Route::get('/my-patients-cards','ProfileController@myPatientsCards');
        });
    Route::group(['middleware'=>['auth:api']],function (){
        Route::get('/my-patients','PatientController@index');
        Route::get('/patients/{patient}','PatientController@show');
        Route::get('/patients/{patient}/orders','PatientController@patientOrders');

        Route::get('/companies','CompanyController@index');
        Route::get('/companies/{company}','CompanyController@show');
        Route::get('/companies/{company}/products','CompanyController@companyProducts');

        Route::get('/products','ProductController@index');
        Route::get('/products/{product}','ProductController@show');
        Route::get('/products/{product}/patients','ProductController@productPatients');
    });
});

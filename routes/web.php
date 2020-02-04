<?php

use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'/admin'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','AdminController@index')->name('admin.login');
        Route::post('/login','AdminController@login')->name('admin.login');
        Route::get('/logout','AdminController@logout')->name('admin.logout');
    });

    Route::group(['middleware'=>['auth:admin']],function (){
        Route::get('/','HomeController@index')->name('home');
//        Route::get('/novartis-programs','HomeController@myPrograms')->name('novartis.programs');

//        Route::get('/profile','ProfileController@index')->name('profile');
//        Route::post('/profile','ProfileController@update')->name('profile.update');


        Route::group(['middleware'=>'type:admin'],function (){
            Route::resource('programs','ProgramController');

            Route::resource('companies','CompanyController');

            Route::resource('products','ProductController');

            Route::resource('companies/{company}/marketing','CompanyUsersController');

            Route::resource('pharmacies','PharmacyController');
            Route::get('pharmacies/{pharmacy}/destroy','PharmacyController@destroy')->name('pharmacies.destroy');

            Route::resource('callcenters','CallCenterController');
            Route::get('callcenters/{callcenter}/destroy','CallCenterController@destroy')->name('callcenters.destroy');

            Route::get('callcenters/companies/{company}','CallCenterController@companyProducts')->name('callcenters.company-products');

//            Route::get('adverse-reporting','AdverseController@index')->name('adverse-reporting.index');
        });

    });
});

//marketing routes

Route::group(['prefix'=>'/marketing'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','CompanyUsersController@index')->name('marketing.login');
        Route::post('/login','CompanyUsersController@login')->name('marketing.login');
        Route::get('/logout','CompanyUsersController@logout')->name('marketing.logout');
    });

    Route::group(['middleware'=>['auth:marketing']],function (){
        Route::get('/','HomeController@index')->name('home');
        Route::get('/statistics','StatisticController@index')->name('statistics.index');
        Route::get('/statistics/{product}','StatisticController@product')->name('statistics.product');
    });
});

//pharmacy routes

Route::group(['prefix'=>'/pharmacy'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','PharmacyController@index')->name('pharmacy.login');
        Route::post('/login','PharmacyController@login')->name('pharmacy.login');
        Route::get('/logout','PharmacyController@logout')->name('pharmacy.logout');
    });
//
    Route::group(['middleware'=>['auth:pharmacy']],function (){
        Route::get('/','HomeController@index')->name('home');

        Route::resource('users','PharmacyUsersController');
        Route::get('/users/{user}/orders','PharmacyUsersController@pharmacistOrders')->name('single-user.orders');
//        Route::get('/companies/{single}','OrderController@company')->name('single-company');
//        Route::get('/companies/{single}/orders','OrderController@index')->name('orders.index');
//
////        Route::resource('orders','OrderController');
//        Route::get('products/{single}/orders','OrderController@create')->name('orders.create');
//        Route::post('products/{single}/orders','OrderController@store')->name('orders.store');
//        Route::get('orders/foc/activate','OrderController@foc')->name('orders.foc');
//        Route::post('orders/foc/activate','OrderController@postFoc')->name('orders.foc');

    });
});

//pharmacy users routes

Route::group(['prefix'=>'/pharmacyUsers'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','PharmacyUsersController@index')->name('pharmacyUsers.login');
        Route::post('/login','PharmacyUsersController@login')->name('pharmacyUsers.login');
        Route::get('/logout','PharmacyUsersController@logout')->name('pharmacyUsers.logout');
    });

    Route::group(['middleware'=>['auth:pharmacyUsers']],function (){
        Route::get('/','HomeController@index')->name('home');

        Route::get('/companies/{single}','OrderController@company')->name('single-company');
        Route::get('/companies/{single}/orders','OrderController@index')->name('orders.index');

//        Route::resource('orders','OrderController');
        Route::get('products/{single}/orders','OrderController@create')->name('orders.create');
        Route::post('products/{single}/orders','OrderController@store')->name('orders.store');
        Route::get('orders/foc/activate','OrderController@foc')->name('orders.foc');
        Route::post('orders/foc/activate','OrderController@postFoc')->name('orders.foc');
    });
});



Route::group(['prefix'=>'/callcenter'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','CallCenterController@index')->name('callcenter.login');
        Route::post('/login','CallCenterController@login')->name('callcenter.login');
        Route::get('/logout','CallCenterController@logout')->name('callcenter.logout');
    });
    Route::group(['middleware'=>['auth:callcenter']],function (){
        Route::get('/','HomeController@index')->name('home');

//        Route::get('/profile','ProfileController@index')->name('profile');
//        Route::post('/profile','ProfileController@update')->name('profile.update');

        Route::group(['middleware'=>'type:callcenter'],function (){

            Route::resource('doctors','DoctorController');
            Route::get('doctors/{doctor}/destroy','DoctorController@destroy')->name('doctors.destroy');
            Route::get('doctors/{doctor}/cards','DoctorController@cards')->name('doctors.cards');

            Route::resource('patients','PatientController');
            Route::get('patients/{patient}/destroy','PatientController@destroy')->name('patients.destroy');
            Route::get('patients/check/serial-code','PatientController@checkSerial')->name('patients.check-serial');

//            Route::resource('pharmacies','PharmacyController');
//            Route::get('pharmacies/{pharmacy}/destroy','PharmacyController@destroy')->name('pharmacies.destroy');

            Route::resource('laboratories','LaboratoryController');
            Route::get('laboratories/{laboratory}/destroy','LaboratoryController@destroy')->name('laboratories.destroy');

            Route::resource('hospitals','HospitalController');
            Route::get('hospitals/{hospital}/destroy','HospitalController@destroy')->name('hospitals.destroy');

            Route::resource('eyes','EyeController');
            Route::get('eyes/{eye}/destroy','EyeController@destroy')->name('eyes.destroy');

            Route::get('patient/tests/{patient}','TestController@getTests')->name('patient.tests');
            Route::get('patient/tests/{patient}/create','TestController@createTest')->name('patient.tests.create');
            Route::post('patient/tests/{patient}','TestController@storeTest')->name('patient.tests.store');


            Route::get('patient/examinations/{patient}','ExaminationController@getTests')->name('patient.examinations');
            Route::get('patient/examinations/{patient}/create','ExaminationController@createTest')->name('patient.examinations.create');
            Route::post('patient/examinations/{patient}','ExaminationController@storeTest')->name('patient.examinations.store');


            Route::get('patient/vouchers/{patient}','VoucherController@index')->name('patient.vouchers');
            Route::get('patient/vouchers/{patient}/create','VoucherController@create')->name('patient.vouchers.create');
            Route::post('patient/vouchers/{patient}','VoucherController@store')->name('patient.vouchers.store');

            Route::get('adverse-reporting','AdverseController@create')->name('adverse-reporting.create');
            Route::post('adverse-reporting','AdverseController@store')->name('adverse-reporting.store');
        });

    });
});

Route::get('adverse-reporting','AdverseController@index')->name('adverse-reporting.index');

//Route::group(['prefix'=>'/user'],function (){
//    Route::group(['namespace'=>'Auth'],function (){
//        Route::get('/login','UserController@index')->name('user.login');
//        Route::post('/login','UserController@login')->name('user.login');
//        Route::get('/logout','UserController@logout')->name('user.logout');
//    });
//
//    Route::group(['middleware'=>['auth:web']],function (){
//        Route::get('/','HomeController@index')->name('home');
////        Route::resource('orders','OrderController');
////        Route::get('orders/foc/activate','OrderController@foc')->name('orders.foc');
////        Route::post('orders/foc/activate','OrderController@postFoc')->name('orders.foc');
//
//        Route::get('tests','TestController@patientTestsIndex')->name('tests.index');
//        Route::post('tests/{test}/upload-result','TestController@uploadPatientResult')->name('patient.upload-test.result');
//
//
//        Route::get('examinations','ExaminationController@patientTestsIndex')->name('examinations.index');
//        Route::post('examinations/{examination}/upload-result','ExaminationController@uploadPatientResult')->name('examinations.patient.upload-test.result');
//
//        Route::get('doctor/patients','DoctorController@getPatients')->name('doctor.patients.index');
//
//        Route::get('vouchers/index','VoucherController@myVouchers')->name('vouchers.myVouchers');
//        Route::get('vouchers/search','VoucherController@searchVoucher')->name('vouchers.search');
//        Route::post('vouchers/search','VoucherController@testVoucher')->name('vouchers.test');
//    });
//});


Route::get('/','HomeController@welcome')->name('home');


// Doctor And Patient routes
Route::group(['prefix'=>'/users'],function (){
    Route::group(['namespace'=>'Auth'],function (){
        Route::get('/login','UserController@index')->name('users.login');
        Route::post('/login','UserController@login')->name('users.login');
        Route::get('/logout','UserController@logout')->name('users.logout');
    });
//
    Route::group(['middleware'=>['auth:web']],function (){
        Route::get('/','HomeController@index')->name('home');
        Route::get('doctors/{doctor}/cards','PatientOrderController@cards')->name('doctor.patients-cards');
        Route::get('my-orders','PatientOrderController@index')->name('my-orders.index');
        Route::get('single/patient-orders/{user}','PatientOrderController@singlePatient')->name('my-orders.singlePatient');
        Route::get('product-patients','PatientOrderController@productPatients')->name('product-patients.index');



//        Route::get('/companies/{single}','OrderController@company')->name('single-company');
//        Route::get('/companies/{single}/orders','OrderController@index')->name('orders.index');

//        Route::resource('orders','OrderController');
//        Route::get('products/{single}/orders','OrderController@create')->name('orders.create');
//        Route::post('products/{single}/orders','OrderController@store')->name('orders.store');
//        Route::get('orders/foc/activate','OrderController@foc')->name('orders.foc');
//        Route::post('orders/foc/activate','OrderController@postFoc')->name('orders.foc');

    });
});

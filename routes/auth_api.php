<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
 
    Route::apiResource('users/addresses', "AddressApiController")->middleware(['auth']);

    Route::get('tables', 'TableApiController@search');
    
    Route::group([
        'namespace' => 'Auth',
        // 'middleware' => 'auth'
    ], function () {
        Route::get('/my-orders', 'OrderTenantController@index');
        Route::post('/orders', 'OrderTenantController@store');
        Route::patch('/my-orders', 'OrderTenantController@update');
 
        Route::get('/products/{flag}', 'OrderTenantController@product');
        Route::get('/products', 'OrderTenantController@products');
        
        Route::get('/clients', 'ClientController@search');
        Route::post('/clients', 'ClientController@store');

        Route::get('/users/deliverymen', 'UserApiController@deliverymen');
    });

    // Form Payments
    Route::get('form-payments/{FormPayment}', 'FormPaymentApiController@show');
    Route::put('form-payments/{FormPayment}', 'FormPaymentApiController@update');
    Route::get('form-payments', 'FormPaymentApiController@index');
    Route::post('form-payments', 'FormPaymentApiController@store');
    Route::delete('form-payments/{flagFormPayment}', 'FormPaymentApiController@destroy');


});

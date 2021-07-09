<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
 
    Route::apiResource('users/addresses', "AddressApiController")->middleware(['auth']);

    Route::group([
        'namespace' => 'Auth',
        // 'middleware' => 'auth'
    ], function () {
        Route::get('/my-orders', 'OrderTenantController@index');
        Route::patch('/my-orders', 'OrderTenantController@update');
 
        Route::get('/products/{flag}', 'OrderTenantController@product');
        Route::get('/products', 'OrderTenantController@products');
        
        Route::get('/clients', 'ClientController@search');
        Route::post('/clients', 'ClientController@store');
    });

    // Form Payments
    Route::get('tenants/{flagTenant}/form-payments/{FormPayment}', 'FormPaymentApiController@show');
    Route::put('tenants/{flagTenant}/form-payments/{FormPayment}', 'FormPaymentApiController@update');
    Route::get('tenants/{flagTenant}/form-payments', 'FormPaymentApiController@index');
    Route::post('tenants/{flagTenant}/form-payments', 'FormPaymentApiController@store');
    Route::delete('tenants/{flagTenant}/form-payments/{flagFormPayment}', 'FormPaymentApiController@destroy');

});

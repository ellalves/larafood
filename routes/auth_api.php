<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/my-orders', 'Auth\OrderTenantController@index')->middleware(['auth']);
    Route::patch('/my-orders', 'Auth\OrderTenantController@update')->middleware(['auth']);
    Route::apiResource('users/addresses', "AddressApiController")->middleware(['auth']);

    // Form Payments
    Route::get('tenants/{flagTenant}/form-payments/{FormPayment}', 'FormPaymentApiController@show');
    Route::put('tenants/{flagTenant}/form-payments/{FormPayment}', 'FormPaymentApiController@update');
    Route::get('tenants/{flagTenant}/form-payments', 'FormPaymentApiController@index');
    Route::post('tenants/{flagTenant}/form-payments', 'FormPaymentApiController@store');
    Route::delete('tenants/{flagTenant}/form-payments/{flagFormPayment}', 'FormPaymentApiController@destroy');

});

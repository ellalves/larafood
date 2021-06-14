<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/clients', 'Api\Auth\ClientController@store');
Route::post('/auth/token', 'Api\Auth\AuthClientController@auth');

Route::post('/contact', 'Api\ContactController@sendContact');

Route::group([
    'middleware' => ['auth:sanctum']
], function() {
    Route::post('/auth/clients/logout', 'Api\Auth\AuthClientController@logout');
    Route::get('/auth/clients/me', 'Api\Auth\AuthClientController@me');

    // Route::post('/v1/orders/{identify}/evaluations', 'Api\EvaluationApiController@store');

    // Route::get('/v1/clients/my-orders', 'Api\OrderApiController@myOrders');
    Route::post('/auth/tenants/{uuid}/orders', 'Api\OrderApiController@store');

});


Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function() {
        Route::post('orders/{identify}/evaluations', 'EvaluationApiController@store');

        Route::get('clients/my-orders', 'OrderApiController@myOrders');

        Route::apiResource('addresses', "AddressApiController");
    });

    //Coupon
    Route::get('tenants/{flagTenant}/verify/{coupon}', 'CouponController@verify');
    Route::get('tenants/{flagTenant}/coupons/{flagCoupon}', 'CouponController@show');
    Route::put('tenants/{flagTenant}/coupons/{flagCoupon}', 'CouponController@update');
    Route::get('tenants/{flagTenant}/coupons', 'CouponController@index');
    Route::post('tenants/{flagTenant}/coupons', 'CouponController@store');
    Route::delete('tenants/{flagTenant}/coupons/{flagCoupon}', 'CouponController@destroy');

    // Tenants
    Route::get('tenants/{uuid}', 'TenantApiController@show');
    Route::get('tenants', 'TenantApiController@index');

    Route::get('tenants/{uuid}/categories/{flag}', 'CategoryApiController@categoryByTenant');
    Route::get('tenants/{uuid}/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('tenants/{uuid}/tables/{identify}', 'TableApiController@tableByTenant');
    Route::get('tenants/{uuid}/tables', 'TableApiController@tablesByTenant');

    Route::get('tenants/{uuid}/products/{flag}', 'ProductApiController@productByFlag');
    Route::get('tenants/{uuid}/products', 'ProductApiController@productsByTenant');

    // Route::get('tenants/{uuid}/orders/{identify}', 'OrderApiController@show');
    Route::get('orders/{identify}', 'OrderApiController@show');
    Route::post('tenants/{uuid}/orders', 'OrderApiController@store');
});

Route::fallback(function(){
    return response()->json([
        'message' => __('Page not found. If the error persists, contact') . ' ' . config('acl.admins')[0]], 404);
});
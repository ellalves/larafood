<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    // Tenants
    Route::get('tenants/{uuid}', 'TenantApiController@show');
    Route::get('tenants/{uuid}/categories', 'CategoryApiController@categoriesByTenant');
    Route::get('tenants/{uuid}/tables', 'TableApiController@tablesByTenant');
    Route::get('tenants/{uuid}/products', 'ProductApiController@productsByTenant');
    Route::get('tenants/{uuid}/products/{flag}', 'ProductApiController@productByFlag');
    Route::get('tenants', 'TenantApiController@index');

});

Route::fallback(function(){
    return response()->json([
        'message' => 'Página não encontrada. Se o erro persistir, entre em contato com ' . config('acl.admins')[0]], 404);
});
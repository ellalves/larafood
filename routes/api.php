<?php

use Illuminate\Support\Facades\Route;

// Tenants
Route::get('tenants/{uuid}', 'Api\TenantApiController@show');
Route::get('tenants/{uuid}/categories', 'Api\CategoryApiController@categoriesByTenant');
Route::get('tenants/{uuid}/tables', 'Api\TableApiController@tablesByTenant');
Route::get('tenants', 'Api\TenantApiController@index');


Route::fallback(function(){
    return response()->json([
        'message' => 'Página não encontrada. Se o erro persistir, entre em contato com ' . config('acl.admins')[0]], 404);
});
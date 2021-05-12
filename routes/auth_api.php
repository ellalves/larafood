<?php

use Illuminate\Routing\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api',
], function () {
    Route::get('my-orders', 'Auth\OrderTenantController@index')->Route::middleware(['auth']);
    Route::patch('my-orders', 'Auth\OrderTenantController@update')->Route::middleware(['auth']);
});
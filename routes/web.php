<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->namespace('Admin')
    ->group(function() {

    /**
     * Profile x permission
     */
    Route::get('plans/{id}/profiles/{idProfile}/detach', 'ACL\PlanProfileController@planProfilesDetach')->name('plans.profiles.detach');
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@planProfilesAttach')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    /**
     * Permission x Profile
     */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\ProfilePermissionController@profilePermissionsDetach')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', 'ACL\ProfilePermissionController@profilePermissionsAttach')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\ProfilePermissionController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\ProfilePermissionController@permissions')->name('profiles.permissions');
    Route::get('permissions/{id}/profile', 'ACL\ProfilePermissionController@profiles')->name('permissions.profiles');


    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');


    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Details Plans
     */
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idPlan}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idPlan}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idPlan}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idPlan}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans/store', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    
    Route::get('admin', 'PlanController@index')->name('admin.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

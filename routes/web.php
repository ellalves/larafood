<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->namespace('Admin')
    ->group(function() {

    /**
     * Products x Categories
     */
    Route::get('products/{idProduct}/categories/{idCategory}/detach', 'ProductController@productCategoriesDetach')->name('products.categories.detach');
    Route::get('products/{idProduct}/categories/create', 'ProductController@categoriesAvailable')->name('products.categories.available');
    Route::post('products/{idProduct}/categories', 'ProductController@productCategoriesAttach')->name('products.categories.attach');
    Route::get('products/{idProduct}/categories', 'ProductController@categories')->name('products.categories');

    /**
     * Products
     */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');    
    
    /**
     * Categories
     */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    /**
     * Users
     */
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/{id}', 'UserController@update')->name('users.update');
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::get('users/show/{id}', 'UserController@show')->name('users.show');
    Route::get('users', 'UserController@index')->name('users.index');    

    /**
     * Group x permission
     */
    Route::get('plans/{id}/groups/{idGroup}/detach', 'ACL\PlanGroupController@planGroupsDetach')->name('plans.groups.detach');
    Route::post('plans/{id}/groups', 'ACL\PlanGroupController@planGroupsAttach')->name('plans.groups.attach');
    Route::any('plans/{id}/groups/create', 'ACL\PlanGroupController@groupsAvailable')->name('plans.groups.available');
    Route::get('plans/{id}/groups', 'ACL\PlanGroupController@groups')->name('plans.groups');
    /**
     * Permission x Group
     */
    Route::get('groups/{id}/permissions/{idPermission}/detach', 'ACL\GroupPermissionController@groupPermissionsDetach')->name('groups.permissions.detach');
    Route::post('groups/{id}/permissions', 'ACL\GroupPermissionController@groupPermissionsAttach')->name('groups.permissions.attach');
    Route::any('groups/{id}/permissions/create', 'ACL\GroupPermissionController@permissionsAvailable')->name('groups.permissions.available');
    Route::get('groups/{id}/permissions', 'ACL\GroupPermissionController@permissions')->name('groups.permissions');
    
    Route::get('permissions/{id}/groups/{idGroup}/detach', 'ACL\GroupPermissionController@permissionGroupsDetach')->name('permissions.groups.detach');
    Route::post('permissions/{id}/groups', 'ACL\GroupPermissionController@permissionsGroupAttach')->name('permissions.groups.attach');
    Route::any('permissions/{id}/groups/create', 'ACL\GroupPermissionController@groupsAvailable')->name('permissions.groups.available');
    Route::get('permissions/{id}/groups', 'ACL\GroupPermissionController@groups')->name('permissions.groups');


    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');


    /**
     * Routes Groups
     */
    Route::any('groups/search', 'ACL\GroupController@search')->name('groups.search');
    Route::resource('groups', 'ACL\GroupController');

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
    
    Route::get('/', 'PlanController@index')->name('admin.index');
});

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

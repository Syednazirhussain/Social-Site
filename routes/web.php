<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('admin/login', ['as'=> 'admin.login', 'uses' => 'Admin\UserController@adminLogin']);
Route::post('admin/authenticate', ['as'=> 'admin.user.authenticate', 'uses' => 'Admin\UserController@adminAuth']);


Route::group(['middleware' => ['admin.auth']], function () {

	Route::get('admin/dashboard', ['as'=> 'admin.dashboard', 'uses' => 'Admin\UserController@dashboard']);
	Route::get('admin/logout', ['as'=> 'admin.logout', 'uses' => 'Admin\UserController@logout']);
	
	Route::post('admin/users/email', ['as'=> 'admin.user.email', 'uses' => 'Admin\UserController@verifyEmail']);
	Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'Admin\UserController@index']);
	Route::post('admin/users', ['as'=> 'admin.users.store', 'uses' => 'Admin\UserController@store']);
	Route::get('admin/users/create', ['as'=> 'admin.users.create', 'uses' => 'Admin\UserController@create']);
	Route::put('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UserController@update']);
	Route::patch('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UserController@update']);
	Route::delete('admin/users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy']);
	Route::get('admin/users/{users}', ['as'=> 'admin.users.show', 'uses' => 'Admin\UserController@show']);
	Route::get('admin/users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'Admin\UserController@edit']);


	Route::get('admin/roles', ['as'=> 'admin.roles.index', 'uses' => 'Admin\RoleController@index']);
	Route::post('admin/roles', ['as'=> 'admin.roles.store', 'uses' => 'Admin\RoleController@store']);
	Route::get('admin/roles/create', ['as'=> 'admin.roles.create', 'uses' => 'Admin\RoleController@create']);
	Route::put('admin/roles/{roles}', ['as'=> 'admin.roles.update', 'uses' => 'Admin\RoleController@update']);
	Route::patch('admin/roles/{roles}', ['as'=> 'admin.roles.update', 'uses' => 'Admin\RoleController@update']);
	Route::delete('admin/roles/{roles}', ['as'=> 'admin.roles.destroy', 'uses' => 'Admin\RoleController@destroy']);
	Route::get('admin/roles/{roles}', ['as'=> 'admin.roles.show', 'uses' => 'Admin\RoleController@show']);
	Route::get('admin/roles/{roles}/edit', ['as'=> 'admin.roles.edit', 'uses' => 'Admin\RoleController@edit']);


	Route::get('admin/permissions', ['as'=> 'admin.permissions.index', 'uses' => 'Admin\PermissionController@index']);
	Route::post('admin/permissions', ['as'=> 'admin.permissions.store', 'uses' => 'Admin\PermissionController@store']);
	Route::get('admin/permissions/create', ['as'=> 'admin.permissions.create', 'uses' => 'Admin\PermissionController@create']);
	Route::put('admin/permissions/{permissions}', ['as'=> 'admin.permissions.update', 'uses' => 'Admin\PermissionController@update']);
	Route::patch('admin/permissions/{permissions}', ['as'=> 'admin.permissions.update', 'uses' => 'Admin\PermissionController@update']);
	Route::delete('admin/permissions/{permissions}', ['as'=> 'admin.permissions.destroy', 'uses' => 'Admin\PermissionController@destroy']);
	Route::get('admin/permissions/{permissions}', ['as'=> 'admin.permissions.show', 'uses' => 'Admin\PermissionController@show']);
	Route::get('admin/permissions/{permissions}/edit', ['as'=> 'admin.permissions.edit', 'uses' => 'Admin\PermissionController@edit']);





});




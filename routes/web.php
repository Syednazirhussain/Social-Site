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

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::get('admin/login', ['as'=> 'admin.login', 'uses' => 'Admin\UserController@adminLogin']);
Route::post('admin/authenticate', ['as'=> 'admin.user.authenticate', 'uses' => 'Admin\UserController@adminAuth']);


Route::group(['middleware' => ['admin.auth']], function () {

	Route::get('admin/dashboard', ['as'=> 'admin.dashboard', 'uses' => 'Admin\UserController@dashboard']);
	Route::get('admin/logout', ['as'=> 'admin.logout', 'uses' => 'Admin\UserController@logout']);
	Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'Admin\UserController@index']);

	Route::group(['middleware' => ['role:Admin|Web Master|Talents']], function () {

		Route::post('admin/users/email', ['as'=> 'admin.user.email', 'uses' => 'Admin\UserController@verifyEmail']);
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
	

		Route::get('admin/postCategories', ['as'=> 'admin.postCategories.index', 'uses' => 'Admin\PostCategoryController@index']);
		Route::post('admin/postCategories', ['as'=> 'admin.postCategories.store', 'uses' => 'Admin\PostCategoryController@store']);
		Route::get('admin/postCategories/create', ['as'=> 'admin.postCategories.create', 'uses' => 'Admin\PostCategoryController@create']);
		Route::put('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.update', 'uses' => 'Admin\PostCategoryController@update']);
		Route::patch('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.update', 'uses' => 'Admin\PostCategoryController@update']);
		Route::delete('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.destroy', 'uses' => 'Admin\PostCategoryController@destroy']);
		Route::get('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.show', 'uses' => 'Admin\PostCategoryController@show']);
		Route::get('admin/postCategories/{postCategories}/edit', ['as'=> 'admin.postCategories.edit', 'uses' => 'Admin\PostCategoryController@edit']);



		Route::get('admin/posts', ['as'=> 'admin.posts.index', 'uses' => 'Admin\PostController@index']);
		Route::post('admin/posts', ['as'=> 'admin.posts.store', 'uses' => 'Admin\PostController@store']);
		Route::get('admin/posts/create', ['as'=> 'admin.posts.create', 'uses' => 'Admin\PostController@create']);
		Route::put('admin/posts/{posts}', ['as'=> 'admin.posts.update', 'uses' => 'Admin\PostController@update']);
		Route::patch('admin/posts/{posts}', ['as'=> 'admin.posts.update', 'uses' => 'Admin\PostController@update']);
		Route::delete('admin/posts/{posts}', ['as'=> 'admin.posts.destroy', 'uses' => 'Admin\PostController@destroy']);
		Route::get('admin/posts/{posts}', ['as'=> 'admin.posts.show', 'uses' => 'Admin\PostController@show']);
		Route::get('admin/posts/{posts}/edit', ['as'=> 'admin.posts.edit', 'uses' => 'Admin\PostController@edit']);


	});

	Route::group(['middleware' => ['permission:Membership Managment']], function () {

		Route::get('admin/memberShipPlans', ['as'=> 'admin.memberShipPlans.index', 'uses' => 'Admin\MemberShipPlanController@index']);
		Route::post('admin/memberShipPlans', ['as'=> 'admin.memberShipPlans.store', 'uses' => 'Admin\MemberShipPlanController@store']);
		Route::get('admin/memberShipPlans/create', ['as'=> 'admin.memberShipPlans.create', 'uses' => 'Admin\MemberShipPlanController@create']);
		Route::put('admin/memberShipPlans/{memberShipPlans}', ['as'=> 'admin.memberShipPlans.update', 'uses' => 'Admin\MemberShipPlanController@update']);
		Route::patch('admin/memberShipPlans/{memberShipPlans}', ['as'=> 'admin.memberShipPlans.update', 'uses' => 'Admin\MemberShipPlanController@update']);
		Route::delete('admin/memberShipPlans/{memberShipPlans}', ['as'=> 'admin.memberShipPlans.destroy', 'uses' => 'Admin\MemberShipPlanController@destroy']);
		Route::get('admin/memberShipPlans/{memberShipPlans}', ['as'=> 'admin.memberShipPlans.show', 'uses' => 'Admin\MemberShipPlanController@show']);
		Route::get('admin/memberShipPlans/{memberShipPlans}/edit', ['as'=> 'admin.memberShipPlans.edit', 'uses' => 'Admin\MemberShipPlanController@edit']);	

	});

});

Route::get('/', function () {
    return redirect()->route('site.dashboard');
});



Route::get('creatifny', ['as'=> 'site.dashboard', 'uses' => 'User\UserController@index']);
Route::get('user/login',['as' => 'user.login','uses' => 'User\UserController@viewLogin']);
Route::post('user/login',['as' => 'user.authenticate','uses' => 'User\UserController@authenticate']);
Route::post('user/signup',['as' => 'user.signup','uses' => 'User\UserController@signUp']);
Route::post('user/verify/email', ['as'=> 'user.email.verify', 'uses' => 'User\UserController@verifyEmail']);

Route::group(['middleware' => ['user.auth']], function () {


	Route::get('user/account/{account}',['as' => 'user.account.setting','uses' => 'User\AccountSetting@edit']);
	Route::patch('user/account/{account}',['as' => 'user.account.update','uses' => 'User\AccountSetting@update']);
	Route::get('user/logout', ['as'=> 'user.logout', 'uses' => 'User\UserController@logout']);
	Route::get('user/membership/pricing', ['as'=> 'user.membership.pricing', 'uses' => 'User\UserController@membership']);
	Route::get('user/membership/payment', ['as'=> 'user.membership.payment', 'uses' => 'User\PayPalController@subcribe']);

	Route::group(['middleware' => ['talent.route']], function () {

		Route::get('talent/user/profile',['as' => 'talent.user.dashboard','uses' => 'User\TalentController@dashboard']);

		Route::get('talent/user/profile/retrive',['as' => 'talent.profile','uses' => 'User\TalentController@retrive_profile_info']);

		Route::post('talent/user/post/add',['as' => 'add.single.post' , 'uses' => 'User\TalentController@post_article']);
		Route::get('talent/user/post/edit/{post_id}',['as' => 'edit.single.post','uses' => 'User\TalentController@edit_post']);
		Route::put('talent/user/post/update/{post_id}', ['as'=> 'update.single.post', 'uses' => 'User\TalentController@update_post']);
		Route::delete('talent/user/post/delete/{post_id}', ['as'=> 'delete.single.post', 'uses' => 'User\TalentController@delete_post']);
		
		Route::post('talent/user/post/images',['as' => 'add.multiple.images' , 'uses' => 'User\TalentController@post_images']);
		Route::delete('talent/user/post/images/{post_id}', ['as'=> 'delete.multiple.images', 'uses' => 'User\TalentController@post_image_destroy']);
		Route::post('talent/user/post/image/remove', ['as'=> 'delete.single.image', 'uses' => 'User\TalentController@post_image_remove']);
		
		Route::post('talent/user/post/vedio',['as' => 'add.single.vedio' , 'uses' => 'User\TalentController@post_vedio']);

	});

	Route::group(['middleware' => ['fan.route']], function () {

		Route::get('fan/user/profile',['as' => 'fan.user.dashboard','uses' => 'User\FanController@dashboard']);		


	});
	

	Route::get('user/talent/lists',['as' => 'talent.list','uses' => 'User\ProfileController@talent_listing']);
	Route::post('user/follow/talent',['as' => 'user.follow.talent','uses' => 'User\ProfileController@follow']);
	Route::post('user/unfollow/talent',['as' => 'user.unfollow.talent','uses' => 'User\ProfileController@unfollow']);



});
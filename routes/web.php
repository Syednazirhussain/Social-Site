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

Route::get('/admin', function (\Illuminate\Http\Request $request) {
	$request->session()->flush();
    return redirect()->route('admin.login');
});

Route::get('admin/login', ['as'=> 'admin.login', 'uses' => 'Admin\UserController@adminLogin']);
Route::post('admin/authenticate', ['as'=> 'admin.user.authenticate', 'uses' => 'Admin\UserController@adminAuth']);

Route::get('admin/forget-password',['as' => 'admin.forget.password','uses' => 'Admin\UserController@forget_password']);
Route::post('admin/forget-password',['as' => 'admin.password.request','uses' => 'Admin\UserController@password_request']);

Route::get('admin/reset-password/{user_id}',['as' => 'admin.reset.password','uses' => 'Admin\UserController@reset_password']);
Route::post('admin/reset-password',['as' => 'admin.password.reset','uses' => 'Admin\UserController@reset_password_request']);



Route::group(['middleware' => ['admin.auth']], function () {

	Route::get('admin/dashboard', ['as'=> 'admin.dashboard', 'uses' => 'Admin\UserController@dashboard']);
	Route::get('admin/logout', ['as'=> 'admin.logout', 'uses' => 'Admin\UserController@logout']);
	Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'Admin\UserController@index']);

	Route::group(['middleware' => ['role:Admin|Web Master']], function () {

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


		Route::get('admin/setting/{user_id}', ['as'=> 'admin.setting.edit', 'uses' => 'Admin\UserController@account_setting']);
		Route::patch('admin/setting/{user_id}', ['as'=> 'admin.setting.update', 'uses' => 'Admin\UserController@account_setting_update']);

		Route::get('admin/newsletters', ['as'=> 'admin.newsletter.index', 'uses' => 'Admin\NewletterController@index']);
		Route::post('admin/newsletters', ['as'=> 'admin.newsletter.send', 'uses' => 'Admin\NewletterController@send']);


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

Route::get('/', function (\Illuminate\Http\Request $request) {
	$request->session()->flush();
    return redirect()->route('site.dashboard');
});


Route::get('subcription/check',['as' => 'subcription.check','uses'	=> 'CronController@index']);

Route::get('creatifny', ['as'=> 'site.dashboard', 'uses' => 'User\SiteController@index']);
Route::get('creatifny/feature', ['as'=> 'site.creatifny.feature', 'uses' => 'User\SiteController@feature']);
Route::get('creatifny/discover', ['as'=> 'site.creatifny.discover', 'uses' => 'User\SiteController@discover']);
Route::get('creatifny/crowd-pick', ['as'=> 'site.creatifny.crowd_pick', 'uses' => 'User\SiteController@crowd_pick']);
Route::get('creatifny/show', ['as'=> 'site.creatifny.show', 'uses' => 'User\SiteController@show']);
Route::get('creatifny/charts', ['as'=> 'site.creatifny.charts', 'uses' => 'User\SiteController@charts']);
Route::get('creatifny/pricing', ['as'=> 'site.creatifny.pricing', 'uses' => 'User\SiteController@pricing']);
Route::get('creatifny/about-us', ['as'=> 'site.creatifny.about_us', 'uses' => 'User\SiteController@about_us']);
Route::get('creatifny/conditions', ['as'=> 'site.creatifny.conditions', 'uses' => 'User\SiteController@conditions']);
Route::get('creatifny/privacy_policy', ['as'=> 'site.creatifny.privacy_policy', 'uses' => 'User\SiteController@privacy_policy']);



Route::get('user/login',['as' => 'user.login','uses' => 'User\UserController@viewLogin']);
Route::get('user/verify-account/{user_id}/{token}',['as' => 'user.verify.email','uses' => 'User\UserController@verify_account']);

Route::get('user/forget-password',['as' => 'user.forget.password','uses' => 'User\UserController@forget_password']);
Route::post('user/forget-password',['as' => 'user.password.request','uses' => 'User\UserController@password_request']);

Route::get('user/reset-password/{user_id}',['as' => 'user.reset.password','uses' => 'User\UserController@reset_password']);
Route::post('user/reset-password',['as' => 'reset.password','uses' => 'User\UserController@reset_password_request']);

Route::post('user/login',['as' => 'user.authenticate','uses' => 'User\UserController@authenticate']);
Route::post('user/signup',['as' => 'user.signup','uses' => 'User\UserController@signUp']);
Route::post('user/verify/email', ['as'=> 'user.email.verify', 'uses' => 'User\UserController@verifyEmail']);

Route::get('user/account/confirmation',['as' => 'user.account.confirmation', 'uses'	=> 'User\UserController@accountConfirmation']);



Route::group(['middleware' => ['user.auth']], function () {


	Route::get('user/membership/payment', ['as'=> 'user.membership.payment', 'uses' => 'User\PayPalController@subcribe']);


	Route::group(['middleware' => ['talent.route']], function () {

		Route::get('talent/profile',['as' => 'talent.user.dashboard','uses' => 'User\TalentController@dashboard']);

		Route::get('talent/profile/retrive',['as' => 'talent.profile','uses' => 'User\TalentController@retrive_profile_info']);

		Route::get('talent/post/edit/{post_id}',['as' => 'edit.single.post','uses' => 'User\TalentController@edit_post']);
		Route::post('talent/post/add',['as' => 'add.single.post' , 'uses' => 'User\TalentController@post_article']);
		Route::put('talent/post/update/{post_id}', ['as'=> 'update.single.post', 'uses' => 'User\TalentController@update_post']);
		Route::delete('talent/post/delete/{post_id}', ['as'=> 'delete.single.post', 'uses' => 'User\TalentController@delete_post']);
		
		Route::get('talent/post/vedio/{post_id}',['as' => 'edit.single.vedio' , 'uses' => 'User\TalentController@edit_vedio']);
		Route::post('talent/post/vedio',['as' => 'add.single.vedio' , 'uses' => 'User\TalentController@post_vedio']);
		Route::put('talent/post/vedio/{post_meta_id}',['as' => 'update.single.vedio' , 'uses' => 'User\TalentController@update_vedio']);
		Route::delete('talent/post/vedio/{post_id}',['as' => 'delete.single.vedio' , 'uses' => 'User\TalentController@delete_vedio']);

		Route::post('talent/post/images',['as' => 'add.multiple.images' , 'uses' => 'User\TalentController@post_images']);
		Route::delete('talent/post/images/{post_id}', ['as'=> 'delete.multiple.images', 'uses' => 'User\TalentController@post_image_destroy']);
		Route::post('talent/post/image/remove', ['as'=> 'delete.single.image', 'uses' => 'User\TalentController@post_image_remove']);

		Route::get('talent/lists',['as' => 'talent.list','uses' => 'User\TalentController@talent_listing']);
		
		Route::get('talent/subcription/info',['as' => 'subcription.info','uses' => 'User\TalentController@subcription_info']);
		Route::get('talent/subcription/re-new/request',['as' => 'subcription.renew.request','uses' => 'User\TalentController@subcription_renew_request']);
		Route::any('talent/subcription/re-new/response',['as' => 'subcription.renew.response','uses' => 'User\TalentController@subcription_renew_response']);
		
		Route::get('/talent/events',['as' => 'talent.events','uses' => 'User\TalentController@event']);
		Route::post('/talent/events',['as' => 'talent.events.store','uses' => 'User\TalentController@event_store']);
		Route::put('/talent/events/{event_id}',['as' => 'talent.events.update','uses' => 'User\TalentController@event_update']);
		Route::delete('/talent/events/{event_id}',['as' => 'talent.events.delete','uses' => 'User\TalentController@event_delete']);

		Route::get('talent/account/{account}',['as' => 'talent.account.setting','uses' => 'User\AccountSetting@talent_edit']);
		Route::patch('talent/account/{account}',['as' => 'talent.account.update','uses' => 'User\AccountSetting@talent_update']);
		Route::get('talent/logout', ['as'=> 'talent.logout', 'uses' => 'User\UserController@talent_logout']);

	});

	Route::group(['middleware' => ['fan.route']], function () {

		Route::get('fan/profile',['as' => 'fan.user.dashboard','uses' => 'User\FanController@dashboard']);		

		Route::get('fan/profile/retrive',['as' => 'fan.profile','uses' => 'User\FanController@retrive_profile_info']);
		
		Route::get('fan/talent_profile_preview/{talent_id}',['as' => 'fan.view.talent.profile','uses' => 'User\FanController@preview_talent_profile']);
		Route::get('fan/talent_profile_detail/{talent_id}',['as' => 'fan.view.talent.detail','uses' => 'User\FanController@preview_talent_detail']);

		Route::get('fan/talent/lists',['as' => 'fan.talent.list','uses' => 'User\FanController@talent_listing']);
		Route::post('fan/follow/talent',['as' => 'fan.follow.talent','uses' => 'User\FanController@follow']);
		Route::post('fan/unfollow/talent',['as' => 'fan.unfollow.talent','uses' => 'User\FanController@unfollow']);

		Route::get('fan/subcription/message', ['as'=> 'fan.subcription.message', 'uses' => 'User\FanController@subcription_message']);
		
		Route::get('fan/subcription/plan', ['as'=> 'fan.subcription.plan', 'uses' => 'User\FanController@subcription_plan']);
		Route::post('fan/subcription/plan', ['as'=> 'fan.subcription.request', 'uses' => 'User\FanController@subcription_request']);
		Route::any('fan/subcription/response', ['as'=> 'fan.subcription.response', 'uses' => 'User\FanController@subcription_response']);
		
		Route::get('fan/account/{account}',['as' => 'fan.account.setting','uses' => 'User\AccountSetting@fan_edit']);
		Route::patch('fan/account/{account}',['as' => 'fan.account.update','uses' => 'User\AccountSetting@fan_update']);
		Route::get('fan/logout', ['as'=> 'fan.logout', 'uses' => 'User\UserController@fan_logout']);

	});

});
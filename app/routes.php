<?php

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@home'));


Route::get('/profile/{username}', array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@show'
));



/*
 * Authenticated Group.
 */

Route::group(array('before' => 'auth'), function() {


	/*
	* CSRF Protection Group.
	*/
	Route::group(array('before' => 'csrf'), function() {

		/*
		 * Change Password (Post)
		 */
		Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));

		/*
		 * Update Profile (Post)
		 */
		Route::post('/profile/{username}', array(
			'as' => 'profile-user-post',
			'uses' => 'ProfileController@update'
		));

		/*
		 * Store Task (Post)
		 */
		Route::post('/tasks', array(
			'as' => 'user-tasks-store',
			'uses' => 'TaskController@store'
		));

		/*
		 * Update Task (Post)
		 */
		Route::post('/tasks/{id}', array(
			'as' => 'user-tasks-update',
			'uses' => 'TaskController@update'
		));


	});


	/*
	* Get Tasks (GET)
	*/

	Route::get('/tasks', array(
		'as' => 'user-tasks',
		'uses' => 'TaskController@index'
	));


	/*
	 * Create Task (Get)
	 */
	Route::get('/tasks/create', array(
		'as' => 'user-tasks-create',
		'uses' => 'TaskController@create'
	));

	/*
	 * Delete Task (Get)
	 */
	Route::delete('/tasks/{id}', array(
		'as' => 'user-tasks-delete',
		'uses' => 'TaskController@destroy'
	));



	/*
	* Edit Tasks (GET)
	*/

	Route::get('/tasks/{id}/edit', array(
		'as' => 'user-tasks-edit',
		'uses' => 'TaskController@edit'
	));



	/*
	 * Get Profile (GET)
	 */

	Route::get('/profile/{username}/edit', array(
		'as' => 'profile-user-get',
		'uses' => 'ProfileController@edit'
	));


	/*
	 * Change Password (GET)
	 */
	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));




	/*
	 * Sign Out (GET)
	 */

	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));


});



/*
 * Unauthenticated Group.
 */
Route::group(array('before' => 'guest'), function() {

	/*
	 * CSRF Protection Group.
	 */
	Route::group(array('before' => 'csrf'), function() {

		/*
		 * Create Account (Post)
		 */
		Route::post('/account/create', array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));

		/*
		 * Sign In (Post)
		 */
		Route::post('account/sign-in', array (
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));

		/*
		 * Forgot Password (GET)
		 */
		Route::post('account/forgot-password', array (
			'as' => 'account-forgot-password-post',
			'uses' => 'AccountController@postForgotPassword'
		));



	});


	/*
	 * Forgot Password (GET)
	 */
	Route::get('account/forgot-password', array (
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));

	/*
	 * Recover  Password (GET)
	 */
	Route::get('account/recover/{code}', array (
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	));


	/*
	 * Sign In (GET)
	 */

	Route::get('account/sign-in', array (
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));

	/*
	 * Create Account (GET)
	 */

	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));

	/*
	 * Account Activate(GET)
	 */

	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));


	Route::get('{username}', array(
		'as' => 'profile-user',
		'uses' => 'ProfileController@show'
	));

});

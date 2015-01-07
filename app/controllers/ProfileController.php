<?php

class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /profile
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /profile/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /profile
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /profile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username) {
		$user = User::where('username', '=', $username);
		if($user->count()) {

			$user = $user->first();
			return View::make('profile/user')
				->with('user', $user);
		}
		return App::abort(404);
	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /profile/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($username) {

		$user = User::where('username', '=', $username);
		if($user->count()) {
			$user = $user->first();
			if(Auth::user()->id == $user->id) {
				return View::make('profile/edit')
					->withUser($user);
			} else {
				return Redirect::route('home');

			}
		} else {
			return Redirect::route('home')
				->with('global', 'This User Does Not Exist AND/OR You Dont have Authorized Access');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /profile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($username) {


		$validator = Validator::make(Input::all(),
			array(
				'first_name' => 'min:3',
				'last_name' => 'min:3'
			)
		);
		if($validator->fails())
		{
			return Redirect::route('profile-user-get', array('username' => Auth::user()->username))
				->withErrors($validator)
				->withInput();
		} else
		{
			$user = User::find(Auth::user()->id);
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');

			$user->profile->first_name = $first_name;
			$user->profile->last_name = $last_name;

			if($user->profile->save())
			{
				return Redirect::route('profile-user', array('username' => Auth::user()->username))
					->with('global', 'Your Profile Has Been Updated!');
			} else {
				return Redirect::route('profile-user-get', array('username' => Auth::user()->username))
					->with('global', 'Your Profile Changes Could Not Be Saved.');
			}
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /profile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
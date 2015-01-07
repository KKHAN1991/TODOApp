<?php

class TaskController extends \BaseController
{

	/**
	 * Display a listing of the resource.
	 * GET /task
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Auth::user()->tasks;
		return View::make('tasks/index')->with('tasks', $tasks);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /task/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tasks/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /task
	 *
	 * @return Response
	 */
	public function store()
	{
		$userid = Auth::user()->id;

		$rules = array(
			'name' => 'required|min:3|max:255'
		);

		$input = Input::all();
		$validator = Validator::make($input, $rules);

		if ($validator->fails())
		{
			return Redirect::route('user-tasks-create')->withErrors($validator);

		} else
		{

			$task = new Task;
			$task->owner_id = $userid;
			$task->name = Input::get('name');
			$task->save();

			return Redirect::route('user-tasks')
				->with('global', 'New Task Created');


		}

	}

	/**
	 * Display the specified resource.
	 * GET /task/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /task/{id}/edit
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = Task::where('id', '=', $id);
		if ($task->count())
		{
			$task = $task->first();
			if (Auth::user()->id == $task->owner_id)
			{
				return View::make('tasks/edit')->with('task', $task);

			} else
			{
				return Redirect::route('home')
					->with('global', 'You do not own this task');
			}
		} else
		{
			return Redirect::route('home')
				->with('global', 'Task does not exist');
		}

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /task/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{

		$task = Task::where('id', '=', $id);

		if ($task->count())
		{
			$task = $task->first();

			$rules = array(
				'name' => 'required|min:3|max:255'
			);

			$input = Input::all();
			$validator = Validator::make($input, $rules);

			if ($validator->fails())
			{
				return Redirect::route('user-tasks-edit', array('task' => $task->id))
					->withErrors($validator)
					->withInput();
			} else
			{
				$name = Input::get('name');
				$completed = Input::get('completed');

				$task->name = $name;
				$task->completed = $completed;


				if ($task->save())
				{
					return Redirect::route('user-tasks')
						->with('global', 'Your Task Has Been Updated!');
				} else
				{
					'could not update';
				}
			}
		}


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /task/{id}
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{

		if (Task::find($id))
		{
			$task = Task::find($id);

			if (Auth::user()->id == $task->owner_id)
			{

				if ($task->delete() > 0)
				{

					return Redirect::route('user-tasks')
						->with('global', 'Task was deleted');

				} else
				{
					return Redirect::route('user-tasks')
						->with('global', 'Task Could Not Be Deleted, Try Again Later');
				}
			} else
			{
				return Redirect::route('user-tasks')
					->with('global', 'You Are Not The Owner Of This Task');
			}

		} else
		{
			return Redirect::route('user-tasks')
				->with('global', 'Task Not Found');
		}
	}

}
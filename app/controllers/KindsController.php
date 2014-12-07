<?php

class KindsController extends \BaseController {

	/**
	 * Display a listing of kinds
	 *
	 * @return Response
	 */
	public function index()
	{
		$kinds = Kind::all();

		return View::make('kinds.index', compact('kinds'));
	}

	/**
	 * Show the form for creating a new kind
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('kinds.create');
	}

	/**
	 * Store a newly created kind in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Kind::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Kind::create($data);

		return Redirect::route('kinds.index');
	}

	/**
	 * Display the specified kind.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$kind = Kind::findOrFail($id);

		return View::make('kinds.show', compact('kind'));
	}

	/**
	 * Show the form for editing the specified kind.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kind = Kind::find($id);

		return View::make('kinds.edit', compact('kind'));
	}

	/**
	 * Update the specified kind in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$kind = Kind::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Kind::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$kind->update($data);

		return Redirect::route('kinds.index');
	}

	/**
	 * Remove the specified kind from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Kind::destroy($id);

		return Redirect::route('kinds.index');
	}

}

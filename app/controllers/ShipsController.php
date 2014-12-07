<?php

class ShipsController extends \BaseController {

	/**
	 * Display a listing of ships
	 *
	 * @return Response
	 */
	public function index()
	{
		$ships = Ship::all();

		return View::make('ships.index', compact('ships'));
	}

	/**
	 * Show the form for creating a new ship
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ships.create');
	}

	/**
	 * Store a newly created ship in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Ship::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Ship::create($data);

		return Redirect::route('ships.index');
	}

	/**
	 * Display the specified ship.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ship = Ship::findOrFail($id);

		return View::make('ships.show', compact('ship'));
	}

	/**
	 * Show the form for editing the specified ship.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ship = Ship::find($id);

		return View::make('ships.edit', compact('ship'));
	}

	/**
	 * Update the specified ship in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ship = Ship::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Ship::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ship->update($data);

		return Redirect::route('ships.index');
	}

	/**
	 * Remove the specified ship from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Ship::destroy($id);

		return Redirect::route('ships.index');
	}

}

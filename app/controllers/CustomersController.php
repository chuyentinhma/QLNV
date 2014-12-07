<?php

class CustomersController extends \BaseController {

	/**
	 * Display a listing of customers
	 *
	 * @return Response
	 */
	public function index()
	{
		$customers = Customer::all();

		return View::make('customers.index', compact('customers'));
	}

	/**
	 * Show the form for creating a new customer
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('customers.create');
	}

	/**
	 * Store a newly created customer in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Customer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Customer::create($data);

		return Redirect::route('customers.index');
	}

	/**
	 * Display the specified customer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$customer = Customer::findOrFail($id);

		return View::make('customers.show', compact('customer'));
	}

	/**
	 * Show the form for editing the specified customer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$customer = Customer::find($id);

		return View::make('customers.edit', compact('customer'));
	}

	/**
	 * Update the specified customer in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$customer = Customer::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Customer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$customer->update($data);

		return Redirect::route('customers.index');
	}

	/**
	 * Remove the specified customer from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Customer::destroy($id);

		return Redirect::route('customers.index');
	}

}

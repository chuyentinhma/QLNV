<?php

class OrdersController extends \BaseController {

	/**
	 * Display a listing of orders
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::all();

		return View::make('orders.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new order
	 *
	 * @return Response
	 */
	public function create()
	{
                $units = Unit::all(['id','symbol']);
                $kinds = Kind::all(['id','symbol']);
                $categories = Category::all(['id','symbol']);
                $purposes = Purpose::all(['id','content'])->sortBy('id');
                $allUnit = [];
                $allKind = [];
                $allCategory = [];
                $allPurpose = [];
                foreach ($units as $unit) {
                    $allUnit[$unit->id] = $unit->symbol;
                }
                foreach ($kinds as $kind) {
                    $allKind[$kind->id] = $kind->symbol;
                }
                foreach ($categories as $category) {
                    $allCategory[$category->id] = $category->symbol;
                }
                foreach ($purposes as $purpose) {
                    $allPurpose[$purpose->id] = $purpose->content;
                }
		return View::make('orders.create',array('units'=>$allUnit,'kinds'=>$allKind, 'categories' => $allCategory, 'purposes' => $allPurpose));
	}

	/**
	 * Store a newly created order in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Order::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Order::create($data);

		return Redirect::route('orders.index');
	}

	/**
	 * Display the specified order.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order = Order::findOrFail($id);

		return View::make('orders.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified order.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = Order::find($id);

		return View::make('orders.edit', compact('order'));
	}

	/**
	 * Update the specified order in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$order = Order::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Order::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$order->update($data);

		return Redirect::route('orders.index');
	}

	/**
	 * Remove the specified order from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Order::destroy($id);

		return Redirect::route('orders.index');
	}

}

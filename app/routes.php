<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


Route::get('error/{type}', array('as' => 'error', 'uses' => 'HomeController@error'));

// Check login before use this routes
Route::group(array('before' => 'auth'), function() {
    Route::get('/', array('as' => 'dashboard', 'uses' => 'HomeController@dashBoard'));
    
    Route::get('register', array('as' => 'register', 'uses' => 'UserController@register'));
    
    Route::post('register', array('as' => 'post.register', 'uses' => 'UserController@postRegister'));
    
    Route::get('profile', array('as' => 'profile', 'uses' => 'UserController@profile'));
    
    Route::get('orders/index', array('as' => 'orders.index', 'uses' => 'OrdersController@index'));
    
    Route::get('orders/add', array('as' => 'orders.add', 'uses' => 'OrdersController@create'));
    
    Route::post('orders/add', array('as' => 'orders.add', 'uses' => 'OrdersController@store'));

    Route::get('orders/show/{id}', array('as' => 'orders.show', 'uses' => 'OrdersController@show'))->where('id', '[0-9]+');
    
    Route::get('orders/edit/{id}', array('as' => 'orders.edit', 'uses' => 'OrdersController@edit'));
    
    Route::post('orders/edit/{id}', array('as' => 'orders.edit', 'uses' => 'OrdersController@update'));
    
    Route::get('orders/delete/{id}', array('as' => 'orders.delete', 'uses' => 'OrdersController@destroy'));
      
    Route::get('ships/index', array('as' => 'ships.index', 'uses' => 'ShipsController@index'));
    
    Route::get('ships/create', array('as' => 'ships.create', 'uses' => 'ShipsController@create'));
    
    Route::post('ships/create', array('as' => 'ships.store', 'uses' => 'ShipsController@store'));
    
    Route::get('ships/edit/{id}', array('as' => 'ships.edit', 'uses' => 'ShipsController@edit'));
    
    Route::post('ships/edit/{id}', array('as' => 'ships.edit', 'uses' => 'ShipsController@update'));
    
    Route::get('ships/delete/{id}', array('as' => 'ships.delete', 'uses' => 'ShipsController@destroy'));
    
    Route::get('search', array('as' => 'search', 'uses' => 'OrdersController@search'));
    
    Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
    
//    Route::get('setup', array('as' => 'setup', 'uses' => 'HomeController@setupSystem'));
    Route::resource('units', 'UnitsController',array('except' => array('show','destroy')));
    Route::get('units/delete/{id}', array('as' => 'units.delete','uses' =>'UnitsController@destroy'));
    
    Route::resource('kinds', 'KindsController',array('except' => array('show','destroy')));
    Route::get('kinds/delete/{id}', array('as' => 'kinds.delete','uses' =>'KindsController@destroy'));
    
    Route::resource('categories', 'CategoriesController',array('except' => array('show','destroy')));
    Route::get('categories/delete/{id}', array('as' => 'categories.delete','uses' =>'CategoriesController@destroy'));
    
    Route::resource('purposes', 'PurposesController',array('except' => array('show','destroy')));
    Route::get('purposes/delete/{id}', array('as' => 'purposes.delete','uses' =>'PurposesController@destroy'));
    
});
// Neu chua dang nhap thi dc vao nhung Route sau con dang nhap roi thi vao DashBoard
Route::group(["before" => "guest"], function() {
    
    Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));

    Route::post('login', array('as' => 'post_login', 'uses' => 'UserController@postLogin'));
    
    
});

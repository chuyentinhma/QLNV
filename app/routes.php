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
    
    Route::get('orders/detail', array('as' => 'order.detail', 'uses' => 'OrdersController@index'));
    
    Route::get('orders/add', array('as' => 'order.add', 'uses' => 'OrdersController@create'));
    
    Route::post('orders/add', array('as' => 'order.add', 'uses' => 'OrdersController@store'));
    
    Route::get('ships/detail', array('as' => 'ship.detail', 'uses' => 'ActionController@index'));
    
    Route::post('ships/update', array('as' => 'ship.update', 'uses' => 'UserController@update'));
    
    Route::post('search', array('as' => 'search', 'uses' => 'UserController@profile'));
    
    Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
    
});
// Neu chua dang nhap thi dc vao nhung Route sau con dang nhap roi thi vao DashBoard
Route::group(["before" => "guest"], function() {
    
    Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));

    Route::post('login', array('as' => 'post_login', 'uses' => 'UserController@postLogin'));
    
    
});

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author TNT
 */
//use Impl\Repo\UserRepositoryInterface;
use Illuminate\Support\MessageBag;

class UserController extends BaseController {

//    protected $layout = 'layouts.login';
    protected $users;

//    public function __construct(UserRepositoryInterface $users) {
//        $this->users = $users;
//    }
    public function login() {

        return View::make("users.login");
    }

    public function postLogin() {
        $remember = false;
        if (Input::has('remember')) {
            $remember = true;
        }
        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));
        if (Auth::attempt($credentials, $remember)) {
            return Redirect::intended('/');
        } else {
            Session::flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng');
            return Redirect::back()->withInput();
        }
    }

    public function register() {
        return View::make('home.dashboard');
    }

    public function postRegister() {
        return View::make('home.dashboard');
    }

    public function profile() {
        return Redirect::to('/');
    }

    public function logout() {

        Auth::logout();
        return Redirect::route("login");
    }

}

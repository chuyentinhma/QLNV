@extends('layouts.login')
@section('content')
<div class="wrap">
    <div class='signin_block'>
        <div class='row-fluid'>
           @include('partials.flash')	
            <div class='block'>
                <div class='head'>
                    <h2>Đăng nhập quản trị</h2>
                    <ul class='buttons'>
                        <li>
                            <a class='tip' href='#' title='Contact administrator'>
                                <i class='i-warning'></i>
                            </a>
                        </li>
                        <li>
                            <a class='tip' href='#' title='Forget your password?'>
                                <i class='i-locked'></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <form action='{{{ route('login') }}}' method='post'>
                    <div class='content np'>
                        <div class='controls-row'>
                            <div class='span3'>Tài khoản:</div>
                            <div class='span9'>
                                <input class='input-block-level' name='username' type='text' value=''>
                            </div>
                        </div>
                        <div class='controls-row'>
                            <div class='span3'>Mật khẩu:</div>
                            <div class='span9'>
                                <input class='input-block-level' name='password' type='password' value=''>
                            </div>
                        </div>
                    </div>
                    <div class='footer'>
                        <div class='side fl'>
                            <label class='checkbox'>
                                <input name='remember' type='checkbox' value="1">
                                Duy trì đăng nhập
                            </label>
                        </div>
                        <div class='side fr'>
                            <button class='btn btn-primary'>Đăng nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop()
@extends('layouts.login')
@section('content')
<div class="wrap">
    <div class='signin_block'>
        <div class='row-fluid'>
            <div class='alert alert-error'>
                <h3>Trang bạn tìm không tồn tại</h3>
            </div>
            <a class="text-center" href="{{route('home')}}">
                <i class="arrow"></i>
                Quay về trang chủ
            </a>
        </div>
    </div>
</div>
@stop
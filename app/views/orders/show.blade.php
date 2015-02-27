@extends('layouts.admin')
@section('content')

<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Chi tiết yêu cầu {{$order->number_cv . '/' . $order->unit->symbol}}
        </div>
        
    </div>
    <div class='content'>
        @include('partials.flash')	
        {{$order->customer_name}}
    </div>
</div>

@stop
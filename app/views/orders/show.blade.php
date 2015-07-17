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
        <br/>
        <a href="{{public_path() . '\uploads\orders\\'. $order->file_attach}}" target="_blank">File đính kèm</a>
    </div>
</div>

@stop
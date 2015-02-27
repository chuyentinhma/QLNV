@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Cài đặt
        </div>
        <div class='page-tools'>
            <a class='btn btn-primary' href='{{route('orders.add')}}'>
                <i class="i-plus-2"></i>
                Thêm yêu cầu
            </a>
            <a class='btn btn-success' href='{{route('orders.add')}}'>
                <i class="i-file"></i>
                Xuất file excel
            </a>

        </div>
    </div>
    <div class='content'>
        @include('partials.flash')		
        <div class='space'></div>
        <div class='row-fluid'>
            
        </div>
    </div>

</div>
@stop
@section('javascript')
<script type="text/javascript" src="{{{asset('js/plugins/bootbox.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/be/tnt.js')}}}"></script>

@stop


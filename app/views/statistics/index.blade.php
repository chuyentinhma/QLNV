@extends('layouts.admin')
@section('css')

<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/select2.css') }}}"/>
<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/addon.css') }}}"/>

@stop

@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Thống kê yêu cầu
        </div>
    </div>
    <div class='content'>
        <div class='row-fluid'>
            <div class='block'>
                <div class='content'>
                    <!--<div class="row-fluid">-->
                    <div class="span1">
                        <label for="start">Từ ngày</label>
                    </div>
                    <div class="span2">
                        <input class="datepicker" id="date_begin" type="text" name="start" value="{{Carbon\Carbon::parse($dateStart)->format('d/m/Y')}}">
                    </div>
                    <div class="span1 offset1">
                        <label for="end">Đến ngày</label>
                    </div>
                    <div class="span2">
                        <input class="datepicker" id="date_end" type="text" name="end" value="{{Carbon\Carbon::parse($dateEnd)->format('d/m/Y')}}">
                    </div>
                    <div class="span2">
                        <button class="btn btn-primary offset4 statistics">Xem thống kê</button>
                    </div>
                    <div class="span3">
                        <a href=""
                           class="btn btn-success btn-print"
                           target="_blank">
                            <i class="i-printer"></i> In báo cáo
                        </a>
                    </div>
                    <!--</div>--> 
                    <div class="clearfix"></div>
                    
                    @include('partials.flash')
                    <hr>
                    <div class='result_statistic'>
                        
                           Yêu cầu đã nhận: {{$totalOrder}}
                            
                           Yêu cầu đã thực hiện:
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('javascript')

<script type="text/javascript" src="{{{asset('js/plugins/jquery.validate.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/plugins/tinymce/tinymce.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/plugins/select2.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/helper.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/app.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/be/common.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/be/tnt.js')}}}"></script>

@stop

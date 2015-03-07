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
                    <div class="row-fluid">
                        <div class="span1">
                            <label for="date_begin">Ngày bắt đầu</label>
                        </div>
                        <div class="span2">
                            <input class="datepicker" id="date_begin" type="text" name="date_begin">
                        </div>
                        <div class="span1 offset1">
                            <label for="date_end">Ngày kết thúc</label>
                        </div>
                        <div class="span2">
                             <input class="datepicker" id="date_end" type="text" name="date_end">
                        </div>
                        <div class="span2">
                            <button class="btn btn-primary offset5">Xem thống kê</button>
                        </div>
                        <div class="span2">
                              <a href=""
                               class="btn btn-success offset0 btn-print"
                               target="_blank">
                                <i class="i-printer"></i> In báo cáo
                            </a>
                        </div>
                    </div> 
                    @include('partials.flash')
                    <hr>
                    
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

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
                    <form class="" method="GET">
                        <div class="controls-row">
                            <label class="span1">Thời gian</label>
                            <select name="time" class="span2 select2 statistics-select-time">
                                
                                <option value="week" >Tuần này</option>
                                <option value="month" >Tháng này</option>
                                <option value="quarter">Quý này</option>
                                <option value="year">Năm này</option>
                                <option value="custom" >Khoảng thời gian</option>
                            </select>
                            <button class="btn btn-primary offset1">Xem thống kê</button>
                            <a href=""
                               class="btn btn-success margin-10 btn-print"
                               target="_blank">
                                <i class="i-printer"></i> In báo cáo
                            </a>
                        </div>
                        <div class="controls-row custom-select-time" style="display:none;" >
                            <label class="span1">Từ ngày</label>
                            <input class="datepicker span2" type="text" name="start" value=""/>
                            <div class="span1"></div>
                            <label class="span1">Đến ngày</label>
                            <input class="datepicker span2" type="text" name="end" value=""/>
                        </div>
                    </form>                    
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

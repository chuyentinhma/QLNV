@extends('layouts.admin')
@section('currentMenu','dashboard')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Trang chủ
        </div>
    </div>
    <div class='content'>
        <div class='row-fluid'>
          <!--  <div class='span9'>    
                <div class="alert alert-block">
                        <strong>Lưu ý : </strong>Có xxx tài liệu đang được đăng ký mượn tài liệu, vui lòng <a href="#">Xem danh sách</a>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <div class='block table-container'>
                </div>
            </div>-->
             <div class='span6'>
                <div class='block'>
                    <div class='head'>
                        <h2>
                            HÔM NAY {{\Carbon\Carbon::now()->format('d/m/Y')}}
                        </h2>
                    </div>
                    <div class='content'>
                        <ul>
                            <li><b>Yêu cầu mới: {{$totalToday}}</b></li>
                            <ul>
                                <li>List : </li>
                                <li>Giám sát: </li>
                                <li>
                                    Trong đó
                                </li>
                                <ul>
                                    <li>PA88:</li>
                                    <li>PA92:</li>
                                </ul>
                            </ul>
                            <li><b>Yêu cầu đã giao:</b> </li>
                            <ul>
                                <li>List : </li>
                                <li>Giám sát: </li>
                                <li>
                                    Trong đó
                                </li>
                                <ul>
                                    <li>PA88:</li>
                                    <li>PA92:</li>
                                </ul>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='span6'>
                <div class='block'>
                    <div class='head'>
                        <h2>
                            HÔM QUA {{\Carbon\Carbon::yesterday()->format('d/m/Y')}}
                        </h2>
                    </div>
                    <div class='content'>
                        <ul>
                            <li><b>Yêu cầu mới: {{$totalYesterday}}</b> </li>
                            <ul>
                                @foreach($purposes as $purpose)
                                <li>{{$purpose->content .': '. $purpose->count_name}} </li>
                                @endforeach
                                <li>
                                    Trong đó
                                </li>
                                <ul>
                                    <li>PA88:</li>
                                    <li>PA92:</li>
                                </ul>
                            </ul>
                            <li><b>Yêu cầu đã giao:</b> </li>
                            <ul>
                                <li>List : </li>
                                <li>Giám sát: </li>
                                <li>
                                    Trong đó
                                </li>
                                <ul>
                                    <li>PA88:</li>
                                    <li>PA92:</li>
                                </ul>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
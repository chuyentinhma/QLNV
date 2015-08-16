@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách yêu cầu
        </div>
        <div class='page-tools'>
            <a class='btn btn-primary' href='{{route('ships.create')}}'>
                <i class="i-plus-2"></i>
                Giao yêu cầu
            </a>
            <a class='btn btn-success' href='#'>
                <i class="i-file"></i>
                Xuất file excel
            </a>

        </div>
    </div>
    <div class='content'>
        @include('partials.flash')		
        <div class='space'></div>
        <div class='row-fluid'>
            <div class='block table-container'>
                <div class='head'>
                    <h2>Tổng số {{$ships->getTotal()}} </h2>
                    <div class='toolbar-table-right'>
                        <div class='input-append'>
                            <input placeholder='Tìm kiếm ...' type="text" class="table-search-input"  data-url="{{route('search')}}">
                            <button class="btn btn-book-search" type="button">
                                <span class='icon-search'></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class='content np table-sorting'>
                    <table cellpadding='0' cellspacing='0' class='sort' width='100%'>
                        <thead>
                            <tr>
                                <th style='width:1%'>Số TT</th>
                                <th style='width:6%'>Ngày tháng</th>
                                <th style='width:3%'>Số Cv Đơn vị</th>
                                <th style='width:5.5%'>Số Cv PA71</th>
                                <th style='width:11%'>Tên đối tượng</th>
                                <th style='width:5.5%'>Số điện thoại</th>
                                <th style='width:3%'>Loại ĐT</th>
                                <th style='width:3%'>Tính chất</th>
                                <th style="width: 7%">Mục đích y/c</th>
                                <th style='width:6%'>Số bản tin</th>
                                 <th style='width:6%'>Số trang tin</th>
                                
                                <th>Người giao</th>
                                <th style='width:11%'>Người nhận</th>
                                <th style="width: 8%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ships as $index => $ship)
                            <tr>
                                <td >{{ ++$index }}</td>
                                <td >{{\Carbon\Carbon::parse($ship->date_submit)->format('d/m/Y')}}</td>
                                <td >
                                    {{$ship->customer->order->number_cv . '/' .$ship->customer->order->unit->symbol}}
                                </td>
                                <td>{{$ship->customer->order->number_cv_pa71}}</td>
                                <td>{{$ship->customer->order->customer_name}}</td>
                                <td>{{$ship->customer->phone_number}}</td>
                                <td>{{$ship->customer->order->category->symbol}}</td>
                                <td>{{$ship->customer->order->kind->symbol}}</td>
                                <td>
                                    @foreach($ship->customer->order->purposes as $purpose)
                                    {{$purpose->content}}<br>
                                    @endforeach
                                </td>
                                <td>{{$ship->news_number}}</td>
                                <td>{{$ship->page_number}}</td>
                                <td>{{$ship->customer->order->user->username}}</td>
                                <td>{{$ship->receive_name}}</td>
                                <td class="text-center" >
                                    <a class="btn btn-warning btn-mini" href="{{route('ships.edit',$ship->id)}}" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" data-confirm="Bạn có chắc chắn muốn xóa bản ghi này" btn-confirm="confirm" data-url="{{route('ships.delete',$ship->id)}}" title="Xóa">
                                        <i class="icon-trash"></i>
                                    </a>

                                </td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='footer'>
                    <span class="loading" style="margin-left: 50px; display: none">
                        <img src="{{asset('img/loading.gif')}}"/>
                        Đang tải . . .
                    </span>
                    <div class='side fr'>
                        <div class='pagination'>
                            {{ $ships->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
@section('javascript')
<script type="text/javascript" src="{{{asset('js/plugins/bootbox.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/be/tnt.js')}}}"></script>

@stop

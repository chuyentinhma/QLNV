@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách yêu cầu
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
            <div class='block table-container'>
                <div class='head'>
                    <div class="row-fluid">
                        <div class="span6">
                            <span>Hiển thị:</span>
                            <select class="listPurpose" id="sel1" style="margin-top: 5px">  
                                <option value="0">Tất cả</option>
                                <option value="1">DS Giám sát</option>
                                <option value="2">DS List</option>
                            </select>
                        </div>
                        <div class='toolbar-table-right'>
                            <div class='input-append'>
                                <input placeholder='Tìm kiếm ...' type="text" class="table-search-input"  data-url="{{route('search')}}">
                                <button class="btn btn-book-search" type="button">
                                    <span class='icon-search'></span>
                                </button>
                            </div>
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
                                <th>Số điện thoại</th>
                                <th>Loại ĐT</th>
                                <th>Tính chất</th>
                                <th>Thời gian yêu cầu</th>
                                <th>Mục đích y/c</th>
                                <th style='width:15%'>TS y/c (Số ĐT)</th>
                                <th style='width:1%'>Tình trạng</th>
                                <th style='width:5%'>Ghi chú</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $order)
                            <tr>
                                <td rowspan="{{count($order->customers)}}">{{ ++$index }}</td>
                                <td rowspan="{{count($order->customers)}}">{{\Carbon\Carbon::parse($order->date_submit)->format('d/m/Y')}}</td>
                                <td rowspan="{{count($order->customers)}}">
                                    {{$order->number_cv . '/' . $order->unit->symbol}}
                                </td>
                                <td rowspan="{{count($order->customers)}}">{{$order->number_cv_pa71}}</td>
                                <td rowspan="{{count($order->customers)}}"><a href="{{ URL::to('orders/show/' . $order->id ) }}">{{$order->customer_name}}</a></td>
                                <td>
                                    @foreach ($order->customers as $index => $customer)
                                        @if(++$index <= 1)
                                            {{ $customer->phone_number }}
                                        @endif
                                    @endforeach
                                </td>
                                <td rowspan="{{count($order->customers)}}">{{$order->category->symbol}}</td>
                                <td rowspan="{{count($order->customers)}}">{{$order->kind->symbol}}</td>
                                <td rowspan="{{count($order->customers)}}">{{\Carbon\Carbon::parse($order->date_begin)->format('d/m/Y'). '&rarr;' . \Carbon\Carbon::parse($order->date_end)->format('d/m/Y')}}</td>
                                <td rowspan="{{count($order->customers)}}">
                                    @foreach ($order->purposes as $purpose)
                                    {{ $purpose->content }}
                                    @endforeach
                                </td>
                                <td rowspan="{{count($order->customers)}}">{{$order->order_name . '/ '. $order->order_phone}}</td>
                                <td>
                                    @foreach ($order->customers as $index => $customer)
                                        @if(++$index <= 1)
                                            @if($customer->status == "ok")
                                                <a class="btn btn-success btn-mini">
                                                    <i class="icon-ok"></i>
                                                </a>
                                            @elseif($customer->status == "close") 
                                                <a class="btn btn-danger btn-mini">
                                                    <i class="icon-remove"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td rowspan="{{count($order->customers)}}">{{$order->comment}}</td>
                                <td class="text-center" rowspan="{{count($order->customers)}}">
                                    <a class="btn btn-warning btn-mini" href="{{route('orders.edit',$order->id)}}" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" data-confirm="Bạn có chắc chắn muốn xóa yêu cầu {{$order->number_cv . '/' . $order->unit->symbol}}. Nếu xóa thì những dữ liệu liên quan củng sẽ bị xóa!" btn-confirm="confirm" data-url="{{route('orders.delete',$order->id)}}" title="Xóa">
                                        <i class="icon-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            @foreach($order->customers as  $index => $customer)
                            @if(++$index > 1)
                            <tr>
                                <td>{{$customer->phone_number}}</td>
                                <td>
                                    @if($customer->status == "ok")
                                        <a class="btn btn-success btn-mini">
                                            <i class="icon-ok"></i>
                                        </a>
                                    @elseif($customer->status == "close") 
                                        <a class="btn btn-danger btn-mini">
                                            <i class="icon-remove"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='footer'>
                    <span class="loading" style="margin-left: 50px; display: none">
                        <img src="{{asset('img/loading.gif')}}"/>
                        Đang tải . . .
                    </span>
                    <div class="row-fluid">
                        <div class="span6">
                            <span>Số bản ghi tối đa trên một trang:</span>
                            <select class=" perPage" id="sel1" style="margin-top: 5px">
                                <option>5</option>
                                <option>10</option>
                                <option>20</option>
                                <option>40</option>
                            </select>
                        </div>
                        <!--<div class='side fr'>-->
                        <div class='pull-right pagination'>
                            {{ $orders->links() }}
                        </div>
                        <!--</div>-->
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

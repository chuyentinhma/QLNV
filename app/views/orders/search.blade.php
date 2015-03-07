<div class='block table-container'>
    <div class='head'>
        <div class="row-fluid">
            <div class="span6">
                <span>Hiển thị:</span>
                <select class="listPurpose" id="sel1" style="margin-top: 5px">  
                    <option>Tất cả</option>
                    <option>DS Giám sát</option>
                    <option>DS List</option>
                </select>
            </div>
            <div class='toolbar-table-right'>
                <div class='input-append'>
                    <input placeholder='Tìm kiếm ...' type="text" value="<?php echo isset($keyword) ? $keyword : '' ?>" class="table-search-input"  data-url="{{route('search')}}">
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
                    <td></td>
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
                    <td></td>
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
            <!--<div class='side fr'>-->
            <div class="span6">
                <span>Số bản ghi tối đa trên một trang:</span>
                <select class=" perPage" data-url="{{route('orders.index')}}" id="sel1" style="margin-top: 5px">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>40</option>
                </select>
            </div>
            <div class='pull-right pagination ajax'>
                {{ $orders->links() }}
            </div>
            <!--</div>-->
        </div>

    </div>
</div>
<script>
    $('[btn-confirm="confirm"]').on('click', function () {
        var dataConfirm = $(this).attr('data-confirm');
        if (typeof dataConfirm === "undefined") {
            dataConfirm = "Bạn có chắc chắn ?";
        }
        var dataUrl = $(this).attr('data-url');
        bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function (result) {
            if (result) {
                location.href = dataUrl;
            }
        });
        return false;
    });
</script>



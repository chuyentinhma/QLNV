@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách tính chất vụ án
        </div>
        <div class='page-tools'>
            <a class='btn btn-primary' href='{{route('kinds.create')}}'>
                <i class="i-plus-2"></i>
                Thêm mới
            </a>
        </div>
    </div>
    <div class='content'>
        @include('partials.flash')		
        <div class='space'></div>
        <div class='row-fluid'>
            <div class='block table-container'>
                <div class='head'>
                    <h2>Tổng số {{$kinds->getTotal()}} tính chất</h2>
                    <div class='toolbar-table-right'>
                        <div class='input-append'>
                            <input placeholder='Tìm kiếm ...' type="text" class="table-search-input"  data-url="#">
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
                                <th style='width:6%'>Số TT</th>
                                <th style='width:10%;text-align: center'>Bí danh</th>
                                <th style='width:54%;text-align: center'>Chú thích</th>
                                <th style='width:10%'>Ngày tạo</th>
                                <th style='width:10%'>Ngày sửa</th>
                                <th style='width:10%'>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kinds as $index => $kind)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>
                                   {{$kind->symbol}}
                                </td>
                                <td>
                                    {{$kind->description}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($kind->created_at)->format('d/m/Y')}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($kind->updated_at)->format('d/m/Y')}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-mini" href="{{route('kinds.edit',$kind->id)}}" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" data-confirm="Bạn có chắc chắn muốn xóa kiểu đối tượng {{$kind->symbol}}" btn-confirm="confirm" data-url="{{route('kinds.delete',$kind->id)}}" title="Xóa">
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
                            {{ $kinds->links() }}
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

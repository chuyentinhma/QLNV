@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách các kiểu yêu cầu
        </div>
        <div class='page-tools'>
            <a class='btn btn-primary' href='{{route('purposes.create')}}'>
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
                    <h2>Tổng số {{$purposes->getTotal()}} kiểu yêu cầu</h2>
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
                            @foreach($purposes as $index => $purpose)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>
                                   {{$purpose->content}}
                                </td>
                                <td>
                                    {{$purpose->comment}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($purpose->created_at)->format('d/m/Y')}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($purpose->updated_at)->format('d/m/Y')}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-mini" href="{{route('purposes.edit',$purpose->id)}}" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" data-confirm="Bạn có chắc chắn muốn xóa kiểu đối tượng {{$purpose->content}}" btn-confirm="confirm" data-url="{{route('purposes.delete',$purpose->id)}}" title="Xóa">
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
                            {{ $purposes->links() }}
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

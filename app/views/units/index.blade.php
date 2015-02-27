@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách đơn vị
        </div>
        <div class='page-tools'>
            <a class='btn btn-primary' href='{{route('units.create')}}'>
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
                    <h2>Tổng số {{$units->getTotal()}} đơn vị</h2>
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
                                <th style='width:5%'>Số TT</th>
                                <th style='width:10%'>Bí danh</th>
                                <th style='width:40%'>Tên đơn vị</th>
                                <th style='width:10%'>Khối</th>
                                <th style='width:10%'>Ngày tạo</th>
                                <th style='width:10%'>Ngày sửa</th>
                                <th style='width:10%'>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $index => $unit)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>
                                   {{$unit->symbol}}
                                </td>
                                <td>
                                    {{$unit->name}}
                                </td>
                                <td>
                                    {{$unit->block}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($unit->created_at)->format('d/m/Y')}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($unit->updated_at)->format('d/m/Y')}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-mini" href="{{route('units.edit',$unit->id)}}" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" data-confirm="Bạn có chắc chắn muốn xóa đơn vị {{$unit->symbol}}" btn-confirm="confirm" data-url="{{route('units.delete',$unit->id)}}" title="Xóa">
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
                            {{ $units->links() }}
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

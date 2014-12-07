@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Danh sách yêu cầu
        </div>
        <div class='page-tools'>
            <button class="btn btn-primary" type="submit"><span  class="i-plus-2"></span>Thêm yêu cầu</button>
            <button class="btn btn-success" type="submit"><span  class="i-file"></span>Xuất file excel</button>

        </div>
    </div>
    <div class='content'>
        @include('partials.flash')		
        <div class='space'></div>
        <div class='row-fluid'>
            <div class='block table-container'>
                <div class='head'>
                    <h2>Hiển thị 0 yêu cầu</h2>
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
                                <th style='width:5%'>Số TT</th>
                                <th>Ngày tháng</th>
                                <th>Số Cv/Đơn vị</th>
                                <th>Số Cv/PA71</th>
                                <th>Tên đối tượng</th>
                                <th>Số điện thoại</th>
                                <th>Loại ĐT</th>
                                <th>Tính chất</th>
                                <th>Thời gian yêu cầu</th>
                                <th>Mục đích y/c</th>
                                <th>TS y/c (Số ĐT)</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>					
                            <tr>
                                <td>1</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-mini" href="#" title="Sửa">
                                        <i class="icon-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-mini" href="#" title="Xóa">
                                        <i class="icon-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>
                                <td>dsfds</td>

                            </tr>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
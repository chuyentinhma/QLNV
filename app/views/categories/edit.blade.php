@extends('layouts.admin')
@section('css')

<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/select2.css') }}}"/>
<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/addon.css') }}}"/>

@stop

@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Sửa kiểu đối tượng
        </div>
        <div class='page-tools'>
            <ul>
                <li>
                    <a class='btn btn-small' href='{{route('categories.index')}}'>
                        <i class='i-reply'></i>
                        Danh sách các loại đối tượng
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class='content'>
        <div class='row-fluid'>
            @include('partials.flash')
            <div class='span12'>
                <!-- <div class='span6'>-->
                <div class='block'>
                    <div class='head'>
                        <h2>Nhập thông tin đơn vị</h2>
                    </div>
                    <div class='content'>

                        {{ Former::horizontal_open(route('categories.update',$category->id))->method('PUT')->id('form_category') }}
                        <div class='span10 offset2'>
                             {{Former::xlarge_text('symbol')
                                        ->label('Bí danh')
                                        ->value($category->symbol)
                            }}
                            {{Former::xlarge_text('description')
                                        ->label('Chú thích')
                                        ->value($category->description);
                            }}
                        </div>

                    </div>
                </div>
                <!--    </div>-->

            </div>
            <div class="space"></div>
            <div class='footer'>
                <div class='text-center'>

                    <button class='btn' type="reset">
                        <i class='i-ccw'></i>
                        Nhập lại
                    </button>
                    <button class='btn btn-success btn-save-book' name="redirect" value="1" type="submit">
                        <i class='i-checkmark-2'></i>
                        Lưu
                    </button>
                </div>
            </div>
            {{ Former::close() }}
        </div>
    </div>

</div>

@stop

@section('javascript')

<script type="text/javascript" src="{{{asset('js/plugins/bootbox.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/plugins/jquery.validate.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/plugins/tinymce/tinymce.min.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/plugins/select2.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/helper.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/app.js')}}}"></script>
<script type="text/javascript" src="{{{asset('js/be/common.js')}}}"></script>


@stop

@extends('layouts.admin')
@section('css')

<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/select2.css') }}}"/>
<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/addon.css') }}}"/>

@stop

@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Giao List - XMCTB
        </div>
        <div class='page-tools'>
            <ul>
                <li>
                    <a class='btn btn-small' href='{{route('shipslists.index')}}'>
                        <i class='i-reply'></i>
                        Danh sách
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
                        <h2>Nhập thông tin yêu cầu</h2>
                    </div>
                    <div class='content'>

                        {{ Former::horizontal_open(route('shipslists.update',$list->id))->method('PUT')->id('form_ship_list_update') }}
                        <div class='offset2'>
                            <div class="control-group">
                                <label for="customer_id" class="control-label">Số công văn - Thuê bao</label>
                                <div class="controls">
                                    <select class="select2" id="customer_id" name="customer_id">
                                        @foreach($orders as $order)
                                        <optgroup label="{{$order->number_cv . '/' . $order->unit->symbol}}">
                                            @foreach ($order->customers as $index => $customer)
                                                @if($list->customer_id == $customer->id)
                                                    <option value="{{$customer->id}}" selected="">
                                                        {{ $customer->phone_number }}
                                                    </option>
                                                @else
                                                    <option value="{{$customer->id}}">
                                                        {{ $customer->phone_number }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{Former::large_text('date_submit')
                                        ->label('Ngày giao')
                                        ->class('datepicker')
                                        ->value(\Carbon\Carbon::parse($list->date_submit)->format('d/m/Y'))
                            }}
                            {{Former::large_text('page_number')
                                        ->label('Số trang list / xmctb')
                                        ->value($list->page_number)
                            }}
                            {{Former::file('file')
                                ->label('Tệp đính kèm')
                                ->accept('doc', 'docx', 'xls', 'xlsx', 'pdf')
                            }}
                            {{Former::select('user_id')
                                ->label('Người giao')
                                ->options($users,$list->user->id)
                                ->class('select2')
                            }}
                            {{Former::large_text('receive_name')
                                        ->label('Người nhận')
                                        ->value($list->receive_name)
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
                    <button class='btn btn-success btn-save-book' type="submit">
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
<script type="text/javascript" src="{{{asset('js/be/tnt.js')}}}"></script>

@stop

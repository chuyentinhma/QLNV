@extends('layouts.admin')
@section('css')

<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/select2.css') }}}"/>
<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/addon.css') }}}"/>

@stop

@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Giao yêu cầu
        </div>
        <div class='page-tools'>
            <ul>
                <li>
                    <a class='btn btn-small' href='{{route('ships.index')}}'>
                        <i class='i-reply'></i>
                        Sổ giao yêu cầu
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

                        {{ Former::horizontal_open(route('ships.edit',$ship->id))->method('POST')->id('form_ship_update') }}
                        <div class='span5'>
                            {{Former::large_text('date_submit')
                                        ->label('Ngày giao')
                                        ->class('datepicker')
                                        ->value(\Carbon\Carbon::parse($ship->date_submit)->format('d/m/Y'))
                            }}

                            {{Former::large_text('number_cv_pa71')
                                        ->label('Số công văn PA71(*)')
                                        ->value($ship->number_cv_pa71)
                            }}

                            {{Former::large_text('customer_phone_number')
                                        ->label('Số điện thoại yêu cầu')
                                        ->value($ship->customer->phone_number)
                            }}
                            {{Former::select('user_id')
                                ->label('Người giao')
                                ->options($users)
                                ->class('select2',$ship->user->username)
                            }}

                        </div>
                        <div class='span7'>

                            <div class="control-group">
                                <label for="purpose" class="control-label">Nội dung yêu cầu</label>
                                <div class="controls">
                                    <?php foreach ($purposes as $k => $v): ?>
                                        <label  class="checkbox inline">                                
                                            <input type="checkbox" name="purpose[]"  purpose="<?php echo $v ?>" value="<?php echo $k ?>"
                                            @foreach ($ship->customer->order->purposes as $purpose) 
                                                @if ($k == $purpose->id) 
                                                    {{"checked"}}
                                                    break;
                                                @endif
                                            @endforeach
                                                   >
                                                   <?php echo $v ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="control-group news_number"  style="display: none">
                                <label for="news_number" class="control-label">Số bản tin</label>
                                <div class="controls">
                                    <input class="input-large" id="news_number" type="text" name="news_number" value="{{$ship->news_number}}">
                                </div>

                            </div>
                            {{Former::large_text('page_number')
                                        ->label('Số trang tin')
                                        ->value($ship->page_number)
                            }}
                            {{Former::large_text('receive_name')
                                        ->label('Người nhận')
                                        ->value($ship->receive_name)
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
                        Lưu và tiếp tục
                    </button>
                    <button class='btn btn-primary btn-save-book' name="redirect" value="0" type="submit" onclick="if(!confirm('Are you sure to delete this item?')){return false;};">
                        <i class='icon-book'></i>
                        Lưu và trở lại danh sách
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

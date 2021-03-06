@extends('layouts.admin')
@section('css')

<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/select2.css') }}}"/>
<link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/addon.css') }}}"/>

@stop

@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Chỉnh sửa yêu cầu {{$order->number_cv . '/' . $order->unit->symbol}}
        </div>
        <div class='page-tools'>
            <ul>
                <li>
                    <a class='btn btn-small' href='{{route('orders.index')}}'>
                        <i class='i-reply'></i>
                        Danh sách yêu cầu
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

                        {{ Former::horizontal_open(route('orders.edit',$order->id))->method('POST')->id('form_order') }}
                        <div class='span5'>
                            {{Former::large_text('created_at')->label('Ngày yêu cầu')->class('datepicker')->value(\Carbon\Carbon::parse($order->date_submit)->format('d/m/Y'))}}
                            {{Former::large_text('number_cv')->label('Số công văn yêu cầu (*)')->value($order->number_cv)}}
                            {{Former::select('unit')
                                ->label('Đơn vị yêu cầu')
                                ->options($units,$order->unit_id)
                                ->class('select2')
                            }}
                            {{Former::large_text('number_cv_pa71')->label('Số công văn PA71(*)')->value($order->number_cv_pa71)}}
                            {{Former::large_text('customer_name')->label('Tên đối tượng (*)')->value($order->customer_name)}}
                            <?php
                                $customer_phone = '';
                                foreach ($order->customers as $customer) {
                                    
                                    $customer_phone .=  $customer->phone_number . ',';
                                }
                                $customer_phone = trim($customer_phone, ",")
                            ?>
                            {{Former::text('customer_phone_number')->label('Số điện thoại ĐT (*)')->class('select2')->setAttribute('tags', '1')->value($customer_phone)->disabled()}}
                            {{Former::large_text('order_name')->label('Tên trinh sát(*)')->value($order->order_name)}}
                            {{Former::large_text('order_phone_number')->label('Số điện thoại TS (*)')->value($order->order_phone)}}

                        </div>
                        <div class='span7'>
                            {{Former::select('category')
                                ->label('Loại đối tượng')
                                ->options($categories, $order->category_id)
                                ->class('select2')
                            }}
                            {{Former::select('kind')
                                ->label('Tính chất')
                                ->options($kinds, $order->kind_id)
                                ->class('select2')
                            }}
                            <div class="control-group">
                                <label for="purpose" class="control-label">Nội dung yêu cầu</label>
                                <div class="controls">
                                    <?php foreach ($purposes as $k => $v): ?>
                                        <label  class="checkbox inline">                                
                                            <input type="checkbox" name="purpose[]" value="<?php echo $k ?>" 
                                            <?php
                                            foreach ($order->purposes as $purpose) {
                                                if ($k == $purpose->id) {
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                            ?>
                                                   >
                                                   <?php echo $v ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            {{Former::large_text('date_begin')->label('Ngày bắt đầu')->class('datepicker')->value(\Carbon\Carbon::parse($order->date_begin)->format('d/m/Y'))}}
                            {{Former::large_text('date_end')->label('Ngày kết thúc')->class('datepicker')->value(\Carbon\Carbon::parse($order->date_end)->format('d/m/Y'))}}
                            {{Former::select('user_get')
                                ->label('Người nhận yêu cầu')
                                ->options($users, $order->user_id)
                                ->class('select2')
                            }}
                            {{Former::textarea('comment')
                                ->label('Ghi chú')
                                ->class('input-xlarge editor')
                                ->value($order->comment)
                                ->rows(4)
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

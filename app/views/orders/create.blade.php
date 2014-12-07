@extends('layouts.admin')
@section('content')
<div class="wrap">
    <div class='head'>
        <div class='page-title'>
            Tạo mới yêu cầu
        </div>
        <div class='page-tools'>
            <ul>
                <li>
                    <a class='btn btn-small' href='{{route('order.detail')}}'>
                        <i class='i-reply'></i>
                        Danh sách yêu cầu
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class='content'>
        <div class='row-fluid'>
            <div class='span12'>
                <!-- <div class='span6'>-->
                <div class='block'>
                    <div class='head'>
                        <h2>Nhập thông tin yêu cầu</h2>
                    </div>
                    <div class='content'>

                        {{ Former::horizontal_open(route('order.add'))->method('POST') }}
                        <div class='span6'>
                            {{Former::xlarge_text('number_cv')->label('Số công văn yêu cầu (*)')}}
                            {{Former::select('unit')
                                ->label('Đơn vị yêu cầu')
                                ->options($units)
                                ->class('select2')
                            }}
                            {{Former::xlarge_text('number_cv_pa71')->label('Số công văn PA71(*)')}}
                            {{Former::xlarge_text('customer_name')->label('Tên đối tượng (*)')}}
                            {{Former::xlarge_text('customer_phone_number')->label('Số điện thoại ĐT (*)')}}
                            {{Former::xlarge_text('order_name')->label('Tên trinh sát(*)')}}
                            {{Former::xlarge_text('order_phone_number')->label('Số điện thoại TS (*)')}}
                            {{Former::select('category')
                                ->label('Loại đối tượng')
                                ->options($categories)
                                ->class('select2')
                            }}
                            {{Former::select('kind')
                                ->label('Tính chất')
                                ->options($kinds)
                                ->class('select2')
                            }}
                        </div>
                        <div class='span6'>
                            <div class="control-group">
                                <label for="permissions" class="control-label">Nội dung yêu cầu</label>
                                <div class="controls">
                                    <?php foreach ($purposes as $k => $v): ?>
                                        <label  class="checkbox">                                
                                            <input type="checkbox" name="permission[]" value="<?php echo $k ?>"><?php echo $v ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            {{Former::large_text('date_begin')->label('Ngày bắt đầu')->class('datepicker')}}
                            {{Former::large_text('date_end')->label('Ngày kết thúc')->class('datepicker')}}
                            {{Former::xlarge_text('username')->label('Người nhận yêu cầu')}}
                            {{Former::textarea('comment')
                                ->label('Ghi chú')
                                ->class('input-xlarge editor')
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
                    <button class='btn btn-success btn-save-book' data-redirect="create" type="button">
                        <i class='i-checkmark-2'></i>
                        Lưu và tiếp tục
                    </button>
                    <button class='btn btn-primary btn-save-book' data-redirect="index" type="button">
                        <i class='icon-book'></i>
                        Lưu và trở lại danh sách
                    </button>
                </div>
            </div>
            <?php echo Former::close() ?>
        </div>
    </div>

</div>
@stop

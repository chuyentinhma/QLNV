@if(Session::has('success') || Session::has('error') || Session::has('warning'))
<div class="margin-5">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @elseif(Session::has('error'))
    <div class="alert alert-error">
        {{Session::get('error')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @elseif(Session::has('warning'))
    <div class="alert alert-block">
        <strong>Lưu ý : </strong>{{Session::get('warning')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif
</div>
@endif
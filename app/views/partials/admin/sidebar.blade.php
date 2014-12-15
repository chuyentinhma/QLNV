<div id='sidebar'>
    <div class='user'>
        <div class='pic'>
            <img src="{{asset('img/default_avatar.png')}}">
        </div>
        <div class='info'>
            <div class='name'
                 <a href='#'></a>
            </div>
            <div class='buttons'>
                <a href='#' target="_blank">
                    Xin chào {{ Auth::user()->username}}
                </a>
                <a class='fr' href='{{{ route('logout') }}}'>
                    <span class='i-forward'></span>
                    Đăng xuất
                </a>
            </div>
        </div>
    </div>
    <ul class='navigation'>
        <li class=''>
            <a href='{{route('dashboard')}}'>Bảng điều khiển</a>
        </li>
        <li class='openable open'>
            <a href='#'>Sổ nhận yêu cầu</a>
            <ul>
                <li class=''>
                    <a href='{{route('orders.index')}}'>Danh sách yêu cầu</a>
                </li>
                <li class=''>
                    <a href='{{route('orders.add')}}'>Thêm mới yêu cầu</a>
                </li>
            </ul>
        </li>
        <li class='openable open'>
            <a href='#'>Sổ thực hiện yêu cầu</a>
            <ul>
                <li class=''>
                    <a href='{{route('ship.detail')}}'>Chi tiết...</a>
                </li>
                <li class=''>
                    <a href='{{route('ship.update')}}'>Cập nhật yêu cầu đã thực hiện</a>
                </li>
            </ul>
        </li>
        <li class='openable open'>
            <a href='#'>Thao tác</a>
            <ul>
                <li class=''>
                    <a href='#'>Báo cáo, thống kê</a>
                </li>
                <li class=''>
                    <a href='#'>Tìm kiếm</a>
                </li>
                <li class=''>
                    <a href='#'>Tìm kiếm nâng cao</a>
                </li>
            </ul>
        </li>
        <li class='openable open'>
            <a href='#'>Quản trị hệ thống</a>
            <ul>
                <li class=''>
                    <a href='#'>Cài đặt</a>
                </li>
                <li class=''>
                    <a href='#'>Quản lý user</a>
                </li>
                <li class=''>
                    <a href='#'>Nhật ký sử dụng</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
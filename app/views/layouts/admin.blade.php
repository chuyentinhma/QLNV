<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <![endif]-->
        <title>Quảng Bình</title>
        <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.jpg') }}"/>
        <link media="all" rel="stylesheet" type="text/css" href="{{{ asset('css/all.css') }}}"/>
        @yield('css')
        <!--[if lte IE 7]>
        <script type='text/javascript' src='js/other/lte-ie7.js'></script>
        <![endif]-->

    </head>
    <body>
        <div id="wrapper" class="screen_wide ">
            <div id='header'>
                <div class='wrap'>
                    <a class='logo' href='#'>
                        PHÒNG PA71 - QUẢNG BÌNH
                    </a>
                    <div class='buttons fl'>
                        <div class='item'>
                            <a class='btn btn-primary btn-small c_layout' href='#' title='Ẩn/Hiện Sidebar'>
                                <span class='i-layout-8'></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="layout">
                @include('partials.admin.sidebar')
                <div id="content">
                    @yield('content')
                </div>
                @yield('extra_html')
            </div>
        </div>
        
        <script type="text/javascript" src="{{{asset('js/all.js')}}}"></script>
        <script type="text/javascript" src="{{{asset('js/actions.js')}}}"></script>
        @yield('javascript')
        
    </body>
</html>

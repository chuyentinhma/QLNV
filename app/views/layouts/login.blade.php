<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <![endif]-->
        <title>Quản lý yêu cầu BP3</title>
        <link rel="icon" type="image/ico" href="favicon.ico"/>
        <script type="text/javascript" src="{{{asset('js/all.js')}}}"></script>
        <link media="screen" rel="stylesheet" type="text/css" href="{{{ asset('css/all.css') }}}"/>
        <link media="screen" rel="stylesheet" type="text/css" href="{{{ asset('css/admin_login.css') }}}"/>

        <!--[if lte IE 7]>
        <script type='text/javascript' src='js/other/lte-ie7.js'></script>
        <![endif]-->

    </head>
    <body>

        <div id="wrapper" class="screen_wide sidebar_off">

            <div id="layout">

                <div id="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

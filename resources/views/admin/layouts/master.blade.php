<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="Dashboard by Codiano">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    @yield('css')
    @include('admin.includes.css')
</head>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            @include('admin.includes.header')
        <div class="app-main">
            @include('admin.includes.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">
                @include('admin.includes.title')
                @include('admin.includes.msg')
                <!-- Main content -->
                        @yield('content')
                </div>
            </div>
        </div>
    </div>
@stack('modal')
@include('admin.includes.js')
@yield('js')
@yield('inner_script')
</body>
</html>

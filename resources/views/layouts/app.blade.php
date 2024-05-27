<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title')
    </title>
    @include('layouts.partials.css')
    <![endif]-->
</head>
<body>
<!--Loader-->
<div class="loader">
    <div class="spinner-load">
        <div class="dot1">
        </div>
        <div class="dot2">
        </div>
    </div>
</div>
<!--TOPBAR-->
@include('layouts.partials.topbar')
<!--HEADER-->
@include('layouts.partials.header')
    @yield('content')
<!--Footer-->
@include('layouts.partials.footer')

@include('layouts.partials.javascripts')
</body>
</html>


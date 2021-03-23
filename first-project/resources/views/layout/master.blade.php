<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    @include('layout.partials.head')
    @yield('head')
</head>
    <body id="commerce">
        @include('layout.partials.navbar')
        @yield('content')
        
        @include('layout.partials.footer',['year'=>'2021'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
        @yield('footer')
    </body>
</html>
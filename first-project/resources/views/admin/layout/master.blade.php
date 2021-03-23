<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name').' - Admin Panel' )</title>
    @include('admin.layout.partials.head')
    @yield('head')
</head>
    <body>
        @include('admin.layout.partials.nav')
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-2 sidebar collapse" id="sidebar">
                    @include('admin.layout.partials.sidebar')
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src="/js/admin/app.js"></script>
        @yield('footer')
    </body>
</html>
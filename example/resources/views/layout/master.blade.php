<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name'))</title>

        @include('layout.partials.head')
        @yield('head')
    </head>
<body>
<!-- wpf loader Two -->
<div id="wpf-loader-two">          
    <div class="wpf-loader-two-inner">
        <span>Loading</span>
    </div>
</div> 
<!-- / wpf loader Two -->      

<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TOP BUTTON -->

    @include('layout.partials.nav')

    @yield('content')
    
    @include('layout.partials.footer')

    @include('layout.partials.scripts')
    @yield('scripts')
</body>
</html>
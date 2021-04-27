<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  @include('admin.layout.partials.head')
  @yield('head')

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('admin.layout.partials.nav')
    @include('admin.layout.partials.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer style="display: flex; justify-content: space-between; align-items: center; padding: .25rem 1rem" class="main-footer">    
        <span style="font-size: 12px">
            <strong>Copyright &copy;<a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
        </span>
        <span>
            Furkan's Accounts = 
            <a style="margin-right: .5rem;color:#6e5494; font-size:1.5rem" href="https://github.com/furkanaygur"><i class="fab fa-github"></i></a>
            <a style="color:#0072b1; font-size:1.5rem" href="https://www.linkedin.com/in/furkanaygur/"><i class="fab fa-linkedin"></i></a>
        </span>
    </footer>
</div>
<!-- ./wrapper -->

@include('admin.layout.partials.scripts')
@yield('scripts')
</body>
</html>
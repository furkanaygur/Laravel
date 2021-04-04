<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  @include('admin.layout.partials.head')

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('admin.layout.partials.nav')
    @include('admin.layout.partials.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">    
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->

@include('admin.layout.partials.scripts')
@yield('scripts')
</body>
</html>
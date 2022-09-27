<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Orders</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("/plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset("/plugins/summernote/summernote-bs4.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/dist/css/adminlte.min.css")}}">
    <!-- Action specific styles -->
    @php
        $usedRoute = request()->route()->getAction();
        $usedRoute = explode('\\', $usedRoute['uses']);
        $usedRoute = explode('@', $usedRoute[count($usedRoute) - 1]);
        $controller = str_replace("controller", "", strtolower($usedRoute[0]));
        $action = $usedRoute[1];
    @endphp
    <link href="{{asset("/css/".$controller."/".$action.".css")}}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    @yield('content')
</div>

<!-- jQuery -->
<script src="{{asset("/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("/plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/dist/js/adminlte.min.js")}}"></script>
<!-- Summernote -->
<script src="{{asset("/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- Action specific script -->
<script src="{{asset("/js/" . $controller . "/" . $action . ".js")}}"></script>
</body>
</html>



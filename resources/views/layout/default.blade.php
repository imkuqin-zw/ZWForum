<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')-ZWForum</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" >
    @yield('styles')
    <style>

    </style>
</head>
<body>
<div class="wrap">
    @include('layout.nav')
    @yield('content')
    @include('layout.footer')
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script type="text/javascript" >
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@yield('script')
</body>
</html>
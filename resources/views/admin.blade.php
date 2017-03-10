<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理-ZWForum</title>
    <link rel="stylesheet" href="{{mix('assets/css/app.css')}}" >
    <script>
      window.Domain = "{{asset('/')}}"
      window.PortraitsUrl = window.Domain + "uploads/portraits/"
      window.Laravel = {
        csrfToken: "{{ csrf_token() }}"
      }
      window.Time = "{{date('Y-m-d H:i:s',time())}}"
      window.User = {!! Auth::user() !!}
      window.Roles = {!! Auth::user()->roles !!}
      window.Language = "{{ config('app.locale') }}"
    </script>
</head>
<body class="skin-blue sidebar-mini" style="height: auto;">
    <div id="app"></div>
    <script src="{{mix('assets/js/app.js')}}" ></script>
</body>
</html>
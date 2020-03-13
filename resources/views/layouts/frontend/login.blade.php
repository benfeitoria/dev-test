<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema do Blog</title>
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="login-page" style="min-height: 512.391px;">
    <div class="login-box">
        @yield('content')
    </div>
    <!-- /.login-box -->
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
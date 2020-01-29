<!DOCTYPE html>
<html>
<head>
    <title>Blog Teste</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
 
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-sm navbar-light bg-light row justify-content-md-center">
                <div class="collapse navbar-collapse col-md-10 col-lg-6" id="navbarSupportedContent">
                    <a class="navbar-brand" href="/">Blog-teste</a>
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/post/admin">Gerenciar Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/categoria">Gerenciar Categorias</a>
                        </li>
                        @endif
                    </ul>
                    @if(Auth::check())
                    <a class="btn btn-outline-success my-2 my-lg-0" href="/logout">LOGOUT</a>
                    @else
                    <a class="btn btn-outline-success my-2 my-lg-0" href="/login">LOGIN</a>
                    @endif
                </div>
            </nav>
            <div class="row justify-content-md-center">
                <div class="col-md-10 col-lg-6">
                @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>

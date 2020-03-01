<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }


        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        #app {
            margin-top: 100px;
        }

    </style>
</head>
<body class="bg-light">
@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/') }}">Voltar</a>
        @else
            <a href="{{ url('/') }}">Voltar</a>
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
@endif

<div class="container" id="app">
    <div class="col-md-12">
        <div class="text-center">
            <img src="{{$post->urlImage}}" class="rounded" width="250">
        </div>
        <h1 class="text-center">{{$post->title}}</h1>
        <h5 class="text-center">
            Publicado em: <span class="text-info">{{$post->publicationDatePtBr}} </span>
            Autor: <span class="text-info">{{$post->user->name}}</span>
        </h5>
        <div class="overflow-auto w-100">
            {!! $post->content !!}
        </div>
    </div>
</div>
</body>
</html>

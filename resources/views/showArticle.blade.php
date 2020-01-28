@extends('layouts.app')
    @section('content')
        <div class="container">
                @foreach($article as $art)
                        <div class="jumbotron py-4">
                            <h1 class="display-4">{{$art->title}}</h1>
                            <p class="lead">Criado em {{$art->created_at}} Categoria: {{$art->categoryName}}</p>
                            <hr class="my-4">
                            <article>
                            <aside><img src="{{asset($art->image)}}" ></aside><main><p>{{$art->content}}</p></main>

                            <hr>
                            <p>Autor:{{$art->author}}</p>
                            </article>
                        </div>
                @endforeach
        </div>

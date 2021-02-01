@extends('layouts.blog')

@section('content')
<link rel="stylesheet" href="{{ url('css/app.css') }}">
<div id="app">
    <div class="container justify-content-end col-md-6 mt-4">
        <div class="d-flex">
            <ul class="nav">
                @if (Auth::check())
                <li class="nav-item"><a href="{{ route('cadastrarPost') }}" class="btn btn-link mr-2">Novo</a></li>
                @endif
                <li class="nav-item">

                    <form method="GET" action="{{ route('posts') }}" class="form-inline">
                        <input name="search" class="form-control mr-sm-2" type="text" placeholder="Pesquisar"
                            aria-label="Pesquisar">
                        <button class="btn btn-outline-secondary mb-2 mt-2" type="submit">Pesquisar</button>
                    </form>
                </li>
            </ul>
        </div>
        @if (!empty($retorno["criado"]))
        <div class="alert alert-success">
            {{ $retorno["criado"] }}
        </div>
        @endif
        @if (!empty($retorno["deletado"]))
        <div class="alert alert-danger">
            {{ $retorno["deletado"] }}
        </div>
        @endif
        @foreach ($posts as $post)

        <a class="link-card" href="{{ url('/posts/view/' . $post->id) }}" style="color: #424242; text-decoration: none;">
            <post-component>
                <template v-slot:title>{{ $post->title }}</template>
                <template v-slot:category>{{ $post->Category->name }}</template>
                <template v-slot:content>{{ substr($post->content, 0, 255) . "..." }}</template>
                <template v-slot:user>{{ "Por " . $post->User->name }}</template>
                <template v-slot:create>{{ date_format($post->created_at, 'd-m-Y') }}</template>
            </post-component>
        </a>
        @endforeach

        @if ($posts->lastPage() > 1)
        <nav class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </nav>
        @endif
    </div>
</div>
@endsection
@extends('layouts.sistema.painel')

@section('titulo_card')
Editar Post
@endsection

@section('content')

<card-component>

    <row-component extra_class="mb-3">
        <column-component sizes="12">
            <a href="{{ route('sistema.post.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Editar</a>
            <a href="{{ route('sistema.post.index')}}" class="btn btn-default float-right">Voltar</a>
        </column-component>
    </row-component>

    <form method="POST" action="{{ route('sistema.post.atualizar', ['id' => $post->id])}}" id="formSend"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('sistema.post.form')
    </form>

    <row-component extra_class="mt-3">
        <column-component sizes="12">
            <a href="{{ route('sistema.post.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Editar</a>
            <a href="{{ route('sistema.post.index')}}" class="btn btn-default float-right">Voltar</a>
        </column-component>
    </row-component>
</card-component>


@endsection
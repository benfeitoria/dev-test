@extends('layouts.sistema.painel')

@section('titulo_card')
Nova Post
@endsection

@section('content')

<card-component>
    @include('sistema.alert.alerts')
    <row-component extra_class="mb-3">
        <column-component sizes="12">
            <a href="{{ route('sistema.post.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Salvar</a>
            <a href="{{ route('sistema.post.index')}}" class="btn btn-default float-right">Voltar</a>
        </column-component>
    </row-component>

    <form method="POST" action="{{ route('sistema.post.salvar')}}" id="formSend" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @include('sistema.post.form')
    </form>

    <row-component extra_class="mt-3">
        <column-component sizes="12">

            <a href="{{ route('sistema.post.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Salvar</a>
            <a href="{{ route('sistema.post.index')}}" class="btn btn-default float-right">Voltar</a>
        </column-component>
    </row-component>
</card-component>


@endsection
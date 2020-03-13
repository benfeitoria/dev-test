@extends('layouts.sistema.painel')

@section('titulo_card')
Editar Usuário
@endsection

@section('content')

<card-component>    
    <row-component extra_class="mb-3">
        <column-component sizes="12">
                <a href="{{ route('sistema.user.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Editar</a>
                <a href="{{ route('sistema.user.index')}}" class="btn btn-default float-right">Voltar</a>
            </column-component>
        </row-component>
        <form method="POST" action="{{ route('sistema.user.atualizar', ['id' => $user->id])}}" id="formSend">
            @csrf
            @method('PUT')
            @include('sistema.user.form')
        </form>

        <row-component extra_class="mt-3">
            <column-component sizes="12">
                <a href="{{ route('sistema.user.novo')}}" class="btn btn-primary float-right" onclick="event.preventDefault();
                document.getElementById('formSend').submit();">Editar</a>
                <a href="{{ route('sistema.user.index')}}" class="btn btn-default float-right">Voltar</a>
            </column-component>
        </row-component>
</card-component>
@endsection
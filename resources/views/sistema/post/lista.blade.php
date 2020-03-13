@extends('layouts.sistema.painel')

@section('titulo_card')
Lista de Posts
@endsection

@section('content')

<card-component>
    <row-component extra_class="mb-3">
        <column-component sizes="12 col-sm-9 col-lg-9">
            <busca-simples 
                url-modulo="{{ route('sistema.post.index') }}"
                valor="{{ old('busca', isset($busca)? $busca : '' ) }}" 
                parametro-busca="nome">
            </busca-simples>
        </column-component>
        <column-component sizes="12 col-sm-3 col-lg-3">
            <a href="{{ route('sistema.post.novo')}}" class="btn btn-primary float-right">Cadastrar nova</a>
        </column-component>
    </row-component>

    @include('sistema.alert.alerts')

    <data-table 
        url-modulo="{{ route('sistema.post.index') }}" 
        :columns="['id', 'titulo']"
        :object_data="{{ json_encode($posts) }}" 
        :acao-exclusao="true" 
        :acao-edicao="true"
        url-edicao="{{ url('sistema/post/editar') }}" 
        url-exclusao="{{ url('sistema/post/excluir') }}"
        busca="{{ old('busca', isset($busca)? $busca : '' ) }}" 
        parametro-busca="nome">
    </data-table>
</card-component>

@endsection
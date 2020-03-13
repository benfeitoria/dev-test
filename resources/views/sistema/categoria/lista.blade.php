@extends('layouts.sistema.painel')

@section('titulo_card')
Lista de Categorias
@endsection

@section('content')

<card-component>
    <row-component extra_class="mb-3">
        <column-component sizes="9">
            <busca-simples 
                url-modulo="{{ route('sistema.categoria.index') }}"
                valor="{{ old('busca', isset($busca)? $busca : '' ) }}" 
                parametro-busca="nome">
            </busca-simples>
        </column-component>
        <column-component sizes="3">
            <a href="{{ route('sistema.categoria.novo')}}" class="btn btn-primary float-right">Cadastrar nova</a>
        </column-component>
    </row-component>

    @include('sistema.alert.alerts')

    <data-table 
        url-modulo="{{ route('sistema.categoria.index') }}" 
        :columns="['id', 'nome']"
        :object_data="{{ json_encode($categorias) }}" 
        :acao-exclusao="true" 
        :acao-edicao="true"
        url-edicao="{{ url('sistema/categoria/editar') }}" 
        url-exclusao="{{ url('sistema/categoria/excluir') }}"
        busca="{{ old('busca', isset($busca)? $busca : '' ) }}" 
        parametro-busca="nome">
    </data-table>
</card-component>

@endsection
@extends('layouts.app')

@section('content')
  <pagina tamanho="12">

    @if($errors->all()) 
      <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
          <li><strong>{{$value}}</strong></li>
        @endforeach
      </div>
    @endif

    <painel titulo="Lista de Autores">
      <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>


      <tabela-lista
      v-bind:titulos="['#','Nome','E-mail']"
      v-bind:itens="{{json_encode($listaModelo)}}"
      ordem="desc" ordemcol="1"
      criar="#criar" detalhe="/admin/autores/" editar="/admin/autores/"
      modal="sim"

      ></tabela-lista>
      <div align="center">
        {{$listaModelo}}
      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('autores.store')}}" method="post" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <select class="form-control" id="autor" name="autor">
          <option {{(old('autor') && old('autor') == 'N' ? 'selected' : '' )}} value="N">Não</option>
          <option {{(old('autor') && old('autor') == 'S' ? 'selected' : ''  )}} {{(!old('autor') ? 'selected' : ''  )}} value="S">Sim</option>
        </select>
      </div>

      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" v-bind:action="'/admin/autores/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="E-mail">
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <select class="form-control" id="autor" name="autor" v-model="$store.state.item.autor">
          <option value="N">Não</option>
          <option value="S">Sim</option>
        </select>
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" >
      </div>
    </formulario>
    <span slot="botoes">
      <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.name">
    <p>@{{$store.state.item.email}}</p>
  </modal>
@endsection

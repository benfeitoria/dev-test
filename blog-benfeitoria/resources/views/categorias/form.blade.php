@extends('layouts.blog')

@section('content')
<div class="container text-left col-md-4">
    <form role="form" method="post">
        @csrf
        
        @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">
                {{ $error }}
            </li>
            @endforeach
        </ul>
        @endif
        <div class="card">
            <div class="card-header">Cadastrar Categoria</div>
            <input name="id" type="hidden" value="{{ !empty($data) ? $data->id : '' }}">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="name">Nome</label>
                    <input name="name" type="text" class="form-control col-md-6" id="name" placeholder="Insira categoria"
                        value="{{ !empty($data) ? $data->name : "" }}">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/categorias') }}" class="btn btn-secondary mr-2">Cancelar</a>
                    <button id="save" type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
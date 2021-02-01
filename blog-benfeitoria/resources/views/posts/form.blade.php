@extends('layouts.blog')

@section('content')
<div class="container text-left col-md-6 mt-4">
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
        <input name="id" type="hidden" value="{{ !empty($data) ? $data->id : '' }}">
        <input name="user" type="hidden" value="{{ Auth::user()->id }}">
        <div class="card">
            <div class="card-header">Criar Postagem</div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="control-label" for="title">Título</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Digite o título"
                        value="{{ !empty($data) ? $data->title : "" }}">
                </div>
                <div class="form-group mb-3">
                    <label for="category" class="control-label">Categoria</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione a categoria</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ !empty($data) && $data->category_id == $categoria->id ? "selected" : "" }}>
                            {{ $categoria->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="control-label">Conteúdo</label>
                    <textarea class="form-control" name="content" id="content" cols="30"
                        rows="10">{{ !empty($data) ? $data->content : "" }}</textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('posts') }}" class="btn btn-secondary mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@extends('blog')

@section('content')
<div class="container text-left col-md-4">
    <form id="register" role="form" method="post">
        @csrf
        @if ($errors->any())
        <ul class="list-group">
            @foreach ($errors->all() as $error)
            <li class="list-group-item alert alert-danger">
                {{ $error }}
            </li>
            @endforeach
        </ul>
        @endif
        <input name="id" type="hidden" value="{{ !empty($data) ? $data->id : '' }}">
        <div class="card-body">
            <div class="form-group">
                <label class="control-label" for="name">Nome</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Digite seu Nome"
                    value="{{ !empty($data) ? $data->name : "" }}">
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Digite seu email"
                    value="{{ !empty($data) ? $data->email : "" }}">
            </div>
            @if (!empty($data))
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="switchPwd">
                    <label class="custom-control-label" for="switchPwd">Alterar senha?</label>
                </div>
            </div>
            @endif
            <div id="password" {{ !empty($data) ? "style=display:none;" : "" }}>
                <div class=" form-group">
                    <label class="control-label" for="password1">Senha</label>
                    <input name="password" type="password" class="form-control password" id="password1"
                        placeholder="Digite sua senha" value="">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ url('/blog') }}" class="btn btn-secondary mr-2">Cancelar</a>
                <button id="save" type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection
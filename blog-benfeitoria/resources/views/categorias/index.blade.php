@extends('layouts.blog')

@section('content')
<div class="container text-center col-md-6 mt-4">
    <div class="d-flex">
        <ul class="nav">
            <li class="nav-item"><a href="{{ route('cadastrarCategoria') }}" class="btn btn-link mr-2">Nova</a></li>
            <li class="nav-item">
                <form method="GET" action="{{ route('categorias') }}" class="form-inline">
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
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            {{-- <th></th> --}}
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->name }}</td>
                {{-- <td>
                    <form action="{{ route('deletarCategoria') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $categoria->id }}">
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">Excluir</button>
                        </div>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($categorias->lastPage() > 1)
    <nav class="d-flex justify-content-center mt-4">
        {{ $categorias->links() }}
    </nav>
    @endif
</div>
@endsection
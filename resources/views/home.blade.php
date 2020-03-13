@extends('layouts.sistema.painel')

@section('titulo_card')
    Dashboard
@endsection

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<card-component>
    Bem-Vindo {{ Auth::user()->name }}
</card-component>

@endsection
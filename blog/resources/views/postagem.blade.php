@extends('layouts.app')

@section('content')
<div id="postagens">
  <postagem-detalhe-component :id="{{ $id }}"></postagem-detalhe-component>
</div>
@endsection
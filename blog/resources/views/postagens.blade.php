@extends('layouts.app')

@section('content')
<div id="postagens">
  <postagens-component :categoria_id="{{ $categoriaId }}"></postagens-component>
</div>
@endsection
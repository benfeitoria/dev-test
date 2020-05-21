@extends('layouts.app')

@section('content')
<administrar-categorias-component></administrar-categorias-component>
<modal-nova-categoria v-if="showModal"></modal-nova-categoria>
@endsection

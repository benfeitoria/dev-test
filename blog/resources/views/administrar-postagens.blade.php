@extends('layouts.app')

@section('content')
<administrar-postagens-component :autor_id={{ $autorId }}></administrar-postagens-component>
<modal-nova-postagem v-if="showModal" :autor_id="{{ $autorId }}"></modal-nova-postagem>
@endsection

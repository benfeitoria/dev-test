@extends('layouts.app')

@section('content')
<administrar-postagens-component :autor_id={{ $autorId }}></administrar-postagens-component>
<modal-nova-postagem v-if="showModal"></modal-nova-postagem>
@endsection

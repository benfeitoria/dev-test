@extends('app')

@section('content')

    <h3 class="login-heading my-4 text-center">Editar Post</h3>
    <edit_post v-bind:data="{{ json_encode($data) }}"></edit_post>
    
@endsection
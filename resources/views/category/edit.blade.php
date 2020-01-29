@extends('app')

@section('content')

    <h3 class="login-heading my-4 text-center">Editar Post</h3>
    <edit_category v-bind:data="{{ json_encode($data) }}"></edit_category>
    
@endsection
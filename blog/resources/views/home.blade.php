@extends('layouts.app')

@section('content')
<administrar-postagens-component 
    :autor_id={{ $autorId }} 
    :usuario={{ $usuario }}
></administrar-postagens-component>
@endsection

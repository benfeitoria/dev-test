@extends('layouts.app')

@section('content')
<administrar-postagens-component :autor_id={{ $autorId }} ></administrar-postagens-component>
@endsection

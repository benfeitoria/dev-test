@extends('app')

@section('content')

    <view_post v-bind:data="{{ json_encode($data) }}"></view_post>
    
@endsection
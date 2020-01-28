@extends('layouts.app')
@section('content')
    <category-component v-bind:current-user='{!! Auth::user()->toJson() !!}'></category-component>
@endsection

@extends('layouts.app')
    @section('content')
        <article-component v-bind:current-user='{!! Auth::user()->toJson() !!}' update='{{$article}}'></article-component>
    @endsection

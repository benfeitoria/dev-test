@extends('layouts.frontend.site')

@section('content')
<div class="album py-5 bg-light" id="index">
    <div class="container">
        <post-view :id="'{!! $id !!}'"/>
    </div>
</div>

@endsection
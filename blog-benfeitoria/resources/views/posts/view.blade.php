@extends('layouts.blog')

@section('content')
<div class="container text-left col-md-8" style="margin-top: 100px">
    <div class="card mb-4">
        <div class="card-body text-left">
            <h2 class="card-title">{{ $post->title }}</h2>
            <h5>{{ date_format($post->created_at, 'd-m-Y') }} - {{ $post->Category->name }}</h5>
            <br>
            <?php echo $post->content; ?>
        </div>
        <div class="d-flex justify-content-center mb-1 ml-4 mr-4">
            <div class="form-group mt-4">
                <img src="{{ asset('images/users/' . $image) }}" class="border-primary rounded-circle mr-2" style="width: 80px;">
                <label class="contro-label">Por {{ $post->User->name }}</label>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-between mb-2">
        <a class="btn btn-secondary" href="{{ route('posts') }}">Voltar</a>
        @if (Auth::check() && Auth::user()->id === $post->user_id)
        <a class="btn btn-primary" href="{{ url('posts/cadastrar/' . $post->id) }}">Editar</a>
        @endif
    </div>
</div>
@endsection
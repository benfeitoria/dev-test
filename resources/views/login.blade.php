   
@extends('app')

@section('content')

<h3 class="login-heading mb-4 text-center">Login</h3>
<form action="{{url('api/login')}}" method="POST" id="logForm">

    {{ csrf_field() }}

    <div class="form-label-group">
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" >
        <label for="inputEmail">Email</label>

        @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
        @endif    
    </div> 

    <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
        <label for="inputPassword">Senha</label>
        
        @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
        @endif  
    </div>

    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Entrar</button>
    <div class="text-center">
        <a class="small" href="{{url('registration')}}">Cadastrar</a>
    </div>
</form>

@endsection
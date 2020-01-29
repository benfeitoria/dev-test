@extends('app')

@section('content')

<h3 class="login-heading mb-4 text-center">Cadastro</h3>
<form action="{{url('api/registration')}}" method="POST" id="regForm">
  {{ csrf_field() }}
  <div class="form-label-group">
    <input type="text" id="inputName" name="name" class="form-control" placeholder="Full name" autofocus>
    <label for="inputName">Nome</label>

    @if ($errors->has('name'))
    <span class="error">{{ $errors->first('name') }}</span>
    @endif       

  </div> 
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

  <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Cadastrar</button>
  <div class="text-center">
    <a class="small" href="{{url('login')}}">Login</a>
  </div>
</form>

@endsection
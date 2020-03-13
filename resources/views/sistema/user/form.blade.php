<div class="form-group">
    <label for="name">Nome*:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', isset($user->name)? $user->name : '' ) }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="email">E-mail*:</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" @if(isset($user->email)) readonly  @endif name="email" value="{{ old('email', isset($user->email)? $user->email : '' ) }}">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@if(!isset($user->id))
<div class="form-group">
    <label for="password">Senha*:</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Confirmar a Senha*:</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
</div>

@endif
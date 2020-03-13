<div class="form-group">
    <label for="nome">Nome*:</label>
    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', isset($categoria->nome)? $categoria->nome : '' ) }}">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
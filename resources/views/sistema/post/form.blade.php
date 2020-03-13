<div class="form-group">
    <label for="titulo">Título*:</label>
    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
        value="{{ old('titulo', isset($post->titulo)? $post->titulo : '' ) }}">
    @error('titulo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="data_publicacao">Data de Publicação*:</label>
    <input type="date" class="form-control @error('data_publicacao') is-invalid @enderror" id="data_publicacao"
        name="data_publicacao"
        value="{{ old('data_publicacao', isset($post->data_publicacao)? $post->data_publicacao : '' ) }}">
    @error('data_publicacao')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="img_destaque">Imagem destacada</label>
    {{-- <input type="file" class="form-control-file" id="img_destaque" name="img_destaque"> --}}

    @if(isset($post->img_destaque) && !empty($post->img_destaque))
        <!--<img src="{{ url('storage/posts/' . $post->img_destaque)}}" alt="" class="img-responsive img-thumbnail" width="100">

        <button type="button" class="btn btn-danger" >X</button> -->

        <image-preview
            :input-preview="'{{ url('storage/posts/' . $post->img_destaque)}}'"
            :name="'img_destaque'"
        ></image-preview>
    @else
        <image-preview
        :input-preview="null"
        :name="'img_destaque'"
    
        ></image-preview>
    @endif
</div>

<div class="form-group">
    <label for="users_id">Autor*:</label>
    <select class="form-control @error('users_id') is-invalid @enderror" name="users_id" id="users_id">
        @foreach ($users as $key => $user)
        <option value="{{ $user->id}}" @if(isset($post->users_id) && $post->users_id == $user->id)
            selected
            @else

            @endif>
            {{ $user->name}}</option>
        @endforeach
    </select>

    @error('users_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="categorias">Categorias</label>
    <select multiple class="form-control" id="categorias" name="categorias[]">
        @foreach ($categorias as $cat)
        <option value="{{ $cat->id}}" @if(isset($post->categorias_posts) &&
            !empty(array_filter($post->categorias_posts->toArray(), function($cat_post) use ($cat){
            return $cat_post['categorias_id'] == $cat->id;
            })))
            selected
            @else

            @endif
            >
            {{ $cat->nome }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="conteudo">Conteúdo*:</label>
    <textarea class="form-control @error('conteudo') is-invalid @enderror" name="conteudo" id="conteudo" cols="30"
        rows="10"> {{ old('conteudo', isset($post->conteudo)? $post->conteudo : '' ) }} </textarea>
    @error('conteudo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\Categoria_Post;
use App\Models\Categoria;
use App\Http\Requests\Sistema\PostRequest;
use App\User;

class PostCtrl extends Controller
{
    
    private $post;
    private $categoria_post;
    private $categoria;
    private $user;

    public function __construct(
        Post $post,
        Categoria_Post $cat_post,
        Categoria $cat,
        User $u
    )
    {
        $this->post = $post;
        $this->categoria_post = $cat_post;
        $this->categoria = $cat;
        $this->user = $u;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //dd($request->all());
        $busca = "";
        if(!empty($request->nome)){
            $busca = $request->nome;
            $p = $this->post
                    ->where('titulo', 'LIKE', "%{$request->nome}%")
                    ->orWhere('conteudo', 'LIKE', "%{$request->nome}%")
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
        }else{
            $p = $this->post->orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('sistema.post.lista', ['posts' => $p, 'busca' => $busca]);
    }

    
    public function create()
    {   
        $u = $this->user->all();
        $c = $this->categoria->all();
        //dd($u);
        return view('sistema.post.novo', ['users' => $u, 'categorias' => $c]);
    }

    
    public function store(PostRequest $request)
    {
        //dd($request->all());

        $data = $request->all();

        //upload da imagem
        if($request->hasFile('img_destaque') && $request->file('img_destaque')->isValid()){
            date_default_timezone_set("Brazil/East");
            $nome = date("Ymd-His-u");

            $extensao = $request->img_destaque->extension();

            $novo_nome = "{$nome}.{$extensao}";
            $data['img_destaque'] = $novo_nome;
            //dd($novo_nome);

            $upload = $request->img_destaque->storeAs('posts', $novo_nome);

            if(!$upload)
            return redirect()->route('sistema.post.index')->with('error','Erro ao fazer upload da imagem.');
        }


        $p = new $this->post($data);
        $p->save();

        if(isset($request->categorias) && count($request->categorias) > 0){
            foreach ($request->categorias as $key => $cat) {
                $cat_post = new $this->categoria_post();
                $cat_post->posts_id = $p->id;
                $cat_post->categorias_id = $cat;
                $cat_post->save();
            }
        }

        //upload da imagem

        return redirect()->route('sistema.post.index')->with('success','Post cadastrado com sucesso');
    }

    
    public function edit($id)
    {
        
        $p = $this->post->find($id);
        $u = $this->user->all();
        $c = $this->categoria->all();

        return view('sistema.post.editar', ['post' => $p, 'users' => $u, 'categorias' => $c]);
    }

    
    public function update(postRequest $request, $id)
    {

        //dd($request->all());
        $p = $this->post->find($id);
        $data = $request->all();
        //upload da imagem
        if($request->hasFile('img_destaque') && $request->file('img_destaque')->isValid()){

            if($p->img_destaque){
                if(Storage::exists("posts/{$p->img_destaque}"))
                    Storage::delete("posts/{$p->img_destaque}");
            }

            date_default_timezone_set("Brazil/East");
            $nome = date("Ymd-His-u");

            $extensao = $request->img_destaque->extension();

            $novo_nome = "{$nome}.{$extensao}";
            $data['img_destaque'] = $novo_nome;
            //dd($novo_nome);

            $upload = $request->img_destaque->storeAs('posts', $novo_nome);

            if(!$upload)
            return redirect()->route('sistema.post.index')->with('error','Erro ao fazer upload da imagem.');
        }


        
        $p->update($data);

        $registros_banco = [];
        $registros_view = [];

        if(isset($request->categorias) && count($request->categorias) > 0){
            foreach ($request->categorias as $cat) {
               array_push($registros_view, $cat);
            }
        }

        if(count($p->categorias_posts) > 0){
            foreach ($p->categorias_posts as $cat) {
               array_push($registros_banco, $cat->categorias_id);
            }
        }

        //dd($registros_banco);

        $adicionar = array_diff($registros_view, $registros_banco);
        $excluir = array_diff($registros_banco, $registros_view);

        //dd($adicionar);
        //excluir os que não vem da view
        if(count($excluir) > 0){
            foreach ($excluir as $cat) {
               $cat_post = $this->categoria_post->where([
                   ['posts_id', $p->id],
                   ['categorias_id', $cat],
               ])->first();

               $cat_post->delete();
            }
        }
        //adiciona os que vem da view
        if(count($adicionar) > 0){
            foreach ($adicionar as $key => $cat) {
                $cat_post = new $this->categoria_post();
                $cat_post->posts_id = $p->id;
                $cat_post->categorias_id = $cat;
                $cat_post->save();
            }
        }


        return redirect()->route('sistema.post.index')->with('success','Post editado com sucesso');
    }

    
    public function destroy($id)
    {
        //dd($id);
        $p = $this->post->find($id);
        //exclui a associação de todos os posts que tem essa post
            if($p->categorias_posts->count() > 0) {
                foreach ($p->categorias_posts as $cat_post) {
                    $c  = $this->post->find($cat_post->id);
                    $c->delete();
                }
            }

        $p->delete();

        return redirect()->route('sistema.post.index')->with('success','Post excluido com sucesso');
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Categoria_Post;
use App\Models\Categoria;
use App\User;

class SiteCtrl extends Controller
{
    private $post;
    private $categoria_post;
    private $categoria;
    private $user;

    public function __construct(
        Post $post,
        Categoria_Post $cat_post,
        Categoria $cat,
        User $user
    )
    {
        $this->post = $post;
        $this->categoria_post = $cat_post;
        $this->categoria = $cat;
        $this->user = $user;
    }

    public function index(Request $request){

        $posts = $this->post->getPosts($request);
        //dd($posts);
        return response()->json($posts, 200);
    }

    public function showPost($id){

        $p = $this->post->with(['autor', 'categorias'])->find($id);

        return response()->json($p);
    }

    public function getCategorias(){
        $categorias = $this->categoria->get();

        return response()->json($categorias, 200);
    }

    public function getAutores(){
        $autores = $this->user->get(['id', 'name', 'email']);

        return response()->json($autores, 200);
    }
}

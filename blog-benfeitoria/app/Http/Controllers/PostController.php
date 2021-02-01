<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        DB::connection()->enableQueryLog();

        $search = $request->get("search");   

        if (isset($search)) {
            $categories = DB::table('categories')->where('name', 'like', "%{$search}%")->get()->toArray();
            
            $categories = array_map(function($item) {return $item->id; }, $categories);

            $users = DB::table('users')->where('name', 'like', "%{$search}%")->get()->toArray();

            $users = array_map(function($item) {return $item->id; }, $users);

            $posts = Post::query()
                ->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('category_id', $categories)
                ->orWhere('user_id', $users)
                ->paginate(5);

            $posts->appends(["search" => $search]);
        } else {
            $posts = Post::paginate(5);
        }

        $posts->withPath("posts");

        $retorno["criado"] = $request->session()->get('success');

        $retorno["deletado"] = $request->session()->get('delete');

        return view('posts.index', compact('posts', 'retorno'));
    }

    public function register($id = null)
    {
        $data = array();
// CORRIGIR ESTA MERDA COM HERANÇA
        $categorias = DB::table('categories')->get();

        if ($id)
            $data = Post::find($id);
// dump($data); exit;
        return view('posts.form', compact('data', 'categorias'));
    }

    public function store(Request $request)
    {
        extract($request->all());

        $request->validate(['title' => 'required', 'category' => 'required', 'content' => 'required', 'user' => 'required']);

        $data = ['title' => $title, 'category_id' => $category, 'content' => $content, 'user_id' => $user];

        if ($id) {
            $post = Post::where('id', $id)->update($data);

            $request->session()->flash("success", "Post atualizado!");
        } else {
            $post = Post::create($data);

            $request->session()->flash("success", "Post {$post->title} cadastrado com sucesso!");
        }

        return redirect("/posts");
    }

    public function view($id)
    {
        $post = Post::find($id);

        $post->content = str_replace("\r\n", "<br>", $post->content);

        $images = scandir("../public/images/users");

        $image = "user_default.png";

        foreach ($images as $image) {
            $pathImage = '../public/images/users/' . $image;
            
            if (is_file($pathImage)) {
                if (explode(".", $image)[0] === "user_{$post->user_id}" ) {
                    $image = "user_{$post->user_id}.png";
                    break;
                }
            }
        }

        return view('posts.view', compact('post', 'image'));
    }
}

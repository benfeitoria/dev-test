<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function get()
    {
        $posts = Post::with('category','autor')->get()->map(function ($post) {
            $post->img = $post->img();
            return $post;
        });  
        return $posts;
    }
    
    public function getAutores()
    {
        return User::get();
    }

    public function filter(Request $request)
    {

        $posts   = Post::when(!empty($request->search['autor']) , function ($query) use($request){
            return $query->where('autor', $request->search['autor']);
        })
        ->when(!empty($request->search['texto']) , function ($query) use($request){
            return $query->where('titulo', 'like', "%".$request->search['texto']."%")
                         ->orWhere('conteudo', 'like', "%".$request->search['texto']."%");
        })
        ->when(!empty($request->search['categoria']) , function ($query) use($request){
            return $query->where('posts.id_category', $request->search['categoria']);
        })
        ->with('category','autor')
        ->orderBy('publicacao')
        ->get()
        ->map(function ($post) {
            $post->img = $post->img();
            return $post;
        });

        return $posts;
    }

    public function save(Request $request, $id = 0)
    {

        if($id){
            $posts = Post::find($id);
        }else{
            $posts = new Post;
        }
        
        $posts->autor       = $request->autor;
        $posts->titulo      = $request->titulo;
        $posts->conteudo    = $request->conteudo;
        $posts->id_category = $request->id_category;
        $posts->save();

        //GRAVA OS ANEXOS
        if($request->hasFile('files')){
            $anexos = $request->file('files');
            foreach ($anexos as $k=>$anexo) {
                $extension = $anexo->getClientOriginalExtension(); // you can also use file name
                $fileName = $posts->id.'.'.$extension;
                $path = public_path().'/images';
                $uplaod = $anexo->move($path,$fileName);
            }
        }

        return "true";
    }
  
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $posts->autor       = $request->autor;
        $posts->titulo      = $request->titulo;
        $posts->conteudo    = $request->conteudo;
        $posts->publicacao  = $request->publicacao;
        $post->save();
        return redirect()->route('/')->with('message', 'Product updated successfully!');
    }
  
    public function destroy(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $post->delete();

        $files = glob(public_path()."/images/".$request->id.".*");
        if(isset($files[0]) && File::exists($files[0])){
            File::delete($files[0]);
        }

        return 'true';
    }
}

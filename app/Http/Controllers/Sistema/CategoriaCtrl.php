<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Categoria_Post;
use App\Http\Requests\Sistema\CategoriaRequest;

class CategoriaCtrl extends Controller
{   
    private $categoria;
    private $categoria_post;

    public function __construct(
        Categoria $cat,
        Categoria_Post $cat_post
    )
    {
        $this->categoria = $cat;
        $this->categoria_post = $cat_post;
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        //dd($request->all());
        $busca = "";
        if(!empty($request->nome)){
            $busca = $request->nome;
            $p = $this->categoria
                    ->where('nome', 'LIKE', "%{$request->nome}%")
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
        }else{
            $p = $this->categoria->orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('sistema.categoria.lista', ['categorias' => $p, 'busca' => $busca]);
    }

    
    public function create()
    {
        return view('sistema.categoria.novo');
    }

    
    public function store(CategoriaRequest $request)
    {
        //dd($request->all());

        $p = new $this->categoria($request->all());
        $p->save();

        return redirect()->route('sistema.categoria.index')->with('success','Categoria cadastrada com sucesso');
    }

    
    public function edit($id)
    {
        
        $p = $this->categoria->find($id);

        return view('sistema.categoria.editar', ['categoria' => $p]);
    }

    
    public function update(CategoriaRequest $request, $id)
    {
        $p = $this->categoria->find($id);
        $p->update($request->all());

        return redirect()->route('sistema.categoria.index')->with('success','Categoria editada com sucesso');
    }

    
    public function destroy($id)
    {
        
        $p = $this->categoria->find($id);
        //exclui a associação de todos os posts que tem essa categoria
            if($p->categorias_posts->count() > 0) {
                foreach ($p->categorias_posts as $categoria_post) {
                    $c  = $this->categoria_post->find($cat_post->id);
                    $c->delete();
                }
            }

        $p->delete();

        return redirect()->route('sistema.categoria.index')->with('success','Categoria excluida com sucesso');
    }
}

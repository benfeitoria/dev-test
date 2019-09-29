<?php

 namespace App\Http\Controllers;

 use App\Models\Postagem;

 use Illuminate\Http\Request;
 use Storage;
 
 use Illuminate\Support\Str;


 class PostagemController extends Controller {

     private $postagem;

     public function __construct(Postagem $postagens)
     {
       $this->postagem = $postagens;

     }

     public function index()
     {
        
        return $this->postagem->with('categoria')->paginate(3);
     }

     public function store(Request $request)
     {
         try {
           
            $url=$this->salvaImagem($request->imagem);

             $this->postagem->create([
                'imagem'=>$url,
                'titulo'=> $request->titulo,
                'texto_postagem'=>$request->texto_postagem,
                'categoria_id'=> $request->categoria_id
             ]);
           
           
           return response()->json(['msg'=>'cadastrado']);
         
         } catch (\PDOException $e) {

            return response()->json(['msg'=>$e->getMessage()]);
         }
       
     }

   
     public function show($id)
     {
       
        return  $this->postagem->where('id',$id)->with('categoria')->first();
     }

    
    public function update(Request $request, $id)
    {
       try {

         $post = $this->postagem->findOrFail($id);
         $post->update($resquest->all());

         return response()->json(['msg'=>'Atualizado com sucesso'],201);

       } catch (\PDOException $e) {

           return response()->json(['msg'=>$e->getMessage()]);
       }
      
    }

    
    public function delete($id)
    {
         $postagens = $this->postagem->findOrFail($id);
         $postagens->destroy();
    }


    public function salvaImagem($img)
    {
         $data = substr($img, strpos($img, ',') + 1);
         $data = base64_decode($data);
         $imageName = Str::random(10).'.'.'png';
         Storage::disk('imagens')->put($imageName, $data);
         $url= 'http://'.$_SERVER['HTTP_HOST']."/image/$imageName";
       return $url;
    }
 }
 
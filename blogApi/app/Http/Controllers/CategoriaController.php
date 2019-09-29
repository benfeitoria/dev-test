<?php
   

 namespace App\Http\Controllers;
 
 use App\Models\Categoria;
 
 use Illuminate\Http\Request;

 class CategoriaController extends Controller 
 {
     private $categoria;

     /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct(Categoria $categorias)
     {
         $this->categoria = $categorias;

     }

     public function index()
     { try {
        $categorias = $this->categoria->select('titulo','id')->get();
       

        return response()->json($categorias, 200);

     }catch (\PDOException $e) {

        return response()->json(['msg'=>$e->getMessage()]);
     }
         
     }

     public function Show($id)
     {
        
         return $this->categoria->findOrFail($id);
     }
 }
 
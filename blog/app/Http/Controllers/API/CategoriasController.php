<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Categoria as CategoriaRepository;

class CategoriasController extends Controller
{
    private $categoriaRepository;
    
    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function index()
    {
        $categorias = null;

        try {
            $categorias = $this->categoriaRepository->getAll();
        } catch(Exception $e) {
            return response(json_encode($e->getMessage()), 500);
        }


        if ( empty($categorias) || $categorias->isEmpty()) {
            return response(json_encode((object) ['msg'=> "Não há categorias cadastradas"]), 404);
        }

        return response()->json($categorias);
    }
}

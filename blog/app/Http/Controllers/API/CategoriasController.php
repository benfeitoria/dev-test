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
        $categorias = $this->categoriaRepository->getAll();

        return json_encode($categorias);
    }
}

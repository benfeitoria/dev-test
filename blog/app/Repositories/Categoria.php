<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Model\Categoria as CategoriaModel;

class Categoria
{
    public function getAll()
    {
        $categorias = DB::table('categorias')
                        ->select('id', 'descricao')
                        ->get();

        return $categorias;
    }

    public function delete(int $id)
    {
      return $categoria = DB::table('categorias')
                              ->where('id', '=', $id)
                              ->delete();
    }

    public function create(string $descricao)
    {
      $categoria = new CategoriaModel();
      $categoria->descricao = $descricao;
      $categoria->save();

      return $categoria;
    }
}

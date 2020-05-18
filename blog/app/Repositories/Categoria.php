<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Model\Categoria as CategoriaModel;
use App\Exceptions\NotAllowedException;

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
      if ($this->hasPostagem($id)) {
        throw new NotAllowedException("Há postagens vinculadas a esta categoria, exclua-as primeiro");
      }

      $res = $categoria = DB::table('categorias')
                              ->where('id', '=', $id)
                              ->delete();

      return $res;
    }

    public function create(string $descricao)
    {
      $categoria = new CategoriaModel();
      $categoria->descricao = $descricao;
      $categoria->save();

      return $categoria;
    }

    private function hasPostagem(int $id)
    {
      $categoria = DB::table('postagens')
                        ->where('categoria_id', '=', $id)
                        ->get();

      return (empty($categoria) || $categoria->isEmpty()) ? false : true;
    }
}

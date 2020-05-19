<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Model\Postagem as PostagemModel;

class Postagem
{
    private $categoriaId;
    private $autorId;

    public function categoriaId($value = null)
    {
      if (!empty($value)) {
        $this->categoriaId = $value;
        return $this;
      }
      
      return $this->categoriaId;
    }

    public function autorId($value = null)
    {
      if (!empty($value)) {
        $this->autorId = $value;
        return $this;
      }

      return $this->autorId;
    }

    public function getAll()
    {
        $postagens = DB::table('postagens')
                          ->join('users', 'users.id', '=', 'postagens.autor_id')
                          ->join('categorias', 'categorias.id', '=', 'postagens.categoria_id');

        if (!empty($this->categoriaId)) {
          $postagens = $postagens->where('postagens.categoria_id', '=', $this->categoriaId);
        }

        if (!empty($this->autorId)) {
          $postagens = $postagens->where('postagens.autor_id', '=', $this->autorId);
        }

        $postagens = $postagens->select(
                                  'postagens.id',
                                  'postagens.imagem',
                                  'postagens.titulo',
                                  'postagens.texto',
                                  'postagens.created_at',
                                  'postagens.updated_at',
                                  'users.id as autor_id',
                                  'users.name as autor_name',
                                  'categorias.id as categoria_id',
                                  'categorias.descricao as categoria_descricao'
                                )
                                ->get();

        return $postagens;
    }

    public function get(int $id)
    {
        $postagens = DB::table('postagens')
                          ->join('users', 'users.id', '=', 'postagens.autor_id')
                          ->join('categorias', 'categorias.id', '=', 'postagens.categoria_id')
                          ->where('postagens.id', '=', $id)
                          ->select(
                            'postagens.id',
                            'postagens.imagem',
                            'postagens.titulo',
                            'postagens.texto',
                            'postagens.created_at',
                            'postagens.updated_at',
                            'users.id as autor_id',
                            'users.name as autor_name',
                            'categorias.id as categoria_id',
                            'categorias.descricao as categoria_descricao'
                          )
                          ->get();

        return $postagens;
    }

    public function delete(int $id)
    {
      return $postagens = DB::table('postagens')
                              ->where('id', '=', $id)
                              ->delete();
    }

    public function create(
      string $imagem,
      string $titulo,
      string $texto,
      int $autor_id,
      int $categoria_id
    ) {

      $created_at = date('Y-m-d H:i:s');

      $postagem = new PostagemModel();
      $postagem->imagem     = $imagem;
      $postagem->titulo     = $titulo;
      $postagem->texto      = $texto;
      $postagem->created_at = $created_at;
      $postagem->autor_id     = $autor_id;
      $postagem->categoria_id = $categoria_id;
      $postagem->save();

      return $postagem;
    }
}

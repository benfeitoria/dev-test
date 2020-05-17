<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class Categoria
{
    public function getAll()
    {
        $categorias = DB::table('categorias')
                        ->select('id', 'descricao')
                        ->get();

        return $categorias;
    }
}

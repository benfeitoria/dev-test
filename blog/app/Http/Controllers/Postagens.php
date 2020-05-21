<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Postagens extends Controller
{
    public function index(Request $request)
    {
        $categoriaId = $request->input('categoria', 'null');

        return view('postagens', [ 'categoriaId' => $categoriaId ]);
    }

    public function get(Request $request)
    {
        $id = $request->id;

        return view('postagem', [ 'id' => $id ]);
    }
}

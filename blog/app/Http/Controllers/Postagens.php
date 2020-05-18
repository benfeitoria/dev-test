<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Postagens extends Controller
{
    public function get(Request $request)
    {
        $categoriaId = $request->input('categoria', 'null');

        return view('postagens', [ 'categoriaId' => $categoriaId ]);
    }
}

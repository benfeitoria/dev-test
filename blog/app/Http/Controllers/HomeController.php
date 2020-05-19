<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $autorId = Auth::id();

        return view('administrar-postagens', [ 
            'autorId' => $autorId
        ]);
    }

    public function categorias()
    {
        return view('administrar-categorias');
    }
}

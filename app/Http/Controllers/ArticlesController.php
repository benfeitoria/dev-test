<?php

namespace App\Http\Controllers;

use App\Http\Models\Articles;
use App\Http\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addArticle($id = null){
        $article = json_encode(['']);
        if(!empty($id)){
            $article = Articles::findOrFail($id);
        }
        return view('addArticle')->with(compact('article'));
    }



}

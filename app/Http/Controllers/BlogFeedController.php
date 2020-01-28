<?php

namespace App\Http\Controllers;

use App\Http\Models\Articles;
use Illuminate\Http\Request;

class BlogFeedController extends Controller
{
    //
    public function index(){
        $articles = Articles::all();
        return view('blogFeed')->with(compact('articles'));
    }

    public function viewArticle($id){
        $articles = new Articles();
        $article = $articles->fullArticle($id);
        return view('showArticle')->with(compact('article'));
    }
}

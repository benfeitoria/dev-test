<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = "articles";
    protected $fillable = [
        'id',
        'image',
        'title',
        'content',
        'categorie_id',
        'author',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->hasOne('App\Http\Models\Categories','categorie_id');
    }

    public function allArticles($request){
        return Articles::join('categories','articles.categorie_id','=','categories.id')
            ->join('users','users.id','=','articles.author')
            ->select('categories.*','categories.name as categoryName','articles.*','articles.id as articlesId','users.name as author')
            ->where('title','like','%'.$request->search.'%')
            ->orWhere('users.name','like','%'.$request->search.'%')
            ->orWhere('categories.name','like','%'.$request->search.'%')
            ->paginate(8);
    }

    public function fullArticle($id){
        return Articles::join('categories','articles.categorie_id','=','categories.id')
            ->join('users','users.id','=','articles.author')
            ->select('categories.*','categories.name as categoryName','articles.*','articles.id as articlesId','users.name as author')
            ->Where('articles.id','=',$id)
            ->get();
    }
    public function articleImage($request){
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $timestampName = microtime(true) . '.' . $extension;
        $request->image->move(public_path().'/images/', $timestampName);

        return 'images/'.$timestampName;
    }


}

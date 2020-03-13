<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categoria_Post;
use App\Models\Categoria;
use App\User;

class Post extends Model
{
    protected $table = 'posts';
	public $timestamps = true;
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $fillable =[
        'img_destaque',
        'titulo',
        'conteudo',
        'data_publicacao',
        'users_id',
    ];
    
    public function categorias_posts(){
		  return $this->HasMany(Categoria_Post::class, 'posts_id', 'id');
    }

    public function autor(){
		  return $this->HasOne(User::class, 'id', 'users_id',);
    }
    
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categorias_posts', 'posts_id', 'categorias_id')->whereNull('categorias_posts.deleted_at');
    }


    public function getPosts($request){

        if(!empty($request->categorias_id) && empty($request->autor_id)){

          $posts = $this->with(['autor', 'categorias'])
                          ->whereHas('categorias', function($query) use ($request){
                            $query->where('categorias.id', '=', $request->categorias_id);
                          })
                          ->orderBy('data_publicacao', 'DESC')
                          ->paginate(6);

      }if(!empty($request->autor_id) && empty($request->categorias_id)){
        
          $posts = $this->with(['autor', 'categorias'])
                          ->whereHas('autor', function($query) use ($request){
                              $query->where('users.id', '=', $request->autor_id);
                          })
                          ->orderBy('data_publicacao', 'DESC')
                          ->paginate(6);
      }else if(!empty($request->autor_id) && !empty($request->categorias_id)){
        
        $posts = $this->with(['autor', 'categorias'])
                      ->whereHas('autor', function($query) use ($request){
                          $query->where('users.id', '=', $request->autor_id);
                      })
                      ->whereHas('categorias', function($query) use ($request){
                        $query->where('categorias.id', '=', $request->categorias_id);
                      })
                      ->orderBy('data_publicacao', 'DESC')
                      ->paginate(6);
      }else if(empty($request->autor_id) && empty($request->categorias_id)){
        //dd('AQUI');
        $posts = $this->with(['autor', 'categorias'])->orderBy('data_publicacao', 'DESC')->paginate(6);
      }

      return $posts;
    }
}

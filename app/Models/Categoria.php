<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Categoria_Post;
class Categoria extends Model
{
    protected $table = 'categorias';
	public $timestamps = true;
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $fillable =[
		'nome',
	];

	public function categorias_posts(){
		return $this->HasMany(Categoria_Post::class, 'categorias_id', 'id');
	}
}

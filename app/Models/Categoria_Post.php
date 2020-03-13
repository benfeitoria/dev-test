<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categoria;

class Categoria_Post extends Model
{
    protected $table = 'categorias_posts';
	public $timestamps = true;
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $fillable =[
        'pots_id',
        'categorias_id'
	];

	public function categoria(){
		return $this->HasOne(Categoria::class, 'categorias_id', 'id');
    }
}

<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Postagem extends Model 
{
    protected $table="postagens";

    protected $fillable =[
        'titulo','categoria_id','imagem','texto_postagem'  
    ];

    public function categoria(){
            
        return $this->belongsTo(Categoria::class);
    }

}



<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'postagens';

    /**
     * Get the categoria that owns the postagem.
     */
    public function categoria()
    {
        return $this->belongsTo('App\Model\Categoria');
    }


    /**
     * Get the autor that owns the postagem.
     */
    public function autor()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $fillable = [
        'id',
        'name',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function article(){
        return $this->belongsTo('App\Http\Models\Articles','created_by');
    }
}

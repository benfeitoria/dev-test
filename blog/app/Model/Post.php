<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with = ['categories','user'];
    protected $appends = ['urlImage','publicationDatePtBr'];
    public function categories(){
        return $this->belongsTo(\App\Model\PostCategories::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }

    public function getUrlImageAttribute()
    {
        return url("storage/{$this->image}");
    }

    public function getPublicationDatePtBRAttribute()
    {
        $date =  new \DateTime($this->publication_date);
       return $date->format('d/m/Y H:i:s');
    }
}

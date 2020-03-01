<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $with = ['categories'];
    protected $appends = ['urlImage','publicationDatePtBr'];
    public function categories(){
        return $this->belongsTo(\App\Model\PostCategories::class,'category_id');
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

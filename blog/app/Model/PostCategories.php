<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    public function posts(){
        return $this->hasMany(\App\Model\Post::class,'category_id');
    }
}

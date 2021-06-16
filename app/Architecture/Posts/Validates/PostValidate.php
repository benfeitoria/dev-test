<?php

namespace App\Architecture\Posts\Validates;

use App\Architecture\Validate;

class PostValidate extends Validate
{
    protected $rules = [
        'image_path' => 'required|bail|mimetypes:image/png,image/jpg,image/jpeg|max:2000',
        'title' => 'required|string',
        'content' => 'required|string',
        'category_id' => 'required|number|regex:/^[0-9]+$/i',
        'slug' => 'required|string'
    ];
}

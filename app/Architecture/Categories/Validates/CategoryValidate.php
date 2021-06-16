<?php

namespace App\Architecture\Categories\Validates;

use App\Architecture\Validate;

class CategoryValidate extends Validate
{
    protected $rules = [
        'name' => 'required|string',
    ];
}

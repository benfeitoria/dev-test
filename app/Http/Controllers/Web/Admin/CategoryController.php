<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends BaseController
{
    /**
     * @return Response
     */
    public function index() : Response
    {
        $categories = $this->ICategoryService->listCategories();
        return Inertia::render('Categories', compact('categories'));
    }
}

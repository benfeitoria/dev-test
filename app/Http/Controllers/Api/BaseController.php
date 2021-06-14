<?php

namespace App\Http\Controllers\Api;

use App\Architecture\Categories\Interfaces\ICategoryService;
use App\Architecture\Posts\Interfaces\IPostService;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @var IPostService
     * @var ICategoryService
     */
    protected $IPostService;
    protected $ICategoryService;

    /**
     * BaseController constructor.
     * @param IPostService $IPostService
     * @param ICategoryService $ICategoryService
     */
    public function __construct(IPostService $IPostService, ICategoryService $ICategoryService)
    {
        $this->IPostService = $IPostService;
        $this->ICategoryService = $ICategoryService;
    }
}

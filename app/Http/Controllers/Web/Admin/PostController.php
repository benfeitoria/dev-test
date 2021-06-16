<?php

namespace App\Http\Controllers\Web\Admin;

use App\Architecture\Posts\Models\Post;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends BaseController
{
    /**
     * @return Response
     */
    public function index() : Response
    {
        $posts = $this->IPostService->listPosts();

        return Inertia::render('Welcome', compact('posts'));
    }

    /**
     * @return Response
     */
    public function create() : Response
    {
        return Inertia::render('Create');
    }

    /**
     * @param Post $post
     * @return Response
     */
    public function show(Post $post) : Response
    {
        return Inertia::render('Show', compact('post'));
    }
}

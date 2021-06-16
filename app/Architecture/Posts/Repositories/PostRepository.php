<?php

namespace App\Architecture\Posts\Repositories;

use App\Architecture\Posts\Interfaces\IPostRepository;
use App\Architecture\Posts\Models\Post;
use App\Exceptions\SystemException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class PostRepository implements IPostRepository
{
    /**
     * @param string $param
     * @return Collection
     */
    public function searchPost(string $param) : Collection
    {
        return Post::with(['author','category'])
            ->where('title', 'like', '%'.$param.'%')
            ->where(function ($query) use ($param) {
                $query->orWhere('author.name', 'like', '%'.$param.'%')
                    ->orWhere('category.name', 'like', '%'.$param.'%');
            })->get();
    }

    /**
     * @return Collection
     */
    public function listPosts(): Collection
    {
        return Post::whereNull('deleted_at')
                ->with(['category','author'])
                ->orderBy('created_at', 'desc')
                ->get();
    }

    /**
     * @param stdClass $params
     * @return Post
     * @throws SystemException
     */
    public function store(stdClass $params): Post
    {
        $post = new Post();
        $post->image_path = $params->image_path;
        $post->title = $params->title;
        $post->content = $params->content;
        $post->slug = $params->slug;
        $post->category_id = $params->category_id;
        $post->user_id = Auth::user()->id;

        if (!$post->save()) {
            throw new SystemException('Erro ao inserir o post.', 400);
        }

        return $post;
    }

    /**
     * @param Post $post
     * @param stdClass $params
     * @return Post
     */
    public function update(Post $post, stdClass $params): Post
    {
        $post->image_path = $params->image_path;
        $post->title = $params->title;
        $post->content = $params->content;
        $post->slug = $params->slug;
        $post->category_id = $params->category_id;
        $post->user_id = Auth::user()->id;

        $post->save();

        $post->refresh();

        return $post;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function delete(Post $post): bool
    {
        return $post->forceDelete();
    }
}

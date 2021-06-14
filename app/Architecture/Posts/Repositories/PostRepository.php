<?php

namespace App\Architecture\Posts\Repositories;

use App\Architecture\Posts\Interfaces\IPostRepository;
use App\Architecture\Posts\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class PostRepository implements IPostRepository
{
    public function listPosts(): Collection
    {
        // TODO: Implement listPosts() method.
    }

    public function store(stdClass $params): Post
    {
        // TODO: Implement store() method.
    }

    public function update(Post $post, stdClass $params): Post
    {
        // TODO: Implement update() method.
    }

    public function delete(Post $post): ?Post
    {
        // TODO: Implement delete() method.
    }

    public function desactive(Post $post): ?Post
    {
        // TODO: Implement desactive() method.
    }

    public function active(Post $post): ?Post
    {
        // TODO: Implement active() method.
    }
}

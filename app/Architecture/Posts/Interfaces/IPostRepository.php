<?php

namespace App\Architecture\Posts\Interfaces;

use App\Architecture\Posts\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

interface IPostRepository
{
    /**
     * @return Collection
     */
    public function listPosts() : Collection;

    /**
     * @param stdClass $params
     * @return Post
     */
    public function store(stdClass $params) : Post;

    /**
     * @param Post $post
     * @param stdClass $params
     * @return Post
     */
    public function update(Post $post, stdClass $params) : Post;

    /**
     * @param Post $post
     * @return Post|null
     */
    public function delete(Post $post) : ?Post;

    /**
     * @param Post $post
     * @return Post|null
     */
    public function desactive(Post $post) : ?Post;

    /**
     * @param Post $post
     * @return Post|null
     */
    public function active(Post $post) : ?Post;
}

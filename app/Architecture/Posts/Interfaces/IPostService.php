<?php

namespace App\Architecture\Posts\Interfaces;

use App\Architecture\Posts\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

interface IPostService
{
    /**
     * @param string $param
     * @return Collection
     */
    public function searchPost(string $param) :Collection;

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
     * @return bool
     */
    public function delete(Post $post) : bool;
}

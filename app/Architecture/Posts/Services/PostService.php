<?php

namespace App\Architecture\Posts\Services;

use App\Architecture\Posts\Interfaces\IPostRepository;
use App\Architecture\Posts\Interfaces\IPostService;
use App\Architecture\Posts\Models\Post;
use App\Architecture\Posts\Validates\PostValidate;
use App\Exceptions\SystemException;
use Illuminate\Database\Eloquent\Collection;
use stdClass;
use Throwable;

class PostService implements IPostService
{
    /**
     * @var IPostRepository
     * @var PostValidate
     */
    protected $IPostRepository;
    protected $PostValidate;

    /**
     * PostService constructor.
     * @param IPostRepository $IPostRepository
     */
    public function __construct(IPostRepository $IPostRepository)
    {
        $this->IPostRepository = $IPostRepository;
    }

    /**
     * @param string $param
     * @return Collection
     */
    public function searchPost(string $param) : Collection
    {
        return $this->IPostRepository->searchPost($param);
    }

    /**
     * @return Collection
     */
    public function listPosts(): Collection
    {
        return $this->IPostRepository->listPosts();
    }

    /**
     * @param stdClass $params
     * @return Post
     * @throws Throwable
     */
    public function store(stdClass $params): Post
    {
        $this->getPostValidate()->validaParametros($params);
        return $this->IPostRepository->store($params);
    }

    /**
     * @param Post $post
     * @param stdClass $params
     * @return Post
     * @throws Throwable
     */
    public function update(Post $post, stdClass $params): Post
    {
        $this->getPostValidate()->validaParametros($params);
        return $this->IPostRepository->update($post, $params);
    }

    /**
     * @param Post $post
     * @return bool
     * @throws SystemException
     */
    public function delete(Post $post): bool
    {
        $this->getPostValidate()->validateInt($post->id);
        return $this->IPostRepository->delete($post);
    }

    /**
     * @return PostValidate
     */
    private function getPostValidate() : PostValidate
    {
        return $this->PostValidate;
    }
}

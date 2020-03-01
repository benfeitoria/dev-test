<?php

namespace App\Policies;

use App\Model\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create posts.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param \App\User $user
     * @param \App\Model\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('Não possui permissão para atualizar este post.');
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param \App\User $user
     * @param \App\Model\Post $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('Não possui permissão para deletar este post.');
    }

    public function publictionOrRemove(User $user, Post $post)
    {
        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('Não possui permissão para publicar ou remover esta publicação.');
    }

}

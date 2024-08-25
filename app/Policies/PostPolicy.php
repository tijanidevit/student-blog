<?php

namespace App\Policies;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): Response
    {
        return ($user->id === $post->user_id || $post->status == PostStatusEnum::APPROVED->value) ? Response::allow()
        : Response::deny('You do not own this post and post not yet approved.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow()
        : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow()
        : Response::deny('You do not own this post.');
    }

    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}

<?php

namespace App\Policies;

use App\Enums\PrivacyStatus;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can see the post.
     *
     * Public posts are visible to everyone, including guests. Any other post is
     * only visible to its owner and the owner's friends.
     */
    public function view(?User $user, Post $post): bool
    {
        if ($post->privacy_status === PrivacyStatus::Public) {
            return true;
        }

        if ($user === null) {
            return false;
        }

        return $user->id === $post->user_id || $user->isFriendWith($post->user);
    }

    /**
     * Determine whether the user can like or unlike the post.
     *
     * Any signed-in user who can see the post can like it.
     */
    public function like(User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    /**
     * Determine whether the user can comment on the post or reply to its comments.
     *
     * Any signed-in user who can see the post can comment on it.
     */
    public function comment(User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    /**
     * Determine whether the user can share the post to their own profile.
     *
     * Only original public posts can be shared, so a share never exposes a post
     * to people its author did not intend. Shares point at the original post,
     * never at another share.
     */
    public function share(User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }
}
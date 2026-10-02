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
}

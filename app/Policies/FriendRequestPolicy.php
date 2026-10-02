<?php

namespace App\Policies;

use App\Enums\FriendRequestAudience;
use App\Models\User;

class FriendRequestPolicy
{
    /**
     * Determine whether the user can send a friend request to the target user.
     */
    public function create(User $user, User $target): bool
    {
        if ($user->id === $target->id || $user->isFriendWith($target) || $user->isRequestReceivedFrom($target) || $user->isRequestSentTo($target)) {
            return false;
        }

        if ($target->friend_request_audience === FriendRequestAudience::FriendsOfFriends) {
            return $user->hasMutual($target);
        }

        return true;
    }
}

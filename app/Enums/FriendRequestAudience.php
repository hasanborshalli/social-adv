<?php

namespace App\Enums;

enum FriendRequestAudience: string
{
    case Everyone = 'everyone';
    case FriendsOfFriends = 'friends_of_friends';
}

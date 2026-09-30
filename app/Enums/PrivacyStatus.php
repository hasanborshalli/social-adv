<?php

namespace App\Enums;

enum PrivacyStatus: string
{
    case Public = 'public';
    case Friends = 'friends';
    case Private = 'private';
}

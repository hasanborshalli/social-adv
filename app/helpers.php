<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('logout_user')) {
    /**
     * Log out the current user and reset their session and CSRF token.
     */
    function logout_user(): void
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}

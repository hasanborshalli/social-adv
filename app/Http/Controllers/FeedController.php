<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FeedController extends Controller
{
    /**
     * Show the posts the current visitor is allowed to see, newest first.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->with(['user', 'sharedPost.user'])
            ->withCount(['likes', 'shares'])
            ->latest()
            ->get()
            ->filter(fn (Post $post): bool => Gate::allows('view', $post))
            ->values();

        return view('feed', ['posts' => $posts]);
    }
}

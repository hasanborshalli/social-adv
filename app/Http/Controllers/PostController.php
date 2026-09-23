<?php

namespace App\Http\Controllers;

use App\Enums\PrivacyStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['nullable', 'string', 'max:5000', 'required_without:media'],
            'media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp,mp4,mov,webm', 'max:51200', 'required_without:body'],
            'privacy_status' => ['required', Rule::enum(PrivacyStatus::class)],
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaType = str_starts_with($file->getMimeType(), 'video/') ? 'video' : 'image';
            $mediaPath = $file->store("posts/{$mediaType}s", 'local');
        }

        $request->user()->posts()->create([
            'body' => $validated['body'] ?? null,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'privacy_status' => $validated['privacy_status'],
        ]);

        return back();
    }
}

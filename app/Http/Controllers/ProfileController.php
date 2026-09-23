<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updatePicture(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:5120'],
        ]);

        $user = $request->user();
        $oldProfilePic = $user->profile_pic;

        $path = $request->file('avatar')->store('profile-pictures', 'public');

        $user->update(['profile_pic' => $path]);

        if ($oldProfilePic) {
            Storage::disk('public')->delete($oldProfilePic);
        }

        return back();
    }

    public function updateCoverPhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'cover' => ['required', 'image', 'max:5120'],
        ]);

        $user = $request->user();
        $oldCoverPhoto = $user->cover_photo;

        $path = $request->file('cover')->store('cover-photos', 'public');

        $user->update(['cover_photo' => $path]);

        if ($oldCoverPhoto) {
            Storage::disk('public')->delete($oldCoverPhoto);
        }

        return back();
    }
}

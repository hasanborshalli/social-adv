<?php

use App\Enums\FriendRequestAudience;
use App\Enums\PrivacyStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public string $privacy_status = '';
    public string $friend_request_audience = '';
    public bool $privacySaved = false;

    public function mount(): void
    {
        $user = Auth::user();

        $this->privacy_status = $user->privacy_status === PrivacyStatus::Public
            ? PrivacyStatus::Public->value
            : PrivacyStatus::Friends->value;
        $this->friend_request_audience = $user->friend_request_audience?->value ?? FriendRequestAudience::Everyone->value;
    }

    public function save(): void
    {
        $this->privacySaved = false;

        $validated = $this->validate([
            'privacy_status' => ['required', Rule::enum(PrivacyStatus::class)->only([PrivacyStatus::Public, PrivacyStatus::Friends])],
            'friend_request_audience' => ['required', Rule::enum(FriendRequestAudience::class)],
        ]);

        Auth::user()->update($validated);

        $this->privacySaved = true;
    }
};
?>

<form class="card" wire:submit="save" novalidate>
    <div class="card-body">
        <h2 class="h5 mb-1">Privacy</h2>
        <p class="text-secondary small mb-4">Decide who can find you and see what you share.</p>

        <div class="setting-row pt-0">
            <div class="setting-row__text">
                <label class="fw-semibold mb-0" for="privPosts">Who can see your future posts</label>
                <p class="text-secondary small mb-0">This becomes the default audience in the post composer.</p>
            </div>
            <div class="setting-row__control">
                <select class="form-select w-auto @error('privacy_status') is-invalid @enderror" id="privPosts"
                    wire:model="privacy_status">
                    <option value="{{ \App\Enums\PrivacyStatus::Public->value }}">Public</option>
                    <option value="{{ \App\Enums\PrivacyStatus::Friends->value }}">Friends</option>
                </select>
                @error('privacy_status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="setting-row">
            <div class="setting-row__text">
                <label class="fw-semibold mb-0" for="privRequests">Who can send you friend requests</label>
                <p class="text-secondary small mb-0">Limits who sees the Add friend button on your profile.</p>
            </div>
            <div class="setting-row__control">
                <select class="form-select w-auto @error('friend_request_audience') is-invalid @enderror"
                    id="privRequests" wire:model="friend_request_audience">
                    <option value="{{ \App\Enums\FriendRequestAudience::Everyone->value }}">Everyone</option>
                    <option value="{{ \App\Enums\FriendRequestAudience::FriendsOfFriends->value }}">Friends of friends</option>
                </select>
                @error('friend_request_audience')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="card-footer bg-transparent d-flex justify-content-end align-items-center gap-2 py-3">
        @if ($privacySaved)
        <span class="text-success small me-auto" role="status">Privacy settings saved.</span>
        @endif
        <button class="btn btn-primary px-4" type="submit" wire:loading.attr="disabled" wire:target="save">Save
            changes</button>
    </div>
</form>

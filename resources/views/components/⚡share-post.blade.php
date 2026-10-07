<?php

use App\Enums\PrivacyStatus;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    /**
     * The original post being shared.
     */
    #[Locked]
    public Post $post;

    /**
     * The dialog's DOM id, unique per rendering since a post and its shares can appear on the same page.
     */
    #[Locked]
    public string $modalId;

    public string $body = '';

    public string $privacyStatus = '';

    public function mount(Post $post, string $modalId): void
    {
        $this->post = $post;
        $this->modalId = $modalId;
        $this->privacyStatus = Auth::user()?->privacy_status?->value ?? PrivacyStatus::Public->value;
    }

    public function share(): void
    {
        $this->authorize('share', $this->post);

        $validated = $this->validate([
            'body' => ['nullable', 'string', 'max:5000'],
            'privacyStatus' => ['required', Rule::enum(PrivacyStatus::class)],
        ]);

        Auth::user()->posts()->create([
            'shared_post_id' => $this->post->id,
            'body' => $validated['body'] !== '' ? $validated['body'] : null,
            'privacy_status' => $validated['privacyStatus'],
        ]);

        $this->reset('body');

        $this->dispatch("post-shared.{$this->post->id}");

        $this->js("bootstrap.Modal.getInstance(document.getElementById('{$this->modalId}'))?.hide()");
    }
};
?>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}-label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" wire:submit="share">
            <div class="modal-header">
                <h2 class="modal-title h5" id="{{ $modalId }}-label">Share post</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img class="avatar" src="{{ auth()->user()?->profile_picture_url }}" alt="">
                    <div>
                        <p class="fw-semibold mb-1">{{ auth()->user()?->name }}</p>
                        <label class="visually-hidden" for="{{ $modalId }}-privacy">Who can see this share</label>
                        <select class="form-select form-select-sm w-auto" id="{{ $modalId }}-privacy" wire:model="privacyStatus">
                            <option value="public">🌐 Public</option>
                            <option value="friends">👥 Friends</option>
                            <option value="private">🔒 Only me</option>
                        </select>
                        @error('privacyStatus')
                            <p class="text-danger small mb-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label class="visually-hidden" for="{{ $modalId }}-body">Say something about this post</label>
                <textarea class="form-control border-0 mb-3" id="{{ $modalId }}-body" wire:model="body" rows="3" maxlength="5000" placeholder="Say something about this…"></textarea>
                @error('body')
                    <p class="text-danger small mb-0">{{ $message }}</p>
                @enderror

                <x-shared-post :post="$post" />
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary px-4" wire:loading.attr="disabled">Share now</button>
            </div>
        </form>
    </div>
</div>

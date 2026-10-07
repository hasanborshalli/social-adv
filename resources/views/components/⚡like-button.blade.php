<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public Post $post;

    #[Locked]
    public bool $isLiked = false;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->isLiked = Auth::user()?->hasLiked($post) ?? false;
    }

    public function toggleLike(): void
    {
        $this->authorize('like', $this->post);

        $user = Auth::user();

        if ($user->hasLiked($this->post)) {
            $user->unlike($this->post);
        } else {
            $user->like($this->post);
        }

        $this->isLiked = $user->hasLiked($this->post);

        $this->dispatch("like-toggled.{$this->post->id}");
    }
};
?>

<button class="btn {{ $isLiked ? 'text-primary fw-semibold' : '' }}" type="button" wire:click="toggleLike" aria-pressed="{{ $isLiked ? 'true' : 'false' }}" @cannot('like', $post) disabled @endcannot>
    <i class="bi {{ $isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} me-1" aria-hidden="true"></i>Like
</button>

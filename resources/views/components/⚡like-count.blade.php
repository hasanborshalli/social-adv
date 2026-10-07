<?php

use App\Models\Post;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public Post $post;

    #[Locked]
    public int $likesCount = 0;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->likesCount = $post->num_of_likes;
    }

    /**
     * Re-count the likes whenever the like button for this post is toggled.
     */
    #[On('like-toggled.{post.id}')]
    public function refreshLikesCount(): void
    {
        $this->likesCount = $this->post->likes()->count();
    }
};
?>

<span>{{ $likesCount }} {{ Str::plural('like', $likesCount) }}</span>

<?php

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public Post $post;

    public string $body = '';

    /**
     * The id of the comment being replied to, or null for a top-level comment.
     */
    public ?int $replyingTo = null;

    /**
     * Every comment on the post, grouped by the id of the comment it replies to.
     * Top-level comments are grouped under an empty key.
     *
     * @return Collection<int|string, Collection<int, Comment>>
     */
    #[Computed]
    public function commentsByParent(): Collection
    {
        return $this->post->comments()
            ->with('user')
            ->oldest()
            ->get()
            ->groupBy(fn (Comment $comment): int|string => $comment->comment_id ?? '');
    }

    #[Computed]
    public function replyingToComment(): ?Comment
    {
        return $this->replyingTo
            ? $this->commentsByParent->flatten()->firstWhere('id', $this->replyingTo)
            : null;
    }

    public function reply(int $commentId): void
    {
        $this->replyingTo = $commentId;
    }

    public function cancelReply(): void
    {
        $this->replyingTo = null;
    }

    public function addComment(): void
    {
        $this->authorize('comment', $this->post);

        $validated = $this->validate([
            'body' => ['required', 'string', 'max:2000'],
            'replyingTo' => ['nullable', 'integer', Rule::exists('comments', 'id')->where('post_id', $this->post->id)],
        ]);

        Auth::user()->comments()->create([
            'post_id' => $this->post->id,
            'comment_id' => $validated['replyingTo'],
            'body' => $validated['body'],
        ]);

        $this->reset('body', 'replyingTo');
        unset($this->commentsByParent, $this->replyingToComment);
    }
};
?>

<div>
    @if ($this->commentsByParent->has(''))
        <ul class="list-unstyled mb-3 vstack gap-2">
            @foreach ($this->commentsByParent->get('') as $comment)
                <x-comment :comment="$comment" :replies-by-parent="$this->commentsByParent" :can-reply="auth()->user()?->can('comment', $post) ?? false" wire:key="comment-{{ $comment->id }}" />
            @endforeach
        </ul>
    @else
        <p class="small text-secondary text-center mb-3">No comments yet.</p>
    @endif

    @can('comment', $post)
        @if ($this->replyingToComment)
            <p class="small text-secondary mb-1 ms-5">
                Replying to <span class="fw-semibold">{{ $this->replyingToComment->user->name }}</span> ·
                <button class="btn btn-link btn-sm p-0 link-muted fw-semibold align-baseline" type="button" wire:click="cancelReply">Cancel</button>
            </p>
        @endif

        <form class="d-flex align-items-center gap-2" wire:submit="addComment">
            <img class="avatar avatar-sm" src="{{ auth()->user()->profile_picture_url }}" alt="">
            <label class="visually-hidden" for="comment-post-{{ $post->id }}">Write a comment on {{ $post->user->name }}'s post</label>
            <input type="text" class="form-control rounded-pill @error('body') is-invalid @enderror" id="comment-post-{{ $post->id }}" wire:model="body" maxlength="2000" placeholder="{{ $this->replyingToComment ? 'Write a reply…' : 'Write a comment…' }}">
            <button class="btn btn-primary rounded-circle btn-icon" type="submit" aria-label="Send comment">
                <i class="bi bi-send" aria-hidden="true"></i>
            </button>
        </form>
        @error('body')
            <p class="small text-danger mt-1 mb-0 ms-5">{{ $message }}</p>
        @enderror
        @error('replyingTo')
            <p class="small text-danger mt-1 mb-0 ms-5">{{ $message }}</p>
        @enderror
    @endcan
</div>

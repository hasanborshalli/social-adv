@props(['comment', 'repliesByParent', 'canReply' => false, 'depth' => 0])

@php
  $replies = $repliesByParent->get($comment->id, collect());
@endphp

<li {{ $attributes->merge(['class' => 'd-flex gap-2']) }}>
  <a href="{{ route('profile.show', $comment->user) }}">
    <img class="avatar {{ $depth === 0 ? 'avatar-sm' : 'avatar-xs' }}" src="{{ $comment->user->profile_picture_url }}" alt="{{ $comment->user->name }}">
  </a>
  <div class="min-w-0 flex-grow-1">
    <div class="comment-bubble">
      <a class="fw-semibold small d-block text-body text-decoration-none" href="{{ route('profile.show', $comment->user) }}">{{ $comment->user->name }}</a>
      <span class="small text-break" style="white-space: pre-line">{{ $comment->body }}</span>
    </div>
    <div class="small text-secondary mt-1 ms-2">
      @if ($canReply)
        <button class="btn btn-link btn-sm p-0 link-muted fw-semibold align-baseline" type="button" wire:click="reply({{ $comment->id }})" x-on:click="$nextTick(() => document.getElementById('comment-post-{{ $comment->post_id }}')?.focus())">Reply</button> ·
      @endif
      <time datetime="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->diffForHumans() }}</time>
    </div>

    @if ($replies->isNotEmpty())
      <ul class="list-unstyled comment-replies mt-2 vstack gap-2">
        @foreach ($replies as $reply)
          <x-comment :comment="$reply" :replies-by-parent="$repliesByParent" :can-reply="$canReply" :depth="$depth + 1" wire:key="comment-{{ $reply->id }}" />
        @endforeach
      </ul>
    @endif
  </div>
</li>

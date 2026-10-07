@props(['post'])

@php
  $author = $post->user;
  $isOwnPost = auth()->id() === $post->user_id;
  // Sharing a share re-shares the original post.
  $postToShare = $post->isShare() ? $post->sharedPost : $post;
  $canShare = $postToShare && (auth()->user()?->can('share', $postToShare) ?? false);
@endphp

<article {{ $attributes->merge(['class' => 'card mb-3']) }}>
  <h2 class="visually-hidden">Post by {{ $author->name }}</h2>
  <div class="card-body pb-2">
    <header class="d-flex align-items-start gap-2 mb-2">
      <a href="{{ route('profile.show', $author) }}"><img class="avatar" src="{{ $author->profile_picture_url }}" alt="{{ $author->name }}"></a>
      <div class="flex-grow-1 min-w-0">
        <p class="mb-0">
          <a class="fw-semibold text-body text-decoration-none" href="{{ route('profile.show', $author) }}">{{ $author->name }}</a>
          @if ($post->isShare())
            <span class="text-secondary">shared a post</span>
          @endif
        </p>
        <p class="small text-secondary mb-0">
          <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->diffForHumans() }}</time> ·
          @switch($post->privacy_status)
            @case(\App\Enums\PrivacyStatus::Friends)
              <i class="bi bi-people-fill" aria-hidden="true"></i> Friends
              @break
            @case(\App\Enums\PrivacyStatus::Private)
              <i class="bi bi-lock-fill" aria-hidden="true"></i> Only me
              @break
            @default
              <i class="bi bi-globe-americas" aria-hidden="true"></i> Public
          @endswitch
        </p>
      </div>
      @auth
        <div class="dropdown">
          <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
            <i class="bi bi-three-dots" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            @if ($isOwnPost)
              <li><button class="dropdown-item" type="button"><i class="bi bi-pin-angle me-2" aria-hidden="true"></i>Pin to profile</button></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit post</button></li>
              <li><hr class="dropdown-divider"></li>
              <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-trash me-2" aria-hidden="true"></i>Delete</button></li>
            @else
              <li><button class="dropdown-item" type="button"><i class="bi bi-bookmark me-2" aria-hidden="true"></i>Save post</button></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-eye-slash me-2" aria-hidden="true"></i>Hide post</button></li>
              <li><hr class="dropdown-divider"></li>
              <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-flag me-2" aria-hidden="true"></i>Report</button></li>
            @endif
          </ul>
        </div>
      @endauth
    </header>
    @if ($post->body)
      <p class="mb-0 text-break" style="white-space: pre-line">{{ $post->body }}</p>
    @endif
    @if ($post->isShare())
      <x-shared-post :post="$post->sharedPost" @class(['mt-2' => $post->body]) />
    @endif
  </div>

  @if ($post->media_type === 'image')
    <a class="post-photo" href="{{ $post->media_url }}">
      <img src="{{ $post->media_url }}" alt="Photo posted by {{ $author->name }}">
    </a>
  @elseif ($post->media_type === 'video')
    <video class="w-100 d-block bg-black" src="{{ $post->media_url }}" controls preload="metadata"></video>
  @endif

  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between small text-secondary">
      <livewire:like-count :post="$post" :wire:key="'like-count-'.$post->id" />
      @unless ($post->isShare())
        <livewire:share-count :post="$post" :wire:key="'share-count-'.$post->id" />
      @endunless
    </div>

    @auth
      <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
        <livewire:like-button :post="$post" :wire:key="'like-'.$post->id" />
        <label class="btn" for="comment-post-{{ $post->id }}"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</label>
        <button class="btn" type="button" @if ($canShare) data-bs-toggle="modal" data-bs-target="#share-post-{{ $post->id }}" @else disabled @endif><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
      </div>

      @if ($canShare)
        <livewire:share-post :post="$postToShare" :modal-id="'share-post-'.$post->id" :wire:key="'share-post-'.$post->id" />
      @endif

      <hr class="my-2">
    @endauth

    <livewire:comment-section :post="$post" :wire:key="'comments-'.$post->id" />
  </div>
</article>

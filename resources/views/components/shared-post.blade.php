@props(['post'])

{{-- The original post embedded inside a share. Hidden when it was deleted or the viewer can't see it. --}}
@if ($post && Gate::allows('view', $post))
  @php $author = $post->user; @endphp
  <div {{ $attributes->merge(['class' => 'border rounded-3 overflow-hidden']) }}>
    @if ($post->media_type === 'image')
      <a class="post-photo" href="{{ $post->media_url }}">
        <img src="{{ $post->media_url }}" alt="Photo posted by {{ $author->name }}">
      </a>
    @elseif ($post->media_type === 'video')
      <video class="w-100 d-block bg-black" src="{{ $post->media_url }}" controls preload="metadata"></video>
    @endif

    <div class="p-3">
      <header class="d-flex align-items-center gap-2 mb-2">
        <a href="{{ route('profile.show', $author) }}"><img class="avatar avatar-sm" src="{{ $author->profile_picture_url }}" alt="{{ $author->name }}"></a>
        <div class="min-w-0">
          <p class="mb-0">
            <a class="fw-semibold text-body text-decoration-none" href="{{ route('profile.show', $author) }}">{{ $author->name }}</a>
          </p>
          <p class="small text-secondary mb-0">
            <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->diffForHumans() }}</time>
          </p>
        </div>
      </header>
      @if ($post->body)
        <p class="mb-0 text-break" style="white-space: pre-line">{{ $post->body }}</p>
      @endif
    </div>
  </div>
@else
  <div {{ $attributes->merge(['class' => 'border rounded-3 p-3 text-secondary']) }}>
    <p class="fw-semibold mb-1"><i class="bi bi-lock me-1" aria-hidden="true"></i>This content isn't available right now</p>
    <p class="small mb-0">It may have been deleted, or its author changed who can see it.</p>
  </div>
@endif

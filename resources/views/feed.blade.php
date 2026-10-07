<x-layouts.app title="Feed · YouBee Social">
  <x-slot:rail>
    <x-right-rail />
  </x-slot:rail>

  <h1 class="visually-hidden">Your feed</h1>

  <!-- Composer -->
  @auth
    <section class="card mb-3" aria-labelledby="composerHeading">
      <div class="card-body">
        <h2 class="visually-hidden" id="composerHeading">Create a post</h2>
        <div class="d-flex align-items-center gap-2">
          <img class="avatar" src="{{ auth()->user()->profile_picture_url }}" alt="">
          <button class="composer-trigger" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
            What's on your mind, {{ explode(' ', auth()->user()->name)[0] }}?
          </button>
        </div>
        <hr class="my-3">
        <div class="d-flex flex-wrap gap-1">
          <button class="btn btn-light flex-fill" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
            <i class="bi bi-image text-success me-1" aria-hidden="true"></i>Photo
          </button>
          <button class="btn btn-light flex-fill" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
            <i class="bi bi-camera-video text-danger me-1" aria-hidden="true"></i>Video
          </button>
        </div>
      </div>
    </section>
  @else
    <section class="card mb-3" aria-labelledby="composerHeading">
      <div class="card-body text-center py-4">
        <h2 class="h5 mb-1" id="composerHeading">Join the conversation</h2>
        <p class="text-secondary mb-3">Log in or create an account to post, like and comment.</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
          <a class="btn btn-primary px-4" href="{{ route('login') }}">Log in</a>
          <a class="btn btn-light px-4" href="{{ route('register') }}">Create an account</a>
        </div>
      </div>
    </section>
  @endauth

  <!-- Feed sort -->
  <div class="d-flex align-items-center justify-content-between mb-2 px-1">
    <h2 class="h6 text-secondary mb-0">Your feed</h2>
    <div class="dropdown">
      <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-sliders me-1" aria-hidden="true"></i>Most recent
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0">
        <li><button class="dropdown-item active" type="button">Most recent</button></li>
        <li><button class="dropdown-item" type="button">Top posts</button></li>
        @auth
          <li><button class="dropdown-item" type="button">Friends only</button></li>
        @endauth
      </ul>
    </div>
  </div>

  @forelse ($posts as $post)
    <x-post :post="$post" />
  @empty
    <section class="card mb-3">
      <div class="card-body text-center text-secondary py-5">
        <i class="bi bi-journal-text fs-2 d-block mb-2" aria-hidden="true"></i>
        No posts to show yet.
      </div>
    </section>
  @endforelse

  @if ($posts->isNotEmpty())
    <p class="text-center text-secondary small py-2 mb-0">You're all caught up ✨</p>
  @endif
</x-layouts.app>

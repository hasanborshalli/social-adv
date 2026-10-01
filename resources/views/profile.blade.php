<x-layouts.app :title="$user->name.' · YouBee Social'">

  <!-- ===== Profile header ===== -->
  <section class="card mb-3 overflow-hidden" aria-labelledby="profileName">

    <div class="position-relative">
      <img class="cover" src="{{ $user->cover_photo_url }}" alt="{{ $user->name }}'s cover photo">
      @if ($isOwnProfile)
        <button class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-3 shadow-sm"
                type="button" data-bs-toggle="modal" data-bs-target="#changeCoverModal">
          <i class="bi bi-camera me-1" aria-hidden="true"></i>Edit cover
        </button>
      @endif
    </div>

    <div class="card-body">
      <div class="d-flex flex-column flex-md-row align-items-center align-items-md-end gap-3 profile-identity">

        <div class="profile-avatar-wrap position-relative">
          <img class="avatar avatar-2xl profile-avatar" src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}">
          @if ($isOwnProfile)
            <button class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 shadow-sm"
                    type="button" data-bs-toggle="modal" data-bs-target="#changeAvatarModal"
                    aria-label="Change profile picture" title="Change profile picture">
              <i class="bi bi-camera-fill" aria-hidden="true"></i>
            </button>
          @endif
        </div>

        <div class="flex-grow-1 text-center text-md-start min-w-0">
          <h1 class="h3 mb-1" id="profileName">{{ $user->name }}</h1>
          <p class="text-secondary mb-2">{{ '@'.$user->username }}@if ($user->work) · {{ $user->work }}@endif</p>
          <div class="d-flex justify-content-center justify-content-md-start gap-4">
            <span class="stat-block"><strong>486</strong><small class="text-secondary">Friends</small></span>
            <span class="stat-block"><strong>1,204</strong><small class="text-secondary">Followers</small></span>
            <span class="stat-block"><strong>{{ number_format($posts->count()) }}</strong><small class="text-secondary">Posts</small></span>
          </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
          @if ($isOwnProfile)
            <a class="btn btn-primary" href="{{ route('settings') }}">
              <i class="bi bi-pencil me-1" aria-hidden="true"></i>Edit profile
            </a>
          @else
            <livewire:add-friend :target="$user" />
          @endif
          <div class="dropdown">
            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More profile actions">
              <i class="bi bi-three-dots" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
              @if ($isOwnProfile)
                <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit profile</a></li>
              @endif
              <li><button class="dropdown-item" type="button"><i class="bi bi-share me-2" aria-hidden="true"></i>Share profile</button></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-link-45deg me-2" aria-hidden="true"></i>Copy link</button></li>
              @unless ($isOwnProfile)
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-slash-circle me-2" aria-hidden="true"></i>Block</button></li>
              @endunless
            </ul>
          </div>
        </div>
      </div>
    </div>

    <nav class="border-top px-2" aria-label="Profile sections">
      <ul class="nav profile-tabs flex-nowrap overflow-auto" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="tab-posts" data-bs-toggle="tab" data-bs-target="#panel-posts"
                  type="button" role="tab" aria-controls="panel-posts" aria-selected="true">Posts</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-about" data-bs-toggle="tab" data-bs-target="#panel-about"
                  type="button" role="tab" aria-controls="panel-about" aria-selected="false">About</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-friends" data-bs-toggle="tab" data-bs-target="#panel-friends"
                  type="button" role="tab" aria-controls="panel-friends" aria-selected="false">Friends</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab-photos" data-bs-toggle="tab" data-bs-target="#panel-photos"
                  type="button" role="tab" aria-controls="panel-photos" aria-selected="false">Photos</button>
        </li>
      </ul>
    </nav>
  </section>

  <!-- ===== Tab panels ===== -->
  <div class="tab-content">

    <!-- ========== Posts ========== -->
    <div class="tab-pane fade show active" id="panel-posts" role="tabpanel" aria-labelledby="tab-posts" tabindex="0">
      <div class="row g-3">

        <div class="col-12 col-lg-5">
          <section class="card mb-3" aria-labelledby="introHeading">
            <div class="card-body">
              <h2 class="h6 mb-3" id="introHeading">Intro</h2>
              @if ($user->bio)
                <p class="text-center text-balance">{{ $user->bio }}</p>
              @endif
              <ul class="list-unstyled vstack gap-2 small mb-3">
                @if ($user->work)
                  <li><i class="bi bi-briefcase text-secondary me-2" aria-hidden="true"></i>Works at <strong>{{ $user->work }}</strong></li>
                @endif
                @if ($user->education)
                  <li><i class="bi bi-mortarboard text-secondary me-2" aria-hidden="true"></i>Studied at <strong>{{ $user->education }}</strong></li>
                @endif
                @if ($user->city)
                  <li><i class="bi bi-geo-alt text-secondary me-2" aria-hidden="true"></i>Lives in <strong>{{ $user->city }}</strong></li>
                @endif
                @if ($user->website)
                  <li><i class="bi bi-link-45deg text-secondary me-2" aria-hidden="true"></i><a class="link-muted" href="{{ $user->website }}" target="_blank" rel="noopener noreferrer">{{ $user->website }}</a></li>
                @endif
                <li><i class="bi bi-calendar3 text-secondary me-2" aria-hidden="true"></i>Joined <time datetime="{{ $user->created_at->format('Y-m') }}">{{ $user->created_at->format('F Y') }}</time></li>
              </ul>
              @if ($isOwnProfile)
                <a class="btn btn-light w-100" href="{{ route('settings') }}">Edit details</a>
              @endif
            </div>
          </section>

          <section class="card mb-3" aria-labelledby="photosPreviewHeading">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h6 mb-0" id="photosPreviewHeading">Photos</h2>
                @if ($isOwnProfile)
                  <button class="btn btn-sm btn-light" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                    <i class="bi bi-upload me-1" aria-hidden="true"></i>Upload
                  </button>
                @endif
              </div>
              <div class="row g-1">
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-1.svg') }}" alt="Amber gradient study"></a></div>
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-2.svg') }}" alt="Blue gradient study"></a></div>
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-3.svg') }}" alt="Green gradient study"></a></div>
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-4.svg') }}" alt="Pink gradient study"></a></div>
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-5.svg') }}" alt="Violet gradient study"></a></div>
                <div class="col-4"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-6.svg') }}" alt="Cyan gradient study"></a></div>
              </div>
            </div>
          </section>

          <section class="card" aria-labelledby="friendsPreviewHeading">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h6 mb-0" id="friendsPreviewHeading">Friends <span class="text-secondary fw-normal">486</span></h2>
                <a class="small link-muted" href="{{ route('friends') }}">See all</a>
              </div>
              <div class="row g-2 text-center">
                <div class="col-6">
                  <a class="text-decoration-none text-body" href="{{ route('profile') }}">
                    <img class="avatar avatar-xl w-100 h-auto rounded-3" src="{{ asset('assets/img/avatar-2.svg') }}" alt="">
                    <small class="d-block mt-1 text-truncate">Ali Nahleh</small>
                  </a>
                </div>
                <div class="col-6">
                  <a class="text-decoration-none text-body" href="{{ route('profile') }}">
                    <img class="avatar avatar-xl w-100 h-auto rounded-3" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
                    <small class="d-block mt-1 text-truncate">Maysam Chaalan</small>
                  </a>
                </div>
                <div class="col-6">
                  <a class="text-decoration-none text-body" href="{{ route('profile') }}">
                    <img class="avatar avatar-xl w-100 h-auto rounded-3" src="{{ asset('assets/img/avatar-7.svg') }}" alt="">
                    <small class="d-block mt-1 text-truncate">Elias Al Omar</small>
                  </a>
                </div>
                <div class="col-6">
                  <a class="text-decoration-none text-body" href="{{ route('profile') }}">
                    <img class="avatar avatar-xl w-100 h-auto rounded-3" src="{{ asset('assets/img/avatar-8.svg') }}" alt="">
                    <small class="d-block mt-1 text-truncate">Haitham Ismail</small>
                  </a>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div class="col-12 col-lg-7">
          @if ($isOwnProfile)
            <section class="card mb-3" aria-labelledby="profileComposerHeading">
              <div class="card-body">
                <h2 class="visually-hidden" id="profileComposerHeading">Create a post</h2>
                <div class="d-flex align-items-center gap-2">
                  <img class="avatar" src="{{ $user->profile_picture_url }}" alt="">
                  <button class="composer-trigger" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                    What's on your mind, {{ Str::before($user->name, ' ') }}?
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
          @endif

          @forelse ($posts as $post)
            <article class="card mb-3">
              <h2 class="visually-hidden">Post by {{ $user->name }}</h2>
              <div class="card-body pb-2">
                <header class="d-flex align-items-start gap-2 mb-2">
                  <img class="avatar" src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}">
                  <div class="flex-grow-1 min-w-0">
                    <p class="mb-0"><span class="fw-semibold">{{ $user->name }}</span></p>
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
                  @if ($isOwnProfile)
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
                        <i class="bi bi-three-dots" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><button class="dropdown-item" type="button"><i class="bi bi-pin-angle me-2" aria-hidden="true"></i>Pin to profile</button></li>
                        <li><button class="dropdown-item" type="button"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit post</button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-trash me-2" aria-hidden="true"></i>Delete</button></li>
                      </ul>
                    </div>
                  @endif
                </header>
                @if ($post->body)
                  <p class="mb-0 text-break" style="white-space: pre-line">{{ $post->body }}</p>
                @endif
              </div>

              @if ($post->media_type === 'image')
                <a class="post-photo" href="{{ $post->media_url }}">
                  <img src="{{ $post->media_url }}" alt="Photo posted by {{ $user->name }}">
                </a>
              @elseif ($post->media_type === 'video')
                <video class="w-100 d-block bg-black" src="{{ $post->media_url }}" controls preload="metadata"></video>
              @endif

              <div class="card-body">
                <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
                  <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
                  <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
                  <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
                </div>
              </div>
            </article>
          @empty
            <section class="card mb-3">
              <div class="card-body text-center text-secondary py-5">
                <i class="bi bi-journal-text fs-2 d-block mb-2" aria-hidden="true"></i>
                No posts yet.
              </div>
            </section>
          @endforelse
        </div>
      </div>
    </div>

    <!-- ========== About ========== -->
    <div class="tab-pane fade" id="panel-about" role="tabpanel" aria-labelledby="tab-about" tabindex="0">
      <div class="card">
        <div class="card-body">
          <h2 class="h5 mb-4">About {{ Str::before($user->name, ' ') }}</h2>

          @if ($user->work || $user->education)
            <h3 class="h6 text-secondary">Work and education</h3>
            <dl class="row mb-4">
              @if ($user->work)
                <dt class="col-sm-4 fw-normal text-secondary">Work</dt>
                <dd class="col-sm-8">{{ $user->work }}</dd>
              @endif
              @if ($user->education)
                <dt class="col-sm-4 fw-normal text-secondary">Education</dt>
                <dd class="col-sm-8">{{ $user->education }}</dd>
              @endif
            </dl>
          @endif

          @if ($user->city)
            <h3 class="h6 text-secondary">Places</h3>
            <dl class="row mb-4">
              <dt class="col-sm-4 fw-normal text-secondary">Lives in</dt>
              <dd class="col-sm-8">{{ $user->city }}</dd>
            </dl>
          @endif

          <h3 class="h6 text-secondary">Contact and basic info</h3>
          <dl class="row mb-4">
            @if ($user->website)
              <dt class="col-sm-4 fw-normal text-secondary">Website</dt>
              <dd class="col-sm-8"><a class="link-muted" href="{{ $user->website }}" target="_blank" rel="noopener noreferrer">{{ $user->website }}</a></dd>
            @endif
            <dt class="col-sm-4 fw-normal text-secondary">Joined</dt>
            <dd class="col-sm-8"><time datetime="{{ $user->created_at->toDateString() }}">{{ $user->created_at->format('j F Y') }}</time></dd>
          </dl>

          @if ($isOwnProfile)
            <a class="btn btn-light" href="{{ route('settings') }}">
              <i class="bi bi-pencil me-1" aria-hidden="true"></i>Edit about section
            </a>
          @endif
        </div>
      </div>
    </div>

    <!-- ========== Friends ========== -->
    <div class="tab-pane fade" id="panel-friends" role="tabpanel" aria-labelledby="tab-friends" tabindex="0">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <h2 class="h5 mb-0">Friends <span class="text-secondary fw-normal fs-6">486</span></h2>
            <form class="d-flex" role="search" action="#" method="get">
              <label class="visually-hidden" for="friendSearch">Search friends</label>
              <input type="search" class="form-control form-control-sm" id="friendSearch" name="q" placeholder="Search friends">
            </form>
          </div>

          <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-lg-4">
            <div class="col">
              <div class="card person-card">
                <div class="card-body">
                  <img class="avatar avatar-xl mb-2" src="{{ asset('assets/img/avatar-2.svg') }}" alt="">
                  <p class="fw-semibold mb-0 text-truncate w-100">Ali Nahleh</p>
                  <p class="mutuals mb-2">18 mutual friends</p>
                  <a class="btn btn-sm btn-light" href="{{ route('profile') }}">View profile</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card person-card">
                <div class="card-body">
                  <img class="avatar avatar-xl mb-2" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
                  <p class="fw-semibold mb-0 text-truncate w-100">Maysam Chaalan</p>
                  <p class="mutuals mb-2">24 mutual friends</p>
                  <a class="btn btn-sm btn-light" href="{{ route('profile') }}">View profile</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card person-card">
                <div class="card-body">
                  <img class="avatar avatar-xl mb-2" src="{{ asset('assets/img/avatar-7.svg') }}" alt="">
                  <p class="fw-semibold mb-0 text-truncate w-100">Elias Al Omar</p>
                  <p class="mutuals mb-2">9 mutual friends</p>
                  <a class="btn btn-sm btn-light" href="{{ route('profile') }}">View profile</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card person-card">
                <div class="card-body">
                  <img class="avatar avatar-xl mb-2" src="{{ asset('assets/img/avatar-8.svg') }}" alt="">
                  <p class="fw-semibold mb-0 text-truncate w-100">Haitham Ismail</p>
                  <p class="mutuals mb-2">31 mutual friends</p>
                  <a class="btn btn-sm btn-light" href="{{ route('profile') }}">View profile</a>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <button class="btn btn-light" type="button">Load more friends</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== Photos ========== -->
    <div class="tab-pane fade" id="panel-photos" role="tabpanel" aria-labelledby="tab-photos" tabindex="0">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <h2 class="h5 mb-0">Photos</h2>
            @if ($isOwnProfile)
              <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                <i class="bi bi-upload me-1" aria-hidden="true"></i>Upload photo
              </button>
            @endif
          </div>

          <ul class="nav nav-pills gap-2 mb-3" aria-label="Photo collections">
            <li class="nav-item"><a class="nav-link active" href="#" aria-current="page">All</a></li>
            <li class="nav-item"><a class="nav-link link-muted" href="#">Albums</a></li>
          </ul>

          <div class="row g-2 row-cols-2 row-cols-sm-3 row-cols-lg-4">
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-1.svg') }}" alt="Amber gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-2.svg') }}" alt="Blue gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-3.svg') }}" alt="Green gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-4.svg') }}" alt="Pink gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-5.svg') }}" alt="Violet gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-6.svg') }}" alt="Cyan gradient study"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-2.svg') }}" alt="Blue gradient study, second frame"></a></div>
            <div class="col"><a class="photo-tile" href="#"><img src="{{ asset('assets/img/photo-4.svg') }}" alt="Pink gradient study, second frame"></a></div>
          </div>

          <div class="text-center mt-4">
            <button class="btn btn-light" type="button">Load more photos</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if ($isOwnProfile)
    <x-modals.change-avatar />
    <x-modals.change-cover />
  @endif
</x-layouts.app>

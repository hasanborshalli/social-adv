<x-layouts.app title="Hasan Nahleh · YouBee Social">

  <!-- ===== Profile header ===== -->
  <section class="card mb-3 overflow-hidden" aria-labelledby="profileName">

    <div class="position-relative">
      <img class="cover" src="{{ auth()->user()->cover_photo_url }}" alt="Hasan Nahleh's cover photo">
      <button class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-3 shadow-sm"
              type="button" data-bs-toggle="modal" data-bs-target="#changeCoverModal">
        <i class="bi bi-camera me-1" aria-hidden="true"></i>Edit cover
      </button>
    </div>

    <div class="card-body">
      <div class="d-flex flex-column flex-md-row align-items-center align-items-md-end gap-3 profile-identity">

        <div class="profile-avatar-wrap position-relative">
          <img class="avatar avatar-2xl profile-avatar" src="{{ auth()->user()->profile_picture_url }}" alt="Hasan Nahleh">
          <button class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 shadow-sm"
                  type="button" data-bs-toggle="modal" data-bs-target="#changeAvatarModal"
                  aria-label="Change profile picture" title="Change profile picture">
            <i class="bi bi-camera-fill" aria-hidden="true"></i>
          </button>
        </div>

        <div class="flex-grow-1 text-center text-md-start min-w-0">
          <h1 class="h3 mb-1" id="profileName">Hasan Nahleh</h1>
          <p class="text-secondary mb-2">@hasann · Product designer at Hivework</p>
          <div class="d-flex justify-content-center justify-content-md-start gap-4">
            <span class="stat-block"><strong>486</strong><small class="text-secondary">Friends</small></span>
            <span class="stat-block"><strong>1,204</strong><small class="text-secondary">Followers</small></span>
            <span class="stat-block"><strong>312</strong><small class="text-secondary">Posts</small></span>
          </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
          <a class="btn btn-primary" href="{{ route('settings') }}">
            <i class="bi bi-pencil me-1" aria-hidden="true"></i>Edit profile
          </a>
          <div class="dropdown">
            <button class="btn btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More profile actions">
              <i class="bi bi-three-dots" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
              <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit profile</a></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-share me-2" aria-hidden="true"></i>Share profile</button></li>
              <li><button class="dropdown-item" type="button"><i class="bi bi-link-45deg me-2" aria-hidden="true"></i>Copy link</button></li>
              <li><hr class="dropdown-divider"></li>
              <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-slash-circle me-2" aria-hidden="true"></i>Block</button></li>
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
              <p class="text-center text-balance">Designing calmer software. Bikes, film cameras, and too many notebooks.</p>
              <ul class="list-unstyled vstack gap-2 small mb-3">
                <li><i class="bi bi-briefcase text-secondary me-2" aria-hidden="true"></i>Product designer at <strong>Hivework</strong></li>
                <li><i class="bi bi-mortarboard text-secondary me-2" aria-hidden="true"></i>Studied at <strong>Central Saint Martins</strong></li>
                <li><i class="bi bi-geo-alt text-secondary me-2" aria-hidden="true"></i>Lives in <strong>Manchester, UK</strong></li>
                <li><i class="bi bi-house text-secondary me-2" aria-hidden="true"></i>From <strong>Lagos, Nigeria</strong></li>
                <li><i class="bi bi-link-45deg text-secondary me-2" aria-hidden="true"></i><a class="link-muted" href="#">hasann.design</a></li>
                <li><i class="bi bi-calendar3 text-secondary me-2" aria-hidden="true"></i>Joined <time datetime="2019-03">March 2019</time></li>
              </ul>
              <button class="btn btn-light w-100" type="button">Edit details</button>
            </div>
          </section>

          <section class="card mb-3" aria-labelledby="photosPreviewHeading">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h6 mb-0" id="photosPreviewHeading">Photos</h2>
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                  <i class="bi bi-upload me-1" aria-hidden="true"></i>Upload
                </button>
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
          <section class="card mb-3" aria-labelledby="profileComposerHeading">
            <div class="card-body">
              <h2 class="visually-hidden" id="profileComposerHeading">Create a post</h2>
              <div class="d-flex align-items-center gap-2">
                <img class="avatar" src="{{ auth()->user()->profile_picture_url }}" alt="">
                <button class="composer-trigger" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
                  What's on your mind, Hasan?
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

          <article class="card mb-3">
            <h2 class="visually-hidden">Post by Hasan Nahleh</h2>
            <div class="card-body pb-2">
              <header class="d-flex align-items-start gap-2 mb-2">
                <img class="avatar" src="{{ asset('assets/img/avatar-1.svg') }}" alt="Hasan Nahleh">
                <div class="flex-grow-1 min-w-0">
                  <p class="mb-0"><span class="fw-semibold">Hasan Nahleh</span></p>
                  <p class="small text-secondary mb-0">
                    <time datetime="2026-09-12T11:30">2 days ago</time> ·
                    <i class="bi bi-globe-americas" aria-hidden="true"></i> Public
                  </p>
                </div>
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
              </header>
              <p class="mb-0">
                Spent the morning rebuilding our type scale from scratch. Four sizes instead of eleven.
                Nobody has noticed, which is exactly the point.
              </p>
            </div>

            <a class="post-photo" href="#">
              <img src="{{ asset('assets/img/photo-1.svg') }}" alt="Type scale specimen sheet">
            </a>

            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between small text-secondary">
                <span>
                  <span>203 likes</span>
                </span>
                <span><a class="link-muted" href="#">31 comments</a></span>
              </div>
              <hr class="my-2">
              <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
                <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
                <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
                <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
              </div>
            </div>
          </article>

          <article class="card mb-3">
            <h2 class="visually-hidden">Post by Hasan Nahleh</h2>
            <div class="card-body pb-2">
              <header class="d-flex align-items-start gap-2 mb-2">
                <img class="avatar" src="{{ asset('assets/img/avatar-1.svg') }}" alt="Hasan Nahleh">
                <div class="flex-grow-1 min-w-0">
                  <p class="mb-0"><span class="fw-semibold">Hasan Nahleh</span></p>
                  <p class="small text-secondary mb-0">
                    <time datetime="2026-09-08T19:15">6 days ago</time> ·
                    <i class="bi bi-people-fill" aria-hidden="true"></i> Friends
                  </p>
                </div>
              </header>
              <p class="fs-5 mb-0">
                Unpopular opinion: most design systems fail at documentation, not components.
              </p>
            </div>
            <div class="card-body pt-3">
              <div class="d-flex align-items-center justify-content-between small text-secondary">
                <span>78 likes</span>
                <span><a class="link-muted" href="#">19 comments</a></span>
              </div>
              <hr class="my-2">
              <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
                <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
                <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
                <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>

    <!-- ========== About ========== -->
    <div class="tab-pane fade" id="panel-about" role="tabpanel" aria-labelledby="tab-about" tabindex="0">
      <div class="card">
        <div class="card-body">
          <h2 class="h5 mb-4">About Hasan</h2>

          <h3 class="h6 text-secondary">Work and education</h3>
          <dl class="row mb-4">
            <dt class="col-sm-4 fw-normal text-secondary">Current role</dt>
            <dd class="col-sm-8">Product designer at Hivework · since 2022</dd>
            <dt class="col-sm-4 fw-normal text-secondary">Previously</dt>
            <dd class="col-sm-8">Design lead at Northbeam Studio · 2019–2022</dd>
            <dt class="col-sm-4 fw-normal text-secondary">Education</dt>
            <dd class="col-sm-8">BA Graphic Design, Central Saint Martins</dd>
          </dl>

          <h3 class="h6 text-secondary">Places</h3>
          <dl class="row mb-4">
            <dt class="col-sm-4 fw-normal text-secondary">Lives in</dt>
            <dd class="col-sm-8">Manchester, United Kingdom</dd>
            <dt class="col-sm-4 fw-normal text-secondary">From</dt>
            <dd class="col-sm-8">Lagos, Nigeria</dd>
          </dl>

          <h3 class="h6 text-secondary">Contact and basic info</h3>
          <dl class="row mb-4">
            <dt class="col-sm-4 fw-normal text-secondary">Website</dt>
            <dd class="col-sm-8"><a class="link-muted" href="#">hasann.design</a></dd>
            <dt class="col-sm-4 fw-normal text-secondary">Joined</dt>
            <dd class="col-sm-8"><time datetime="2019-03-14">14 March 2019</time></dd>
          </dl>

          <a class="btn btn-light" href="{{ route('settings') }}">
            <i class="bi bi-pencil me-1" aria-hidden="true"></i>Edit about section
          </a>
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
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
              <i class="bi bi-upload me-1" aria-hidden="true"></i>Upload photo
            </button>
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

  <x-modals.change-avatar />
  <x-modals.change-cover />
</x-layouts.app>

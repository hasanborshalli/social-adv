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

  <!-- ========== Post: two photos ========== -->
  <article class="card mb-3">
    <h2 class="visually-hidden">Post by Ali Nahleh</h2>
    <div class="card-body pb-2">
      <header class="d-flex align-items-start gap-2 mb-2">
        <a href="{{ route('profile') }}"><img class="avatar" src="{{ asset('assets/img/avatar-2.svg') }}" alt="Ali Nahleh"></a>
        <div class="flex-grow-1 min-w-0">
          <p class="mb-0">
            <a class="fw-semibold text-body text-decoration-none" href="{{ route('profile') }}">Ali Nahleh</a>
          </p>
          <p class="small text-secondary mb-0">
            <time datetime="2026-09-14T08:20">2 hours ago</time> ·
            <i class="bi bi-globe-americas" aria-hidden="true"></i> Public
          </p>
        </div>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
            <i class="bi bi-three-dots" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><button class="dropdown-item" type="button"><i class="bi bi-bookmark me-2" aria-hidden="true"></i>Save post</button></li>
            <li><button class="dropdown-item" type="button"><i class="bi bi-bell-slash me-2" aria-hidden="true"></i>Turn off notifications</button></li>
            <li><button class="dropdown-item" type="button"><i class="bi bi-eye-slash me-2" aria-hidden="true"></i>Hide post</button></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-flag me-2" aria-hidden="true"></i>Report</button></li>
          </ul>
        </div>
      </header>
      <p class="mb-0">
        Three days of tiles, trams and custard tarts. The light here does half the work for you. ☀️
      </p>
    </div>

    <a class="post-photo" href="#">
      <img src="{{ asset('assets/img/photo-2.svg') }}" alt="Sunlit tiled facade in Lisbon">
    </a>

    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between small text-secondary">
        <span>
          <span>128 likes</span>
        </span>
        <span><a class="link-muted" href="#">24 comments</a> · <a class="link-muted" href="#">6 shares</a></span>
      </div>

      <hr class="my-2">

      @auth
        <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
          <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
          <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
          <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
        </div>

        <hr class="my-2">
      @endauth

      <ul class="list-unstyled mb-3 vstack gap-2">
        <li class="d-flex gap-2">
          <img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
          <div class="min-w-0 flex-grow-1">
            <div class="comment-bubble">
              <a class="fw-semibold small text-body text-decoration-none d-block" href="{{ route('profile') }}">Maysam Chaalan</a>
              <span class="small">That second shot is unreal. Which lens?</span>
            </div>
            <div class="small text-secondary mt-1 ms-2">
              <a class="link-muted fw-semibold" href="#">Like</a> ·
              <a class="link-muted fw-semibold" href="#">Reply</a> ·
              <time datetime="2026-09-14T09:05">1 h</time>
            </div>

            <!-- Replies to this comment -->
            <ul class="list-unstyled comment-replies mt-2 vstack gap-2">
              <li class="d-flex gap-2">
                <img class="avatar avatar-xs" src="{{ asset('assets/img/avatar-2.svg') }}" alt="">
                <div class="min-w-0">
                  <div class="comment-bubble">
                    <a class="fw-semibold small text-body text-decoration-none d-block" href="{{ route('profile') }}">Ali Nahleh</a>
                    <span class="small">35mm, wide open. Barely had to edit it.</span>
                  </div>
                  <div class="small text-secondary mt-1 ms-2">
                    <a class="link-muted fw-semibold" href="#">Like</a> ·
                    <a class="link-muted fw-semibold" href="#">Reply</a> ·
                    <time datetime="2026-09-14T09:18">52 min</time>
                  </div>
                </div>
              </li>
              <li class="d-flex gap-2">
                <img class="avatar avatar-xs" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
                <div class="min-w-0">
                  <div class="comment-bubble">
                    <a class="fw-semibold small text-body text-decoration-none d-block" href="{{ route('profile') }}">Maysam Chaalan</a>
                    <span class="small">Knew it. Thanks!</span>
                  </div>
                  <div class="small text-secondary mt-1 ms-2">
                    <a class="link-muted fw-semibold" href="#">Like</a> ·
                    <a class="link-muted fw-semibold" href="#">Reply</a> ·
                    <time datetime="2026-09-14T09:22">48 min</time>
                  </div>
                </div>
              </li>
              @auth
                <li>
                  <form class="d-flex align-items-center gap-2" action="#" method="post">
                    <img class="avatar avatar-xs" src="{{ asset('assets/img/avatar-1.svg') }}" alt="">
                    <label class="visually-hidden" for="reply-comment-1">Reply to Maysam Chaalan</label>
                    <input type="text" class="form-control form-control-sm rounded-pill" id="reply-comment-1"
                           name="reply" placeholder="Write a reply…">
                    <button class="btn btn-sm btn-light rounded-circle" type="submit" aria-label="Send reply">
                      <i class="bi bi-send" aria-hidden="true"></i>
                    </button>
                  </form>
                </li>
              @endauth
            </ul>
          </div>
        </li>
        <li class="d-flex gap-2">
          <img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-8.svg') }}" alt="">
          <div class="min-w-0">
            <div class="comment-bubble">
              <a class="fw-semibold small text-body text-decoration-none d-block" href="{{ route('profile') }}">Haitham Ismail</a>
              <span class="small">Adding Lisbon to the list. Any café recommendations?</span>
            </div>
            <div class="small text-secondary mt-1 ms-2">
              <a class="link-muted fw-semibold" href="#">Like</a> ·
              <a class="link-muted fw-semibold" href="#">Reply</a> ·
              <time datetime="2026-09-14T09:40">35 min</time>
            </div>
          </div>
        </li>
      </ul>

      @auth
        <form class="d-flex align-items-center gap-2" action="#" method="post">
          <img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-1.svg') }}" alt="">
          <label class="visually-hidden" for="comment-post-1">Write a comment on Ali Nahleh's post</label>
          <input type="text" class="form-control rounded-pill" id="comment-post-1" name="comment" placeholder="Write a comment…">
          <button class="btn btn-primary rounded-circle btn-icon" type="submit" aria-label="Send comment">
            <i class="bi bi-send" aria-hidden="true"></i>
          </button>
        </form>
      @endauth
    </div>
  </article>

  <!-- ========== Post: text only ========== -->
  <article class="card mb-3">
    <h2 class="visually-hidden">Post by Elias Al Omar</h2>
    <div class="card-body pb-2">
      <header class="d-flex align-items-start gap-2 mb-2">
        <a href="{{ route('profile') }}"><img class="avatar" src="{{ asset('assets/img/avatar-7.svg') }}" alt="Elias Al Omar"></a>
        <div class="flex-grow-1 min-w-0">
          <p class="mb-0"><a class="fw-semibold text-body text-decoration-none" href="{{ route('profile') }}">Elias Al Omar</a></p>
          <p class="small text-secondary mb-0">
            <time datetime="2026-09-14T06:10">4 hours ago</time> ·
            <i class="bi bi-people-fill" aria-hidden="true"></i> Friends
          </p>
        </div>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
            <i class="bi bi-three-dots" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><button class="dropdown-item" type="button"><i class="bi bi-bookmark me-2" aria-hidden="true"></i>Save post</button></li>
            <li><button class="dropdown-item" type="button"><i class="bi bi-eye-slash me-2" aria-hidden="true"></i>Hide post</button></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-flag me-2" aria-hidden="true"></i>Report</button></li>
          </ul>
        </div>
      </header>
      <p class="fs-5 mb-0">
        Shipped the new onboarding flow after six weeks. Drop-off is down 18%. Turns out the fix was
        deleting two screens, not adding a tooltip. 🐝
      </p>
    </div>

    <div class="card-body pt-3">
      <div class="d-flex align-items-center justify-content-between small text-secondary">
        <span>
          <span>92 likes</span>
        </span>
        <span><a class="link-muted" href="#">11 comments</a></span>
      </div>

      <hr class="my-2">

      @auth
        <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
          <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
          <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
          <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
        </div>

        <hr class="my-2">

        <form class="d-flex align-items-center gap-2" action="#" method="post">
          <img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-1.svg') }}" alt="">
          <label class="visually-hidden" for="comment-post-2">Write a comment on Elias Al Omar's post</label>
          <input type="text" class="form-control rounded-pill" id="comment-post-2" name="comment" placeholder="Write a comment…">
          <button class="btn btn-primary rounded-circle btn-icon" type="submit" aria-label="Send comment">
            <i class="bi bi-send" aria-hidden="true"></i>
          </button>
        </form>
      @endauth
    </div>
  </article>

  <!-- ========== Post: photo album (5 photos, 4 shown) ========== -->
  <article class="card mb-3">
    <h2 class="visually-hidden">Post by Maysam Chaalan</h2>
    <div class="card-body pb-2">
      <header class="d-flex align-items-start gap-2 mb-2">
        <a href="{{ route('profile') }}"><img class="avatar" src="{{ asset('assets/img/avatar-3.svg') }}" alt="Maysam Chaalan"></a>
        <div class="flex-grow-1 min-w-0">
          <p class="mb-0">
            <a class="fw-semibold text-body text-decoration-none" href="{{ route('profile') }}">Maysam Chaalan</a>
            <span class="text-secondary">added a photo to</span>
            <a class="text-body text-decoration-none fw-semibold" href="#">Studio work</a>
          </p>
          <p class="small text-secondary mb-0">
            <time datetime="2026-09-13T17:45">Yesterday at 17:45</time> ·
            <i class="bi bi-globe-americas" aria-hidden="true"></i> Public
          </p>
        </div>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
            <i class="bi bi-three-dots" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><button class="dropdown-item" type="button"><i class="bi bi-bookmark me-2" aria-hidden="true"></i>Save post</button></li>
            <li><button class="dropdown-item" type="button"><i class="bi bi-download me-2" aria-hidden="true"></i>Download album</button></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-flag me-2" aria-hidden="true"></i>Report</button></li>
          </ul>
        </div>
      </header>
      <p class="mb-0">Colour test for the autumn collection. This is the one that won. 🎨</p>
    </div>

    <a class="post-photo" href="#">
      <img src="{{ asset('assets/img/photo-3.svg') }}" alt="Green colour swatch test print">
    </a>

    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between small text-secondary">
        <span>
          <span>341 likes</span>
        </span>
        <span><a class="link-muted" href="#">47 comments</a> · <a class="link-muted" href="#">12 shares</a></span>
      </div>

      <hr class="my-2">

      @auth
        <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
          <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
          <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
          <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
        </div>

        <hr class="my-2">

        <form class="d-flex align-items-center gap-2" action="#" method="post">
          <img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-1.svg') }}" alt="">
          <label class="visually-hidden" for="comment-post-3">Write a comment on Maysam Chaalan's post</label>
          <input type="text" class="form-control rounded-pill" id="comment-post-3" name="comment" placeholder="Write a comment…">
          <button class="btn btn-primary rounded-circle btn-icon" type="submit" aria-label="Send comment">
            <i class="bi bi-send" aria-hidden="true"></i>
          </button>
        </form>
      @endauth
    </div>
  </article>

  <!-- ========== Post: single photo ========== -->
  <article class="card mb-3">
    <h2 class="visually-hidden">Post by Haitham Ismail</h2>
    <div class="card-body pb-2">
      <header class="d-flex align-items-start gap-2 mb-2">
        <a href="{{ route('profile') }}"><img class="avatar" src="{{ asset('assets/img/avatar-8.svg') }}" alt="Haitham Ismail"></a>
        <div class="flex-grow-1 min-w-0">
          <p class="mb-0"><a class="fw-semibold text-body text-decoration-none" href="{{ route('profile') }}">Haitham Ismail</a></p>
          <p class="small text-secondary mb-0">
            <time datetime="2026-09-13T08:02">Yesterday at 08:02</time> ·
            <i class="bi bi-globe-americas" aria-hidden="true"></i> Public
          </p>
        </div>
        <div class="dropdown">
          <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Post options">
            <i class="bi bi-three-dots" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><button class="dropdown-item" type="button"><i class="bi bi-bookmark me-2" aria-hidden="true"></i>Save post</button></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="dropdown-item text-danger" type="button"><i class="bi bi-flag me-2" aria-hidden="true"></i>Report</button></li>
          </ul>
        </div>
      </header>
      <p class="mb-0">First frost on the allotment. The kale survived, the basil did not.</p>
    </div>

    <a class="post-photo" href="#">
      <img src="{{ asset('assets/img/photo-6.svg') }}" alt="Frost covering allotment beds at dawn">
    </a>

    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between small text-secondary">
        <span>
          <span>57 likes</span>
        </span>
        <span><a class="link-muted" href="#">8 comments</a></span>
      </div>

      <hr class="my-2">

      @auth
        <div class="btn-group w-100 post-actions" role="group" aria-label="Post actions">
          <button class="btn" type="button"><i class="bi bi-hand-thumbs-up me-1" aria-hidden="true"></i>Like</button>
          <button class="btn" type="button"><i class="bi bi-chat me-1" aria-hidden="true"></i>Comment</button>
          <button class="btn" type="button"><i class="bi bi-share me-1" aria-hidden="true"></i>Share</button>
        </div>
      @endauth
    </div>
  </article>

  <p class="text-center text-secondary small py-2 mb-0">You're all caught up ✨</p>
</x-layouts.app>

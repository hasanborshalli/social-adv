<!-- ========== Left navigation rail ========== -->
<div class="col-lg-4 col-xl-3 d-none d-lg-block">
  <div class="sticky-rail pb-3">

    @auth
      <a class="d-flex align-items-center gap-2 text-decoration-none text-body p-2 rounded hover-surface" href="{{ route('profile') }}">
        <img class="avatar avatar-lg" src="{{ auth()->user()->profile_picture_url }}" alt="">
        <span class="min-w-0">
          <span class="d-block fw-semibold text-truncate">{{ auth()->user()->name }}</span>
          <small class="text-secondary">{{ auth()->user()->work ?? 'Member' }}</small>
        </span>
      </a>
    @else
      <div class="card border-0 bg-body-tertiary">
        <div class="card-body text-center">
          <p class="fw-semibold mb-1">You're not logged in</p>
          <p class="small text-secondary mb-3">Log in to see friends, messages and more.</p>
          <div class="d-grid gap-2">
            <a class="btn btn-primary" href="{{ route('login') }}">Log in</a>
            <a class="btn btn-light" href="{{ route('register') }}">Create an account</a>
          </div>
        </div>
      </div>
    @endauth

    <nav class="nav flex-column side-nav mt-2" aria-label="Sections">
      <a class="nav-link {{ request()->routeIs('feed') ? 'active' : '' }}" href="{{ route('feed') }}" @if (request()->routeIs('feed')) aria-current="page" @endif><i class="bi bi-house-door" aria-hidden="true"></i><span>Feed</span></a>
      @auth
        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}" @if (request()->routeIs('profile')) aria-current="page" @endif><i class="bi bi-person" aria-hidden="true"></i><span>Profile</span></a>
        <a class="nav-link {{ request()->routeIs('friends') ? 'active' : '' }}" href="{{ route('friends') }}" @if (request()->routeIs('friends')) aria-current="page" @endif><i class="bi bi-people" aria-hidden="true"></i><span>Friends</span><span class="badge rounded-pill text-bg-danger ms-auto">2<span class="visually-hidden"> new</span></span></a>
        <a class="nav-link {{ request()->routeIs('messages') ? 'active' : '' }}" href="{{ route('messages') }}" @if (request()->routeIs('messages')) aria-current="page" @endif><i class="bi bi-chat-dots" aria-hidden="true"></i><span>Messages</span><span class="badge rounded-pill text-bg-danger ms-auto">2<span class="visually-hidden"> new</span></span></a>
        <a class="nav-link {{ request()->routeIs('notifications') ? 'active' : '' }}" href="{{ route('notifications') }}" @if (request()->routeIs('notifications')) aria-current="page" @endif><i class="bi bi-bell" aria-hidden="true"></i><span>Notifications</span><span class="badge rounded-pill text-bg-danger ms-auto">3<span class="visually-hidden"> new</span></span></a>
        <a class="nav-link" href="{{ route('profile') }}#photos"><i class="bi bi-images" aria-hidden="true"></i><span>Photos</span></a>
        <a class="nav-link" href="#"><i class="bi bi-bookmark" aria-hidden="true"></i><span>Saved</span></a>
        <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}" href="{{ route('settings') }}" @if (request()->routeIs('settings')) aria-current="page" @endif><i class="bi bi-gear" aria-hidden="true"></i><span>Settings</span></a>
      @endauth
    </nav>

    @auth
      <button class="btn btn-primary w-100 mt-3" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
        <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Create post
      </button>
    @endauth

    <hr class="my-3">

    <x-footer />
  </div>
</div>

<!-- ===================== Mobile tab bar ===================== -->
<nav class="tab-bar d-lg-none" aria-label="Primary (compact)">
  <a class="tab-bar__item {{ request()->routeIs('feed') ? 'active' : '' }}" href="{{ route('feed') }}"><i class="bi bi-house-door" aria-hidden="true"></i><span>Feed</span></a>
  @auth
    <a class="tab-bar__item {{ request()->routeIs('friends') ? 'active' : '' }}" href="{{ route('friends') }}"><i class="bi bi-people" aria-hidden="true"></i><span>Friends</span></a>
    <button class="tab-bar__item border-0 bg-transparent" type="button" data-bs-toggle="modal" data-bs-target="#createPostModal">
      <i class="bi bi-plus-square text-brand" aria-hidden="true"></i><span>Post</span>
    </button>
    <a class="tab-bar__item {{ request()->routeIs('messages') ? 'active' : '' }}" href="{{ route('messages') }}"><i class="bi bi-chat-dots" aria-hidden="true"></i><span>Chats</span></a>
    <a class="tab-bar__item {{ request()->routeIs('notifications') ? 'active' : '' }}" href="{{ route('notifications') }}"><i class="bi bi-bell" aria-hidden="true"></i><span>Alerts</span></a>
  @else
    <a class="tab-bar__item" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i><span>Log in</span></a>
    <a class="tab-bar__item" href="{{ route('register') }}"><i class="bi bi-person-plus" aria-hidden="true"></i><span>Sign up</span></a>
  @endauth
</nav>

<x-modals.create-post />

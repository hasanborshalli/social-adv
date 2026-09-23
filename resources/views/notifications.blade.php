<x-layouts.app title="Notifications · YouBee Social">
  <x-slot:rail>
    <x-right-rail />
  </x-slot:rail>

  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <h1 class="h4 mb-0">Notifications</h1>
        <button class="btn btn-sm btn-light" type="button">
          <i class="bi bi-check2-all me-1" aria-hidden="true"></i>Mark all as read
        </button>
      </div>

      <ul class="nav nav-pills gap-2" aria-label="Filter notifications">
        <li class="nav-item"><a class="nav-link active" href="#" aria-current="page">All</a></li>
        <li class="nav-item"><a class="nav-link link-muted" href="#">Unread <span class="badge rounded-pill text-bg-danger">3</span></a></li>
        <li class="nav-item"><a class="nav-link link-muted" href="#">Requests</a></li>
      </ul>
    </div>
  </div>

  <!-- ===== New ===== -->
  <section class="card mb-3" aria-labelledby="newNotificationsHeading">
    <div class="card-body">
      <h2 class="h6 text-secondary mb-2" id="newNotificationsHeading">New</h2>
      <ul class="list-unstyled mb-0">

        <li class="notification-item notification-item--unread position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-4.svg') }}" alt="">
            <span class="notification-icon bg-primary"><i class="bi bi-person-plus-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none" href="{{ route('profile') }}">Ali Ayoub</a> sent you a friend request.</span>
            <small class="text-brand fw-semibold"><time datetime="2026-09-14T10:02">18 minutes ago</time></small>
            <span class="d-flex gap-2 mt-2">
              <button class="btn btn-sm btn-primary" type="button">Confirm</button>
              <button class="btn btn-sm btn-light" type="button">Delete</button>
            </span>
          </span>
        </li>

        <li class="notification-item notification-item--unread position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-2.svg') }}" alt="">
            <span class="notification-icon bg-primary"><i class="bi bi-hand-thumbs-up-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none stretched-link" href="#">Ali Nahleh</a> and <strong>14 others</strong> liked your post about type scales.</span>
            <small class="text-brand fw-semibold"><time datetime="2026-09-14T09:40">40 minutes ago</time></small>
          </span>
          <span class="unread-dot flex-shrink-0 align-self-center" aria-hidden="true"></span>
          <span class="visually-hidden">Unread</span>
        </li>

        <li class="notification-item notification-item--unread position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-3.svg') }}" alt="">
            <span class="notification-icon bg-success"><i class="bi bi-chat-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none stretched-link" href="#">Maysam Chaalan</a> commented: “That second shot is unreal. Which lens?”</span>
            <small class="text-brand fw-semibold"><time datetime="2026-09-14T09:05">1 hour ago</time></small>
          </span>
          <span class="unread-dot flex-shrink-0 align-self-center" aria-hidden="true"></span>
          <span class="visually-hidden">Unread</span>
        </li>

      </ul>
    </div>
  </section>

  <!-- ===== Earlier ===== -->
  <section class="card" aria-labelledby="earlierNotificationsHeading">
    <div class="card-body">
      <h2 class="h6 text-secondary mb-2" id="earlierNotificationsHeading">Earlier</h2>
      <ul class="list-unstyled mb-0">

        <li class="notification-item position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-8.svg') }}" alt="">
            <span class="notification-icon bg-danger"><i class="bi bi-heart-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none stretched-link" href="#">Haitham Ismail</a> liked your photo in <strong>Studio work</strong>.</span>
            <small class="text-secondary"><time datetime="2026-09-13T18:20">Yesterday at 18:20</time></small>
          </span>
        </li>

        <li class="notification-item position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-5.svg') }}" alt="">
            <span class="notification-icon bg-secondary"><i class="bi bi-share-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none stretched-link" href="#">Elie Amin</a> shared your post.</span>
            <small class="text-secondary"><time datetime="2026-09-13T11:05">Yesterday at 11:05</time></small>
          </span>
        </li>

        <li class="notification-item position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-7.svg') }}" alt="">
            <span class="notification-icon bg-primary"><i class="bi bi-people-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><a class="fw-semibold text-body text-decoration-none stretched-link" href="#">Elias Al Omar</a> accepted your friend request.</span>
            <small class="text-secondary"><time datetime="2026-09-12T16:40">2 days ago</time></small>
          </span>
        </li>

        <li class="notification-item position-relative align-items-center">
          <span class="position-relative flex-shrink-0">
            <img class="avatar avatar-lg" src="{{ asset('assets/img/avatar-2.svg') }}" alt="">
            <span class="notification-icon bg-warning"><i class="bi bi-gift-fill" aria-hidden="true"></i></span>
          </span>
          <span class="flex-grow-1 min-w-0">
            <span class="d-block"><strong>Ali Nahleh</strong> has a birthday today. Write on their timeline.</span>
            <small class="text-secondary"><time datetime="2026-09-12T07:00">2 days ago</time></small>
          </span>
        </li>

      </ul>

      <div class="text-center mt-3">
        <button class="btn btn-light" type="button">See previous notifications</button>
      </div>
    </div>
  </section>
</x-layouts.app>

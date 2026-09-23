<section class="card mb-3" aria-labelledby="suggestionsHeading">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h6 mb-0" id="suggestionsHeading">People you may know</h2>
      <a class="small link-muted" href="{{ route('friends') }}">See all</a>
    </div>
    <ul class="list-unstyled mb-0 vstack gap-3">
      <li class="d-flex align-items-center gap-2">
        <img class="avatar" src="{{ asset('assets/img/avatar-4.svg') }}" alt="">
        <div class="flex-grow-1 min-w-0">
          <p class="fw-semibold small mb-0 text-truncate">Ali Ayoub</p>
          <p class="mutuals mb-0 text-truncate">12 mutual friends</p>
        </div>
        @auth
          <button class="btn btn-sm btn-outline-primary" type="button" aria-label="Add Ali Ayoub as a friend">
            <i class="bi bi-person-plus" aria-hidden="true"></i>
          </button>
        @endauth
      </li>
      <li class="d-flex align-items-center gap-2">
        <img class="avatar" src="{{ asset('assets/img/avatar-5.svg') }}" alt="">
        <div class="flex-grow-1 min-w-0">
          <p class="fw-semibold small mb-0 text-truncate">Elie Amin</p>
          <p class="mutuals mb-0 text-truncate">5 mutual friends</p>
        </div>
        @auth
          <button class="btn btn-sm btn-outline-primary" type="button" aria-label="Add Elie Amin as a friend">
            <i class="bi bi-person-plus" aria-hidden="true"></i>
          </button>
        @endauth
      </li>
      <li class="d-flex align-items-center gap-2">
        <img class="avatar" src="{{ asset('assets/img/avatar-6.svg') }}" alt="">
        <div class="flex-grow-1 min-w-0">
          <p class="fw-semibold small mb-0 text-truncate">Baqer Alayyan</p>
          <p class="mutuals mb-0 text-truncate">3 mutual friends</p>
        </div>
        @auth
          <button class="btn btn-sm btn-outline-primary" type="button" aria-label="Add Baqer Alayyan as a friend">
            <i class="bi bi-person-plus" aria-hidden="true"></i>
          </button>
        @endauth
      </li>
    </ul>
  </div>
</section>

<section class="card mb-3" aria-labelledby="birthdaysHeading">
  <div class="card-body d-flex align-items-start gap-3">
    <i class="bi bi-gift fs-3 text-brand" aria-hidden="true"></i>
    <div>
      <h2 class="h6 mb-1" id="birthdaysHeading">Birthdays</h2>
      <p class="small text-secondary mb-0">
        <strong class="text-body">Ali Nahleh</strong> and
        <strong class="text-body">2 others</strong> have birthdays today.
      </p>
    </div>
  </div>
</section>

<section class="card" aria-labelledby="contactsHeading">
  <div class="card-body">
    <h2 class="h6 mb-3" id="contactsHeading">Contacts</h2>
    <ul class="list-unstyled mb-0 vstack gap-1">
      <li>
        <a class="d-flex align-items-center gap-2 p-1 rounded text-decoration-none text-body hover-surface" href="{{ route('messages') }}">
          <span class="presence presence--online"><img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-2.svg') }}" alt=""><span class="presence__dot"></span></span>
          <span class="small fw-medium">Ali Nahleh</span>
        </a>
      </li>
      <li>
        <a class="d-flex align-items-center gap-2 p-1 rounded text-decoration-none text-body hover-surface" href="{{ route('messages') }}">
          <span class="presence presence--online"><img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-3.svg') }}" alt=""><span class="presence__dot"></span></span>
          <span class="small fw-medium">Maysam Chaalan</span>
        </a>
      </li>
      <li>
        <a class="d-flex align-items-center gap-2 p-1 rounded text-decoration-none text-body hover-surface" href="{{ route('messages') }}">
          <span class="presence presence--away"><img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-7.svg') }}" alt=""><span class="presence__dot"></span></span>
          <span class="small fw-medium">Elias Al Omar</span>
        </a>
      </li>
      <li>
        <a class="d-flex align-items-center gap-2 p-1 rounded text-decoration-none text-body hover-surface" href="{{ route('messages') }}">
          <span class="presence"><img class="avatar avatar-sm" src="{{ asset('assets/img/avatar-8.svg') }}" alt=""><span class="presence__dot"></span></span>
          <span class="small fw-medium">Haitham Ismail</span>
        </a>
      </li>
    </ul>
  </div>
</section>

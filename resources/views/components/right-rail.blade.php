@auth
<section class="card mb-3" aria-labelledby="suggestionsHeading">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h6 mb-0" id="suggestionsHeading">People you may know</h2>
      <a class="small link-muted" href="{{ route('friends') }}">See all</a>
    </div>
    <ul class="list-unstyled mb-0 vstack gap-3">
      @forelse ($peopleYouMayKnow as $person)
        <li class="d-flex align-items-center gap-2">
          <img class="avatar" src="{{ $person->profile_picture_url }}" alt="">
          <div class="flex-grow-1 min-w-0">
            <a class="fw-semibold small mb-0 text-truncate d-block text-body text-decoration-none" href="{{ route('profile.show', $person) }}">{{ $person->name }}</a>
            @php($mutualCount = $mutualFriendsCount($person))
            <p class="mutuals mb-0 text-truncate">{{ $mutualCount }} {{ Str::plural('mutual friend', $mutualCount) }}</p>
          </div>
          <livewire:add-friend-simple :target="$person" :key="'suggestion-'.$person->id" />
        </li>
      @empty
        <li class="small text-secondary">No suggestions yet.</li>
      @endforelse
    </ul>
  </div>
</section>
@endauth

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

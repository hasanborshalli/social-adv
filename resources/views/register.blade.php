<x-layouts.guest title="Create account · YouBee Social">

  <div class="col-12 col-lg-6 text-center text-lg-start">
    <a class="d-inline-flex align-items-center gap-2 text-decoration-none mb-3" href="{{ route('feed') }}">
      <img src="{{ asset('assets/img/logo.svg') }}" alt="" width="52" height="52">
      <span class="auth-pitch__title">YouBee</span>
    </a>
    <div class="auth-pitch mx-auto mx-lg-0">
      <p class="fs-4 text-balance mb-0">
        Share what you're making, keep up with the people you like, and leave the noise behind.
      </p>
    </div>
  </div>

  <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
    <div class="card auth-card">
      <div class="card-body p-4 p-sm-5">
        <h1 class="h4 mb-1">Create an account</h1>
        <p class="text-secondary mb-4">It takes about a minute.</p>

        <form action="{{ route('register') }}" method="post" novalidate>
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label" for="regName">Full name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="regName" name="name"
                value="{{ old('name') }}" autocomplete="name" required>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12">
              <label class="form-label" for="regUsername">Username</label>
              <div class="input-group">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="regUsername"
                  name="username" value="{{ old('username') }}" pattern="[a-zA-Z0-9_.]{3,30}" autocomplete="username"
                  required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-text">Letters, numbers, dots and underscores. 3–30 characters.</div>
            </div>

            <div class="col-12">
              <label class="form-label" for="regEmail">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="regEmail" name="email"
                value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com" required>
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12">
              <label class="form-label" for="regPassword">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="regPassword"
                name="password" autocomplete="new-password" minlength="12" required>
              <div class="form-text">At least 12 characters.</div>
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12">
              <label class="form-label" for="regConfirm">Confirm password</label>
              <input type="password" class="form-control" id="regConfirm" name="password_confirmation"
                autocomplete="new-password" minlength="12" required>
            </div>

            <div class="col-12">
              <label class="form-label" for="regBirthday">Date of birth</label>
              <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="regBirthday"
                name="birthday" value="{{ old('birthday') }}" required>
              @error('birthday')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-check my-4">
            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="regTerms"
              name="terms" required>
            <label class="form-check-label" for="regTerms">
              I agree to the <a class="link-muted" href="#">Terms</a> and
              <a class="link-muted" href="#">Privacy Policy</a>.
            </label>
            @error('terms')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Create account</button>

          <p class="divider-text mb-3">already registered?</p>

          <a class="btn btn-light w-100 py-2" href="{{ route('login') }}">Log in instead</a>
        </form>
      </div>
    </div>
  </div>
</x-layouts.guest>
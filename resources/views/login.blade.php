<x-layouts.guest title="Log in · YouBee Social">

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
        <h1 class="h4 mb-1">Log in</h1>
        <p class="text-secondary mb-4">Welcome back. Pick up where you left off.</p>

        <form action="{{ route('login') }}" method="post" novalidate>
          <div class="mb-3">
            <label class="form-label" for="loginIdentifier">Email or username</label>
            <input type="text" class="form-control @error('identifier') is-invalid @enderror" id="loginIdentifier"
              name="identifier" value="{{ old('identifier') }}" autocomplete="username" placeholder="you@example.com"
              required>
            @error('identifier')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-baseline">
              <label class="form-label" for="loginPassword">Password</label>
              <a class="small link-muted" href="#">Forgot password?</a>
            </div>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword"
              name="password" autocomplete="current-password" minlength="12" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="loginRemember" name="remember" @checked(old('remember',
              true))>
            <label class="form-check-label" for="loginRemember">Keep me logged in</label>
          </div>

          <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Log in</button>

          <p class="divider-text mb-3">new here?</p>

          <a class="btn btn-light w-100 py-2" href="{{ route('register') }}">Create an account</a>
        </form>
      </div>
    </div>
  </div>
</x-layouts.guest>
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
    <livewire:register />
  </div>
</x-layouts.guest>
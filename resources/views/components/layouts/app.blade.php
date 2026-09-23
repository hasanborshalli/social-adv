<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#d97706">
  <title>{{ $title ?? 'YouBee Social' }}</title>

  <link rel="icon" href="{{ asset('assets/img/logo.svg') }}" type="image/svg+xml">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-XGjxtQfXaH2tnPFa9x+ruJTuLE3Aa6LhHSWRr1XeTyhezb4abCG4ccI5AkVDxqC+" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <a class="visually-hidden-focusable btn btn-primary position-absolute top-0 start-0 m-2 z-3" href="#main">Skip to main content</a>

  <x-navbar />

  <div class="container-xxl app-shell">
    <div class="row g-3">
      <x-sidebar />

      <main class="col-12 col-lg-8 {{ isset($rail) ? 'col-xl-6' : 'col-xl-9' }}" id="main">
        {{ $slot }}
      </main>

      @isset($rail)
        <div class="col-xl-3 d-none d-xl-block">
          <div class="sticky-rail pb-3">
            {{ $rail }}
          </div>
        </div>
      @endisset
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/media-preview.js') }}"></script>
</body>

</html>

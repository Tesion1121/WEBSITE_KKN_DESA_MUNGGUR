<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Desa Munggur - Kecamatan Andong, Kabupaten Boyolali')</title>
  <meta name="description" content="@yield('description', 'Website resmi Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  @hasSection('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}" />
  @endif
  @yield('head')
</head>
<body>

  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="{{ asset('assets/js/main.js') }}"></script>
  @yield('scripts')
</body>
</html>

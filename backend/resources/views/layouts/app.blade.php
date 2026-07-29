<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Desa Munggur - Kecamatan Andong, Kabupaten Boyolali')</title>
  <meta name="description" content="Website Resmi Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Pusat informasi profil desa, pemerintahan, layanan publik, potensi desa, dan UMKM warga.">
  <meta name="keywords" content="Desa Munggur, Munggur Boyolali, Andong Boyolali, Profil Desa Munggur, UMKM Desa Munggur">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://desamunggur.web.id/">
  <meta name="google-site-verification" content="x_1aYo_FB6v1jaUQgdWIlGfcgHaeYc881eB62CAr-X4" />

  <meta property="og:title" content="Website Resmi Desa Munggur - Kabupaten Boyolali">
  <meta property="og:description" content="Pusat informasi resmi dan pelayanan Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.">
  <meta property="og:image" content="{{ asset('assets/images/boyolali-logo.svg') }}">
  <meta property="og:url" content="https://desamunggur.web.id/">
  <meta property="og:type" content="website">

  <!-- <meta name="google-site-verification" content="GANTI_DENGAN_KODE_VERIFIKASI_GSC" /> -->

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

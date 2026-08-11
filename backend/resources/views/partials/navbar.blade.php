<!-- ===================== HEADER / NAVBAR ===================== -->
<header class="navbar" id="main-navbar">
  <div class="navbar-inner">
    <a href="{{ url('/') }}" class="navbar-brand" id="navbar-brand-link">
      <img src="{{ asset('assets/images/boyolali-logo.svg') }}" alt="Logo Kabupaten Boyolali" class="navbar-logo" id="navbar-logo-img" />
      <div class="navbar-title">
        <span class="navbar-desa">Desa Munggur</span>
        <span class="navbar-kabupaten">Kabupaten Boyolali</span>
      </div>
    </a>
    <nav class="navbar-nav" id="main-nav">
      <a href="{{ url('/') }}" class="nav-link @if(request()->is('/')) active @endif" id="nav-home">Beranda</a>
      <a href="{{ url('/berita') }}" class="nav-link @if(request()->is('berita*')) active @endif" id="nav-berita">Berita</a>

      <!-- Pemerintahan & Layanan -->
      <div class="nav-dropdown">
        <button class="nav-dropdown-toggle">
          Pemerintahan & Layanan
          <span class="nav-dropdown-chevron"></span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/profil-desa') }}" class="nav-dropdown-item @if(request()->is('profil-desa')) active @endif">Profil Desa</a>
          <a href="{{ url('/struktur-desa') }}" class="nav-dropdown-item @if(request()->is('struktur-desa')) active @endif">Struktur Desa</a>
          <a href="{{ url('/potensi-desa') }}" class="nav-dropdown-item @if(request()->is('potensi-desa')) active @endif">Potensi Desa</a>
          <a href="{{ url('/peta-desa') }}" class="nav-dropdown-item @if(request()->is('peta-desa')) active @endif">Peta Desa</a>
          <a href="{{ url('/landasan-hukum') }}" class="nav-dropdown-item @if(request()->is('landasan-hukum')) active @endif">Landasan Hukum</a>
        </div>
      </div>

      <!-- Fasilitas & Kesehatan -->
      <div class="nav-dropdown">
        <button class="nav-dropdown-toggle">
          Fasilitas & Kesehatan
          <span class="nav-dropdown-chevron"></span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/alat-pertanian') }}" class="nav-dropdown-item @if(request()->is('alat-pertanian')) active @endif">Alat Pertanian</a>
          <a href="{{ url('/kesehatan') }}" class="nav-dropdown-item @if(request()->is('kesehatan')) active @endif">Kesehatan</a>
          <a href="{{ url('/keuangan') }}" class="nav-dropdown-item @if(request()->is('keuangan')) active @endif">Keuangan Desa</a>
        </div>
      </div>

      <!-- Pemberdayaan & UMKM -->
      <div class="nav-dropdown">
        <button class="nav-dropdown-toggle">
          Pemberdayaan & UMKM
          <span class="nav-dropdown-chevron"></span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/umkm') }}" class="nav-dropdown-item @if(request()->is('umkm')) active @endif">UMKM</a>
          <a href="{{ url('/kebudayaan-kuliner') }}" class="nav-dropdown-item @if(request()->is('kebudayaan-kuliner')) active @endif">Wisata & Budaya</a>
          <a href="{{ url('/komoditas') }}" class="nav-dropdown-item @if(request()->is('komoditas')) active @endif">Komoditas</a>
        </div>
      </div>
    </nav>
    <div class="navbar-actions">
      <button class="hamburger" id="hamburger-btn" aria-label="Toggle Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  @include('partials.mobile-menu')
</header>

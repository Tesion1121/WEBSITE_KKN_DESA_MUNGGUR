@extends('layouts.app')

@section('title', 'Desa Munggur - Profil Desa | Kecamatan Andong, Kabupaten Boyolali')
@section('description', 'Website resmi Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Sistem Informasi Profil Desa yang menyajikan data dan informasi lengkap tentang Desa Munggur.')

@section('content')
    <!-- ===================== HERO SLIDER ===================== -->
    <section class="hero-slider" id="hero-section">
      <div class="slider-wrapper" id="slider-wrapper">
        <div class="slide active" id="slide-1" style="background-image: url('{{ asset('assets/images/1.jpeg') }}')">
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <h1 class="slide-title">Selamat Datang Di Desa Munggur</h1>
            <p class="slide-subtitle">Sistem informasi profil desa</p>
          </div>
        </div>
        <div class="slide" id="slide-2" style="background-image: url('{{ asset('assets/images/2.jpeg') }}')">
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <h1 class="slide-title">Selamat Datang Di Desa Munggur</h1>
            <p class="slide-subtitle">Sistem informasi profil desa</p>
          </div>
        </div>
        <div class="slide" id="slide-3" style="background-image: url('{{ asset('assets/images/3.jpeg') }}')">
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <h1 class="slide-title">Selamat Datang Di Desa Munggur</h1>
            <p class="slide-subtitle">Sistem informasi profil desa</p>
          </div>
        </div>
        <div class="slide" id="slide-4" style="background-image: url('{{ asset('assets/images/4.jpeg') }}')">
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <h1 class="slide-title">Selamat Datang Di Desa Munggur</h1>
            <p class="slide-subtitle">Sistem informasi profil desa</p>
          </div>
        </div>
        <div class="slide" id="slide-5" style="background-image: url('{{ asset('assets/images/5.jpeg') }}')">
          <div class="slide-overlay"></div>
          <div class="slide-content">
            <h1 class="slide-title">Selamat Datang Di Desa Munggur</h1>
            <p class="slide-subtitle">Sistem informasi profil desa</p>
          </div>
        </div>
      </div>
      <!-- Prev / Next arrows -->
      <button class="slider-arrow slider-prev" id="slider-prev" aria-label="Slide Sebelumnya">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>
      <button class="slider-arrow slider-next" id="slider-next" aria-label="Slide Berikutnya">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>
      <!-- Dot indicators -->
      <div class="slider-dots" id="slider-dots">
        <button class="dot active" id="dot-0" aria-label="Slide 1"></button>
        <button class="dot" id="dot-1" aria-label="Slide 2"></button>
        <button class="dot" id="dot-2" aria-label="Slide 3"></button>
        <button class="dot" id="dot-3" aria-label="Slide 4"></button>
        <button class="dot" id="dot-4" aria-label="Slide 5"></button>
      </div>
    </section>

    <!-- ===================== CATEGORIES SECTION ===================== -->
    <section class="categories-section" id="categories-section">
      <div class="container">
        <div class="categories-header">
          <div class="section-title-group">
            <span class="section-accent"></span>
            <h2 class="section-title" id="categories-title">Categories</h2>
          </div>
          <div class="categories-nav-btns">
            <button class="cat-nav-btn" id="cat-prev-btn" aria-label="Geser Kiri">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button class="cat-nav-btn" id="cat-next-btn" aria-label="Geser Kanan">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
          </div>
        </div>

        <div class="categories-grid" id="categories-grid">
          <a href="{{ url('/profil-desa') }}" class="category-card" id="cat-profil-desa">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/profil-desa.png') }}" alt="Profil Desa" class="category-icon" />
            </div>
            <span class="category-label">Profil Desa</span>
          </a>
          <a href="{{ url('/struktur-desa') }}" class="category-card" id="cat-struktur-desa">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/struktur-desa.png') }}" alt="Struktur Desa" class="category-icon" />
            </div>
            <span class="category-label">Struktur Desa</span>
          </a>
          <a href="{{ url('/potensi-desa') }}" class="category-card" id="cat-potensi-desa">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/potensi-desa.png') }}" alt="Potensi Desa" class="category-icon" />
            </div>
            <span class="category-label">Potensi Desa</span>
          </a>
          <a href="{{ url('/peta-desa') }}" class="category-card" id="cat-peta-desa">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/peta-desa.png') }}" alt="Peta Desa" class="category-icon" />
            </div>
            <span class="category-label">Peta Desa</span>
          </a>
          <a href="{{ url('/umkm') }}" class="category-card" id="cat-umkm">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/umkm.png') }}" alt="UMKM" class="category-icon" />
            </div>
            <span class="category-label">UMKM</span>
          </a>
          <a href="{{ url('/kebudayaan-kuliner') }}" class="category-card" id="cat-kebudayaan-kuliner">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/kebudayaan-kuliner.png') }}" alt="Wisata & Budaya" class="category-icon" />
            </div>
            <span class="category-label">Wisata & Budaya</span>
          </a>
          <a href="{{ url('/komoditas') }}" class="category-card" id="cat-komoditas">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/komoditas.png') }}" alt="Komoditas" class="category-icon" />
            </div>
            <span class="category-label">Komoditas</span>
          </a>
          <a href="{{ url('/landasan-hukum') }}" class="category-card" id="cat-landasan-hukum">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/landasan-hukum.png') }}" alt="Landasan Hukum" class="category-icon" />
            </div>
            <span class="category-label">Landasan Hukum</span>
          </a>
          <a href="{{ url('/kesehatan') }}" class="category-card" id="cat-kesehatan">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/kesehatan.png') }}" alt="Kesehatan" class="category-icon" />
            </div>
            <span class="category-label">Kesehatan</span>
          </a>
          <a href="{{ url('/keuangan') }}" class="category-card" id="cat-keuangan">
            <div class="category-icon-wrap">
              <img src="{{ asset('assets/icons/keuangan.png') }}" alt="Keuangan" class="category-icon" />
            </div>
            <span class="category-label">Keuangan</span>
          </a>

        </div>
      </div>
    </section>

    <!-- ===================== PROFIL DESA SECTION ===================== -->
    <section class="profil-section" id="profil-section">
      <div class="container">
        <div class="profil-header">
          <div class="profil-icon-title">
            <svg class="profil-section-icon" viewBox="0 0 48 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M24 2L44 16V38H4V16L24 2Z" stroke="#1a1a1a" stroke-width="2" stroke-linejoin="round"/>
              <path d="M14 38V24H34V38" stroke="#1a1a1a" stroke-width="2"/>
              <path d="M19 38V30H29V38" stroke="#1a1a1a" stroke-width="2"/>
              <path d="M4 16L24 2L44 16" stroke="#1a1a1a" stroke-width="2"/>
              <line x1="0" y1="16" x2="8" y2="16" stroke="#1a1a1a" stroke-width="2"/>
              <line x1="40" y1="16" x2="48" y2="16" stroke="#1a1a1a" stroke-width="2"/>
            </svg>
            <div>
              <h2 class="profil-main-title">Profil Desa Munggur</h2>
              <span class="profil-sub-location">Kecamatan Andong, Kabupaten Boyolali</span>
            </div>
          </div>
        </div>

        <div class="profil-content">
          <p class="profil-intro">
            Selamat datang di laman resmi Desa Munggur. Kami adalah desa yang mengutamakan kebersamaan, gotong royong, dan kemandirian yang berakar kuat pada sektor pertanian sebagai urat nadi kehidupan masyarakat kami.
          </p>

          <h3 class="profil-subtitle">Sekilas Desa Munggur</h3>
          <p class="profil-text">
            Meskipun tercatat sebagai desa dengan wilayah terkecil di Kecamatan Andong, Desa Munggur memiliki semangat dan potensi yang luar biasa. Desa kami dihuni oleh sekitar 2.700 jiwa yang terbagi dalam 700 Kartu Keluarga (KK). Secara administratif, untuk memastikan pelayanan publik berjalan dengan prima dan menyentuh seluruh lapisan masyarakat, wilayah Desa Munggur terbagi menjadi:
          </p>

          <ul class="profil-list">
            <li>6 Dukuh</li>
            <li>3 Rukun Warga (RW)</li>
            <li>15 Rukun Tetangga (RT)</li>
          </ul>

          <p class="profil-text">
            Mayoritas penduduk Desa Munggur memeluk agama Islam, di mana nilai-nilai keagamaan dan toleransi senantiasa melandasi hubungan sosial antarwarga dalam kehidupan sehari-hari.
          </p>

          <div class="profil-stats-row">
            <div class="stat-card" id="stat-penduduk">
              <span class="stat-number">2.700</span>
              <span class="stat-label">Jiwa</span>
            </div>
            <div class="stat-card" id="stat-kk">
              <span class="stat-number">700</span>
              <span class="stat-label">Kartu Keluarga</span>
            </div>
            <div class="stat-card" id="stat-dukuh">
              <span class="stat-number">6</span>
              <span class="stat-label">Dukuh</span>
            </div>
            <div class="stat-card" id="stat-rw">
              <span class="stat-number">3</span>
              <span class="stat-label">Rukun Warga</span>
            </div>
            <div class="stat-card" id="stat-rt">
              <span class="stat-number">15</span>
              <span class="stat-label">Rukun Tetangga</span>
            </div>
          </div>

          <div class="profil-cta">
            <a href="{{ url('/profil-desa') }}" class="btn-primary" id="btn-selengkapnya">Selengkapnya →</a>
          </div>
        </div>
      </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Berita & Informasi - Desa Munggur')
@section('description', 'Kumpulan berita, kabar terkini, pengumuman, dan liputan kegiatan resmi Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  /* ============================================================
     HERO & SEARCH SECTION
     ============================================================ */
  .berita-hero {
    background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
    color: #fff;
    padding: 56px 0 64px;
    position: relative;
    overflow: hidden;
  }
  .berita-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(82, 183, 136, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .berita-hero-inner {
    position: relative;
    z-index: 2;
    max-width: 800px;
  }

  .breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 20px;
    font-weight: 500;
  }
  .breadcrumb-nav a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    transition: color 0.2s;
  }
  .breadcrumb-nav a:hover {
    color: #fff;
    text-decoration: underline;
  }
  .breadcrumb-nav span.current {
    color: #b7e4c7;
    font-weight: 600;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #b7e4c7;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 16px;
  }
  .hero-title {
    font-size: clamp(2rem, 5vw, 2.75rem);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -0.025em;
    margin: 0 0 14px;
  }
  .hero-subtitle {
    font-size: 1.025rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.65;
    margin: 0 0 32px;
    max-width: 640px;
  }

  /* Search Bar */
  .search-box-wrap {
    display: flex;
    align-items: center;
    background: #ffffff;
    border-radius: 14px;
    padding: 6px 8px 6px 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    max-width: 580px;
  }
  .search-box-wrap svg {
    color: #6c757d;
    flex-shrink: 0;
    margin-right: 12px;
  }
  .search-input {
    border: none;
    outline: none;
    font-family: inherit;
    font-size: 0.95rem;
    color: #1a1a1a;
    width: 100%;
    background: transparent;
  }
  .search-input::placeholder {
    color: #9ca3af;
  }
  .search-clear-btn {
    background: #f3f4f6;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #4b5563;
    cursor: pointer;
    display: none;
    transition: all 0.2s;
    white-space: nowrap;
  }
  .search-clear-btn:hover {
    background: #e5e7eb;
    color: #111;
  }

  /* ============================================================
     MAIN CONTENT & CARDS
     ============================================================ */
  .berita-main {
    padding: 56px 0 88px;
    background: #f8fafc;
    min-height: 60vh;
  }

  /* Section Heading */
  .content-header-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
  }
  .section-headline {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.015em;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
  }
  .section-headline::before {
    content: '';
    display: inline-block;
    width: 5px;
    height: 22px;
    background: #2d6a4f;
    border-radius: 4px;
  }

  .results-count {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 500;
  }

  /* Featured Article (Card Besar Teratas) */
  .featured-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 20px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1.15fr 1fr;
    margin-bottom: 40px;
    text-decoration: none;
    color: inherit;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
  }
  .featured-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(45, 106, 79, 0.12);
    border-color: #2d6a4f;
  }
  .featured-img-wrap {
    position: relative;
    min-height: 320px;
    background: #f1f5f9;
    overflow: hidden;
  }
  .featured-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }
  .featured-card:hover .featured-img {
    transform: scale(1.04);
  }
  .featured-body {
    padding: 36px 32px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 14px;
  }
  .featured-badge-row {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .badge-featured {
    background: #2d6a4f;
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }
  .badge-readtime {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .featured-title {
    font-size: clamp(1.3rem, 2.5vw, 1.75rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
    letter-spacing: -0.02em;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .featured-desc {
    font-size: 0.95rem;
    color: #475569;
    line-height: 1.7;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .featured-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
    flex-wrap: wrap;
    gap: 12px;
  }
  .meta-author-group {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .author-avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #2d6a4f;
    font-weight: 700;
    font-size: 0.78rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #cbd5e1;
  }
  .author-name-text {
    font-size: 0.82rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
  }
  .author-date-text {
    font-size: 0.72rem;
    color: #64748b;
    margin: 0;
  }
  .featured-read-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2d6a4f;
  }
  .featured-read-link svg {
    transition: transform 0.2s ease;
  }
  .featured-card:hover .featured-read-link svg {
    transform: translateX(5px);
  }

  /* Regular Grid */
  .berita-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
  }

  .berita-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
  }
  .berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 34px rgba(45, 106, 79, 0.1);
    border-color: #2d6a4f;
  }

  .berita-card-img-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #f1f5f9;
    overflow: hidden;
    flex-shrink: 0;
  }
  .berita-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.35s ease;
  }
  .berita-card:hover .berita-card-img {
    transform: scale(1.05);
  }
  .berita-card-no-img {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
  }

  .berita-card-body {
    padding: 22px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 10px;
  }

  .berita-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }
  .berita-badge {
    display: inline-block;
    background: rgba(45, 106, 79, 0.09);
    color: #2d6a4f;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .berita-date {
    font-size: 0.75rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
    font-weight: 500;
  }

  .berita-card-title {
    font-size: 1.08rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    letter-spacing: -0.015em;
    margin: 0;
  }
  .berita-card-ringkasan {
    font-size: 0.86rem;
    color: #475569;
    line-height: 1.65;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
    margin: 0;
  }
  .berita-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    margin-top: 6px;
    border-top: 1px solid #f1f5f9;
  }
  .card-author-name {
    font-size: 0.75rem;
    color: #64748b;
    font-weight: 500;
    max-width: 140px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .card-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    font-weight: 700;
    color: #2d6a4f;
  }
  .card-read-btn svg {
    transition: transform 0.2s ease;
  }
  .berita-card:hover .card-read-btn svg {
    transform: translateX(4px);
  }

  /* Skeleton Loading */
  .skeleton {
    background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
    background-size: 200% 100%;
    animation: shimmer 1.4s infinite;
    border-radius: 8px;
  }
  @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

  .skeleton-card {
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
  }
  .skeleton-img { width: 100%; aspect-ratio: 16 / 9; border-radius: 0; }
  .skeleton-body { padding: 22px 20px; display: flex; flex-direction: column; gap: 12px; }
  .skeleton-line { height: 14px; }
  .skeleton-line.short { width: 40%; }
  .skeleton-line.medium { width: 75%; }
  .skeleton-line.full { width: 100%; }

  /* Pagination */
  .pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 56px;
    flex-wrap: wrap;
  }
  .page-btn {
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    border: 1.5px solid #cbd5e1;
    background: #fff;
    border-radius: 10px;
    font-size: 0.88rem;
    font-weight: 700;
    color: #334155;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    font-family: inherit;
  }
  .page-btn:hover:not(:disabled) {
    border-color: #2d6a4f;
    color: #2d6a4f;
    background: rgba(45, 106, 79, 0.06);
    transform: translateY(-1px);
  }
  .page-btn.active {
    background: #2d6a4f;
    border-color: #2d6a4f;
    color: #fff;
    box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
  }
  .page-btn:disabled {
    opacity: 0.35;
    cursor: not-allowed;
  }
  .page-info {
    font-size: 0.84rem;
    color: #64748b;
    text-align: center;
    margin-top: 14px;
    font-weight: 500;
  }

  /* Empty State */
  .empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 72px 24px;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 20px;
    margin: 20px 0;
  }
  .empty-state svg {
    color: #94a3b8;
    margin-bottom: 16px;
  }
  .empty-state p {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 6px;
  }
  .empty-state span {
    font-size: 0.88rem;
    color: #64748b;
  }
  .btn-reset-search {
    margin-top: 18px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 18px;
    background: #2d6a4f;
    color: #fff;
    border: none;
    border-radius: 9px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }
  .btn-reset-search:hover {
    background: #1b4332;
  }

  @media (max-width: 900px) {
    .featured-card {
      grid-template-columns: 1fr;
    }
    .featured-img-wrap {
      min-height: 240px;
    }
    .featured-body {
      padding: 24px 20px;
    }
  }

  @media (max-width: 640px) {
    .berita-hero {
      padding: 40px 0 48px;
    }
    .berita-main {
      padding: 36px 0 64px;
    }
    .berita-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }
</style>
@endsection

@section('content')

  <!-- HERO SECTION -->
  <section class="berita-hero">
    <div class="container">
      <div class="berita-hero-inner">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav">
          <a href="{{ url('/') }}">Beranda</a>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
          <span class="current">Berita & Informasi</span>
        </nav>

        <div class="hero-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Kabar Desa Terkini
        </div>

        <h1 class="hero-title">Pusat Kabar & Publikasi Desa Munggur</h1>
        <p class="hero-subtitle">
          Dapatkan liputan kegiatan warga, pembangunan desa, pengumuman pemerintahan, serta informasi penting lainnya langsung dari sumber resmi.
        </p>

        <!-- Search Bar -->
        <div class="search-box-wrap">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input 
            type="text" 
            id="search-input" 
            class="search-input" 
            placeholder="Cari judul berita atau topik..." 
            autocomplete="off"
            oninput="handleSearch(this.value)"
          />
          <button id="search-clear-btn" class="search-clear-btn" onclick="clearSearch()">Hapus</button>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT SECTION -->
  <section class="berita-main">
    <div class="container">
      
      <div class="content-header-bar">
        <h2 class="section-headline" id="section-headline">Semua Berita</h2>
        <span class="results-count" id="results-count">Memuat berita...</span>
      </div>

      <!-- Featured Area (Populated on page 1 without search) -->
      <div id="featured-wrap"></div>

      <!-- Regular News Grid -->
      <div class="berita-grid" id="berita-grid">
        <!-- Rendered via JS -->
      </div>

      <!-- Pagination -->
      <div class="pagination-wrap" id="pagination-wrap" style="display:none;"></div>
      <div class="page-info" id="page-info" style="display:none;"></div>

    </div>
  </section>

@endsection

@section('scripts')
<script>
  let currentPage = 1;
  let totalPages = 1;
  let allRawNews = [];
  let currentSearchQuery = '';

  function formatTanggal(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
  }

  function estimateReadingTime(text) {
    if (!text) return '1 mnt baca';
    const words = text.trim().split(/\s+/).length;
    const minutes = Math.ceil(words / 180);
    return `${minutes} mnt baca`;
  }

  function getAuthorInitial(name) {
    if (!name) return 'DM';
    const parts = name.trim().split(' ');
    if (parts.length >= 2) {
      return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return name.substring(0, 2).toUpperCase();
  }

  function renderSkeletons() {
    const grid = document.getElementById('berita-grid');
    const featuredWrap = document.getElementById('featured-wrap');
    featuredWrap.innerHTML = '';
    
    let html = '';
    for (let i = 0; i < 6; i++) {
      html += `
        <div class="skeleton-card">
          <div class="skeleton skeleton-img"></div>
          <div class="skeleton-body">
            <div class="skeleton skeleton-line short"></div>
            <div class="skeleton skeleton-line full" style="height:18px;"></div>
            <div class="skeleton skeleton-line medium"></div>
            <div class="skeleton skeleton-line full" style="margin-top:8px;"></div>
          </div>
        </div>`;
    }
    grid.innerHTML = html;
  }

  function loadBerita(page = 1) {
    renderSkeletons();
    const paginationWrap = document.getElementById('pagination-wrap');
    const pageInfo = document.getElementById('page-info');
    paginationWrap.style.display = 'none';
    pageInfo.style.display = 'none';

    fetch(`/api/berita?page=${page}`, { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error(`Server error ${res.status}`);
        return res.json();
      })
      .then(resp => {
        const data = resp.data || [];
        allRawNews = data;
        currentPage = resp.current_page || 1;
        totalPages = resp.last_page || 1;

        renderNewsView(data, resp.total, resp.from, resp.to);
      })
      .catch(err => {
        console.error('Gagal memuat berita:', err);
        document.getElementById('featured-wrap').innerHTML = '';
        document.getElementById('results-count').textContent = '0 berita';
        document.getElementById('berita-grid').innerHTML = `
          <div class="empty-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="12"></line>
              <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <p>Gagal memuat data berita</p>
            <span>Silakan periksa koneksi atau muat ulang halaman.</span>
            <div><button class="btn-reset-search" onclick="loadBerita(1)">Coba Lagi</button></div>
          </div>`;
      });
  }

  function renderNewsView(items, totalCount = null, from = null, to = null) {
    const grid = document.getElementById('berita-grid');
    const featuredWrap = document.getElementById('featured-wrap');
    const resultsCountEl = document.getElementById('results-count');

    featuredWrap.innerHTML = '';
    grid.innerHTML = '';

    if (items.length === 0) {
      resultsCountEl.textContent = '0 berita';
      grid.innerHTML = `
        <div class="empty-state">
          <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
            <path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6z"></path>
          </svg>
          <p>${currentSearchQuery ? `Tidak ada berita cocok dengan "${currentSearchQuery}"` : 'Belum ada berita yang dipublikasikan'}</p>
          <span>${currentSearchQuery ? 'Coba gunakan kata kunci lain.' : 'Pantau terus halaman ini untuk informasi terbaru.'}</span>
          ${currentSearchQuery ? `<div><button class="btn-reset-search" onclick="clearSearch()">Lihat Semua Berita</button></div>` : ''}
        </div>`;
      return;
    }

    resultsCountEl.textContent = totalCount ? `Menampilkan ${totalCount} berita` : `${items.length} berita ditemukan`;

    // Tampilkan Featured Card jika:
    // 1. Halaman 1
    // 2. Tidak sedang mencari kata kunci
    // 3. Jumlah item >= 1
    let startIndex = 0;
    if (currentPage === 1 && !currentSearchQuery && items.length > 0) {
      const feat = items[0];
      startIndex = 1;
      const featTanggal = formatTanggal(feat.tanggal_terbit);
      const featReadTime = estimateReadingTime((feat.ringkasan || '') + ' ' + (feat.isi || ''));
      const featAuthor = feat.penulis || 'Pemerintah Desa';
      const featInitial = getAuthorInitial(featAuthor);

      const featImgHtml = feat.image_url
        ? `<img src="${feat.image_url}" alt="${feat.judul}" class="featured-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" /><div class="berita-card-no-img" style="display:none;"><svg width="56" height="56" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 9 4-4 4 4 4-4 4 4"/><circle cx="8.5" cy="13.5" r="1.5"/></svg></div>`
        : `<div class="berita-card-no-img"><svg width="56" height="56" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6z"></path></svg></div>`;

      featuredWrap.innerHTML = `
        <a href="/berita/${feat.slug}" class="featured-card">
          <div class="featured-img-wrap">${featImgHtml}</div>
          <div class="featured-body">
            <div class="featured-badge-row">
              <span class="badge-featured">Berita Utama</span>
              <span class="badge-readtime">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ${featReadTime}
              </span>
            </div>
            <h3 class="featured-title">${feat.judul}</h3>
            <p class="featured-desc">${feat.ringkasan || (feat.isi ? feat.isi.substring(0, 180) + '...' : '')}</p>
            <div class="featured-footer">
              <div class="meta-author-group">
                <div class="author-avatar-sm">${featInitial}</div>
                <div>
                  <p class="author-name-text">${featAuthor}</p>
                  <p class="author-date-text">${featTanggal}</p>
                </div>
              </div>
              <span class="featured-read-link">
                Baca Lengkap
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
              </span>
            </div>
          </div>
        </a>
      `;
    }

    // Render Grid Regular
    let gridHtml = '';
    const gridItems = items.slice(startIndex);
    
    gridItems.forEach(item => {
      const tanggal = formatTanggal(item.tanggal_terbit);
      const readTime = estimateReadingTime((item.ringkasan || '') + ' ' + (item.isi || ''));
      const author = item.penulis || 'Admin Desa';

      const imgHtml = item.image_url
        ? `<img src="${item.image_url}" alt="${item.judul}" class="berita-card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" /><div class="berita-card-no-img" style="display:none"><svg width="44" height="44" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 9 4-4 4 4 4-4 4 4"/><circle cx="8.5" cy="13.5" r="1.5"/></svg></div>`
        : `<div class="berita-card-no-img"><svg width="44" height="44" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6z"></path></svg></div>`;

      gridHtml += `
        <a href="/berita/${item.slug}" class="berita-card">
          <div class="berita-card-img-wrap">${imgHtml}</div>
          <div class="berita-card-body">
            <div class="berita-card-meta">
              <span class="berita-badge">Kabar Desa</span>
              ${tanggal ? `<span class="berita-date"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>${tanggal}</span>` : ''}
            </div>
            <h3 class="berita-card-title">${item.judul}</h3>
            <p class="berita-card-ringkasan">${item.ringkasan || (item.isi ? item.isi.substring(0, 120) + '...' : '')}</p>
            <div class="berita-card-footer">
              <span class="card-author-name">✍️ ${author}</span>
              <span class="card-read-btn">
                Baca
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
              </span>
            </div>
          </div>
        </a>
      `;
    });

    grid.innerHTML = gridHtml;

    // Render Pagination (hanya saat tidak dalam pencarian)
    if (!currentSearchQuery && totalPages > 1) {
      renderPagination(currentPage, totalPages, from, to, totalCount);
    }
  }

  function renderPagination(current, total, from, to, totalItems) {
    const wrap = document.getElementById('pagination-wrap');
    const info = document.getElementById('page-info');

    let html = '';

    // Prev button
    html += `<button class="page-btn" onclick="goToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''} aria-label="Halaman sebelumnya">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
    </button>`;

    // Page numbers
    const range = [];
    for (let i = Math.max(1, current - 2); i <= Math.min(total, current + 2); i++) {
      range.push(i);
    }
    if (range[0] > 1) {
      html += `<button class="page-btn" onclick="goToPage(1)">1</button>`;
      if (range[0] > 2) html += `<span style="color:#94a3b8;padding:0 4px;">…</span>`;
    }
    range.forEach(p => {
      html += `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
    });
    if (range[range.length - 1] < total) {
      if (range[range.length - 1] < total - 1) html += `<span style="color:#94a3b8;padding:0 4px;">…</span>`;
      html += `<button class="page-btn" onclick="goToPage(${total})">${total}</button>`;
    }

    // Next button
    html += `<button class="page-btn" onclick="goToPage(${current + 1})" ${current >= total ? 'disabled' : ''} aria-label="Halaman selanjutnya">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
    </button>`;

    wrap.innerHTML = html;
    wrap.style.display = 'flex';

    if (from && to && totalItems) {
      info.textContent = `Menampilkan ${from}–${to} dari ${totalItems} berita`;
      info.style.display = 'block';
    }
  }

  function goToPage(page) {
    if (page < 1 || page > totalPages) return;
    loadBerita(page);
    window.scrollTo({ top: 380, behavior: 'smooth' });
  }

  function handleSearch(query) {
    currentSearchQuery = query.trim().toLowerCase();
    const clearBtn = document.getElementById('search-clear-btn');
    const headline = document.getElementById('section-headline');
    const paginationWrap = document.getElementById('pagination-wrap');
    const pageInfo = document.getElementById('page-info');

    if (currentSearchQuery) {
      clearBtn.style.display = 'block';
      headline.textContent = `Hasil Pencarian "${query}"`;
      paginationWrap.style.display = 'none';
      pageInfo.style.display = 'none';

      // Filter lokal dari allRawNews jika ada
      const filtered = allRawNews.filter(item => {
        const titleMatch = (item.judul || '').toLowerCase().includes(currentSearchQuery);
        const excerptMatch = (item.ringkasan || '').toLowerCase().includes(currentSearchQuery);
        const authorMatch = (item.penulis || '').toLowerCase().includes(currentSearchQuery);
        return titleMatch || excerptMatch || authorMatch;
      });
      renderNewsView(filtered);
    } else {
      clearBtn.style.display = 'none';
      headline.textContent = 'Semua Berita';
      renderNewsView(allRawNews, allRawNews.length);
    }
  }

  function clearSearch() {
    const input = document.getElementById('search-input');
    input.value = '';
    handleSearch('');
    input.focus();
  }

  document.addEventListener('DOMContentLoaded', () => {
    loadBerita(1);
  });
</script>
@endsection

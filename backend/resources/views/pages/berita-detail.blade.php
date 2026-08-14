@extends('layouts.app')

@section('title', 'Detail Berita - Desa Munggur')
@section('description', 'Detail artikel dan kabar informasi resmi Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  /* ============================================================
     ARTICLE DETAIL STYLES
     ============================================================ */
  .article-page-wrap {
    background: #f8fafc;
    padding: 40px 0 96px;
    min-height: 80vh;
  }

  .article-container {
    max-width: 840px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* Breadcrumbs */
  .detail-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.82rem;
    color: #64748b;
    margin-bottom: 24px;
    flex-wrap: wrap;
    font-weight: 500;
  }
  .detail-breadcrumb a {
    color: #475569;
    text-decoration: none;
    transition: color 0.2s;
  }
  .detail-breadcrumb a:hover {
    color: #2d6a4f;
    text-decoration: underline;
  }
  .detail-breadcrumb svg {
    color: #cbd5e1;
    flex-shrink: 0;
  }
  .detail-breadcrumb .breadcrumb-current {
    color: #0f172a;
    font-weight: 600;
    max-width: 320px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Back Button */
  .btn-back-nav {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #2d6a4f;
    text-decoration: none;
    margin-bottom: 28px;
    padding: 8px 16px;
    background: rgba(45, 106, 79, 0.08);
    border-radius: 10px;
    transition: all 0.2s ease;
  }
  .btn-back-nav:hover {
    background: #2d6a4f;
    color: #fff;
    transform: translateX(-3px);
  }
  .btn-back-nav svg {
    transition: transform 0.2s;
  }
  .btn-back-nav:hover svg {
    transform: translateX(-3px);
  }

  /* Article Card Wrapper */
  .article-card-main {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 24px;
    padding: 48px 44px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
    margin-bottom: 48px;
  }

  /* Category & Meta */
  .article-header-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }
  .article-badge-pill {
    background: rgba(45, 106, 79, 0.1);
    color: #2d6a4f;
    font-size: 0.74rem;
    font-weight: 700;
    padding: 4px 14px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }
  .article-reading-time {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    color: #64748b;
    font-weight: 500;
  }

  /* Article Main Title */
  .article-main-title {
    font-size: clamp(1.75rem, 4.5vw, 2.5rem);
    font-weight: 800;
    color: #0f172a;
    line-height: 1.25;
    letter-spacing: -0.025em;
    margin: 0 0 28px;
  }

  /* Author & Date Bar */
  .author-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 0;
    border-top: 1px solid #f1f5f9;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 36px;
    flex-wrap: wrap;
    gap: 16px;
  }
  .author-info-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .author-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2d6a4f, #52b788);
    color: #fff;
    font-weight: 800;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(45, 106, 79, 0.25);
  }
  .author-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 3px;
  }
  .author-sub {
    font-size: 0.78rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
  }

  /* Social Share Buttons */
  .share-group {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .share-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #64748b;
    margin-right: 4px;
  }
  .share-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #475569;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .share-btn:hover {
    background: #2d6a4f;
    border-color: #2d6a4f;
    color: #fff;
    transform: translateY(-2px);
  }
  .share-btn.btn-wa:hover { background: #25D366; border-color: #25D366; color: #fff; }
  .share-btn.btn-fb:hover { background: #1877F2; border-color: #1877F2; color: #fff; }

  /* Hero Thumbnail Image */
  .article-hero-media {
    margin-bottom: 40px;
    position: relative;
  }
  .article-hero-img {
    width: 100%;
    max-height: 480px;
    object-fit: cover;
    border-radius: 18px;
    display: block;
    border: 1px solid #e2e8f0;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.04);
  }
  .article-img-caption {
    font-size: 0.78rem;
    color: #64748b;
    text-align: center;
    margin-top: 10px;
    font-style: italic;
  }

  /* Excerpt / Lead Paragraph */
  .article-lead {
    font-size: 1.15rem;
    font-weight: 500;
    color: #1e293b;
    line-height: 1.75;
    padding: 20px 24px;
    background: #f8fafc;
    border-left: 4px solid #2d6a4f;
    border-radius: 0 12px 12px 0;
    margin-bottom: 32px;
  }

  /* Article Content Body */
  .article-rich-body {
    font-size: 1.065rem;
    color: #334155;
    line-height: 1.88;
    letter-spacing: -0.005em;
    word-break: break-word;
  }
  .article-rich-body p {
    margin-bottom: 24px;
    text-align: justify;
  }
  .article-rich-body h2 {
    font-size: 1.45rem;
    font-weight: 800;
    color: #0f172a;
    margin: 36px 0 16px;
    letter-spacing: -0.02em;
    line-height: 1.35;
  }
  .article-rich-body h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin: 28px 0 12px;
  }
  .article-rich-body ul, .article-rich-body ol {
    margin: 0 0 24px 24px;
    padding-left: 10px;
  }
  .article-rich-body li {
    margin-bottom: 8px;
    line-height: 1.75;
  }
  .article-rich-body blockquote {
    margin: 32px 0;
    padding: 20px 28px;
    background: #f1f5f9;
    border-left: 4px solid #2d6a4f;
    border-radius: 0 14px 14px 0;
    font-style: italic;
    color: #1e293b;
    font-size: 1.05rem;
    line-height: 1.7;
  }

  /* Publisher Box */
  .publisher-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
    background: linear-gradient(135deg, rgba(45, 106, 79, 0.05) 0%, rgba(82, 183, 136, 0.08) 100%);
    border: 1px solid rgba(45, 106, 79, 0.15);
    border-radius: 16px;
    margin-top: 48px;
  }
  .publisher-logo {
    width: 48px;
    height: 48px;
    object-fit: contain;
    flex-shrink: 0;
  }
  .publisher-name {
    font-size: 0.95rem;
    font-weight: 800;
    color: #1b4332;
    margin: 0 0 4px;
  }
  .publisher-desc {
    font-size: 0.8rem;
    color: #475569;
    line-height: 1.5;
    margin: 0;
  }

  /* ============================================================
     RELATED ARTICLES SECTION
     ============================================================ */
  .related-section {
    margin-top: 56px;
  }
  .related-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
  }
  .related-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.015em;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
  }
  .related-see-all {
    font-size: 0.82rem;
    font-weight: 700;
    color: #2d6a4f;
    text-decoration: none;
  }
  .related-see-all:hover {
    text-decoration: underline;
  }

  .related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
  }
  .related-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
  }
  .related-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(45, 106, 79, 0.1);
    border-color: #2d6a4f;
  }
  .related-card-img-wrap {
    width: 100%;
    aspect-ratio: 16 / 10;
    background: #f1f5f9;
    overflow: hidden;
  }
  .related-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s;
  }
  .related-card:hover .related-card-img {
    transform: scale(1.05);
  }
  .related-card-no-img {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
  }
  .related-card-body {
    padding: 16px 14px;
    display: flex;
    flex-direction: column;
    flex: 1;
    justify-content: space-between;
  }
  .related-card-date {
    font-size: 0.72rem;
    color: #64748b;
    margin-bottom: 6px;
    font-weight: 500;
  }
  .related-card-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin: 0 0 10px;
  }
  .related-card-read {
    font-size: 0.78rem;
    font-weight: 700;
    color: #2d6a4f;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  /* Toast Notification */
  .copy-toast {
    position: fixed;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%) translateY(20px);
    background: #0f172a;
    color: #fff;
    padding: 12px 24px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    opacity: 0;
    pointer-events: none;
    transition: all 0.25s ease;
    z-index: 9999;
  }
  .copy-toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }

  /* Loading & Error */
  .detail-loading-wrap, .detail-error-wrap {
    text-align: center;
    padding: 96px 20px;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 24px;
  }
  .detail-spinner {
    width: 44px;
    height: 44px;
    border: 3.5px solid #e2e8f0;
    border-top-color: #2d6a4f;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto 16px;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  @media (max-width: 800px) {
    .article-card-main {
      padding: 32px 24px;
      border-radius: 20px;
    }
    .related-grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width: 540px) {
    .article-card-main {
      padding: 24px 18px;
    }
    .author-bar {
      flex-direction: column;
      align-items: flex-start;
    }
    .share-group {
      width: 100%;
      justify-content: flex-start;
    }
    .related-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')

  <section class="article-page-wrap">
    <div class="article-container">

      <!-- Breadcrumbs -->
      <nav class="detail-breadcrumb" id="detail-breadcrumb">
        <a href="{{ url('/') }}">Beranda</a>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
        <a href="{{ url('/berita') }}">Berita</a>
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
        <span class="breadcrumb-current" id="breadcrumb-title">Memuat...</span>
      </nav>

      <a href="{{ url('/berita') }}" class="btn-back-nav">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
        Kembali ke Daftar Berita
      </a>

      <!-- Article Content Card -->
      <div id="article-main-target">
        <div class="detail-loading-wrap">
          <div class="detail-spinner"></div>
          <p style="color:#64748b;font-weight:600;font-size:0.95rem;">Memuat isi berita...</p>
        </div>
      </div>

      <!-- Related Articles Section -->
      <div class="related-section" id="related-section" style="display:none;">
        <div class="related-header">
          <h3 class="related-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6z"/></svg>
            Berita Terkait Lainnya
          </h3>
          <a href="{{ url('/berita') }}" class="related-see-all">Lihat Semua →</a>
        </div>
        <div class="related-grid" id="related-grid">
          <!-- Rendered via JS -->
        </div>
      </div>

    </div>
  </section>

  <!-- Copy Toast -->
  <div class="copy-toast" id="copy-toast">✓ Tautan berita berhasil disalin ke clipboard!</div>

@endsection

@section('scripts')
<script>
  function formatTanggalLengkap(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { 
      weekday: 'long', 
      day: 'numeric', 
      month: 'long', 
      year: 'numeric' 
    });
  }

  function getSlugFromUrl() {
    const parts = window.location.pathname.split('/');
    return parts[parts.length - 1];
  }

  function getAuthorInitial(name) {
    if (!name) return 'DM';
    const parts = name.trim().split(' ');
    if (parts.length >= 2) {
      return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return name.substring(0, 2).toUpperCase();
  }

  function estimateReadingTime(text) {
    if (!text) return '1 mnt baca';
    const words = text.trim().split(/\s+/).length;
    const minutes = Math.ceil(words / 180);
    return `${minutes} mnt baca`;
  }

  function formatArticleBody(text) {
    if (!text) return '';
    
    // Jika teks sudah berisi tag HTML (misalnya <p> atau <div>), kembalikan langsung
    if (text.includes('<p>') || text.includes('<br>') || text.includes('<div>')) {
      return text;
    }

    // Ubah pemisah baris ganda menjadi paragraf <p>
    const paragraphs = text.split(/\n\s*\n/);
    return paragraphs
      .map(p => {
        const clean = p.trim().replace(/\n/g, '<br>');
        return clean ? `<p>${clean}</p>` : '';
      })
      .join('');
  }

  function loadDetail() {
    const slug = getSlugFromUrl();
    const target = document.getElementById('article-main-target');

    if (!slug) {
      showError('Slug berita tidak ditemukan.');
      return;
    }

    fetch(`/api/berita/${slug}`, { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error('not found');
        return res.json();
      })
      .then(item => {
        renderArticleContent(item);
        loadRelated(item.id);
        
        // Update Title & Breadcrumb
        document.title = `${item.judul} - Desa Munggur`;
        document.getElementById('breadcrumb-title').textContent = item.judul;
      })
      .catch(() => {
        showError('Berita tidak ditemukan atau telah dihapus oleh pengelola.');
      });
  }

  function renderArticleContent(item) {
    const target = document.getElementById('article-main-target');
    const tanggal = formatTanggalLengkap(item.tanggal_terbit);
    const author = item.penulis || 'Pemerintah Desa Munggur';
    const authorInitial = getAuthorInitial(author);
    const readTime = estimateReadingTime((item.ringkasan || '') + ' ' + (item.isi || ''));
    const currentUrl = encodeURIComponent(window.location.href);
    const shareTitle = encodeURIComponent(item.judul);

    const imgHtml = item.image_url
      ? `
        <div class="article-hero-media">
          <img src="${item.image_url}" alt="${item.judul}" class="article-hero-img" onerror="this.style.display='none'" />
          <p class="article-img-caption">Foto dokumentasi kegiatan Desa Munggur</p>
        </div>`
      : '';

    const leadHtml = item.ringkasan
      ? `<div class="article-lead">${item.ringkasan}</div>`
      : '';

    const bodyHtml = formatArticleBody(item.isi);

    target.innerHTML = `
      <article class="article-card-main">
        <!-- Header Badges -->
        <div class="article-header-meta">
          <span class="article-badge-pill">Kabar Desa</span>
          <span class="article-reading-time">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            ${readTime}
          </span>
        </div>

        <!-- Judul Artikel -->
        <h1 class="article-main-title">${item.judul}</h1>

        <!-- Author & Action Bar -->
        <div class="author-bar">
          <div class="author-info-wrap">
            <div class="author-avatar">${authorInitial}</div>
            <div>
              <p class="author-name">${author}</p>
              <p class="author-sub">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                ${tanggal}
              </p>
            </div>
          </div>

          <!-- Share Buttons -->
          <div class="share-group">
            <span class="share-label">Bagikan:</span>
            <!-- WA -->
            <a href="https://api.whatsapp.com/send?text=${shareTitle}%20${currentUrl}" target="_blank" rel="noopener noreferrer" class="share-btn btn-wa" title="Bagikan ke WhatsApp">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.155.57 4.175 1.564 5.922l-1.564 5.906 6.061-1.59c1.77 1.05 3.831 1.662 6.039 1.662 6.627 0 12-5.373 12-12s-5.373-12-12-12z"/></svg>
            </a>
            <!-- FB -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=${currentUrl}" target="_blank" rel="noopener noreferrer" class="share-btn btn-fb" title="Bagikan ke Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.688 5H18V0h-3.808C10.595 0 9 1.582 9 4.615V8z"/></svg>
            </a>
            <!-- Copy Link -->
            <button onclick="copyArticleUrl()" class="share-btn" title="Salin Tautan">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
            </button>
          </div>
        </div>

        <!-- Gambar Utama -->
        ${imgHtml}

        <!-- Lead / Ringkasan -->
        ${leadHtml}

        <!-- Isi Artikel Lengkap -->
        <div class="article-rich-body">
          ${bodyHtml}
        </div>

        <!-- Publisher Footer Box -->
        <div class="publisher-card">
          <img src="{{ asset('assets/images/boyolali-logo.svg') }}" alt="Logo Boyolali" class="publisher-logo" />
          <div>
            <p class="publisher-name">Pemerintah Desa Munggur</p>
            <p class="publisher-desc">Diterbitkan secara resmi untuk transparansi publik dan pelayanan masyarakat Desa Munggur, Kecamatan Andong, Boyolali.</p>
          </div>
        </div>
      </article>
    `;
  }

  function loadRelated(currentId) {
    fetch('/api/berita?page=1', { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error(`Server error ${res.status}`);
        return res.json();
      })
      .then(resp => {
        const wrap = document.getElementById('related-section');
        const grid = document.getElementById('related-grid');
        const items = (resp.data || []).filter(b => b.id !== currentId).slice(0, 3);

        if (items.length === 0) {
          wrap.style.display = 'none';
          return;
        }

        let html = '';
        items.forEach(item => {
          const tgl = item.tanggal_terbit ? new Date(item.tanggal_terbit).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) : '';
          const imgHtml = item.image_url
            ? `<img src="${item.image_url}" alt="${item.judul}" class="related-card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" /><div class="related-card-no-img" style="display:none"><svg width="36" height="36" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg></div>`
            : `<div class="related-card-no-img"><svg width="36" height="36" fill="none" stroke="#2d6a4f" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path></svg></div>`;

          html += `
            <a href="/berita/${item.slug}" class="related-card">
              <div class="related-card-img-wrap">${imgHtml}</div>
              <div class="related-card-body">
                <div>
                  ${tgl ? `<p class="related-card-date">${tgl}</p>` : ''}
                  <h4 class="related-card-title">${item.judul}</h4>
                </div>
                <span class="related-card-read">
                  Baca Berita
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                </span>
              </div>
            </a>
          `;
        });

        grid.innerHTML = html;
        wrap.style.display = 'block';
      })
      .catch(() => {
        document.getElementById('related-section').style.display = 'none';
      });
  }

  function showError(msg) {
    const target = document.getElementById('article-main-target');
    target.innerHTML = `
      <div class="detail-error-wrap">
        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5" style="margin-bottom:16px;">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <h2 style="font-size:1.35rem;color:#1e293b;margin:0 0 8px;font-weight:700;">Berita Tidak Ditemukan</h2>
        <p style="color:#64748b;font-size:0.9rem;margin-bottom:24px;">${msg}</p>
        <a href="/berita" class="btn-back-nav" style="margin:0;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
          Kembali ke Daftar Berita
        </a>
      </div>
    `;
  }

  function copyArticleUrl() {
    navigator.clipboard.writeText(window.location.href).then(() => {
      const toast = document.getElementById('copy-toast');
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    loadDetail();
  });
</script>
@endsection

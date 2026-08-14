@extends('layouts.app')

@section('title', 'Berita - Desa Munggur')
@section('extra-css', true)

@section('head')
<style>
  /* ---- DETAIL ARTICLE ---- */
  .article-wrap {
    max-width: 780px;
    margin: 0 auto;
    padding: 40px 0 80px;
  }

  .article-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-accent);
    text-decoration: none;
    margin-bottom: 28px;
    transition: gap 0.2s;
  }
  .article-back-btn:hover { gap: 12px; }
  .article-back-btn svg { transition: transform 0.2s; }
  .article-back-btn:hover svg { transform: translateX(-4px); }

  .article-badge {
    display: inline-block;
    background: rgba(45,106,79,0.1);
    color: var(--color-accent);
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 14px;
  }

  .article-title {
    font-size: clamp(1.5rem, 4vw, 2.2rem);
    font-weight: 800;
    color: #111827;
    line-height: 1.25;
    letter-spacing: -0.02em;
    margin: 0 0 20px;
  }

  .article-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    padding-bottom: 24px;
    border-bottom: 1.5px solid #f0f2f5;
    margin-bottom: 32px;
  }
  .article-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
  }

  .article-thumbnail {
    width: 100%;
    max-height: 440px;
    object-fit: cover;
    border-radius: 16px;
    display: block;
    margin-bottom: 36px;
    border: 1px solid #e5e7eb;
  }

  .article-body {
    font-size: 1rem;
    color: #374151;
    line-height: 1.85;
    white-space: pre-wrap;
    word-break: break-word;
  }

  .article-divider {
    border: none;
    border-top: 1.5px solid #f0f2f5;
    margin: 48px 0;
  }

  /* Related articles section */
  .related-section-title {
    font-size: 1.1rem;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.01em;
    margin-bottom: 20px;
  }
  .related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 18px;
  }
  .related-card {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  }
  .related-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.09);
    border-color: var(--color-accent);
  }
  .related-card-img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    display: block;
    background: #f0f2f5;
  }
  .related-card-no-img {
    width: 100%;
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
  }
  .related-card-body { padding: 14px; }
  .related-card-date { font-size: 0.7rem; color: #9ca3af; margin-bottom: 6px; }
  .related-card-title { font-size: 0.88rem; font-weight: 700; color: #1a1a1a; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

  /* Error & Loading */
  .detail-loading, .detail-error {
    text-align: center;
    padding: 80px 20px;
    color: #9ca3af;
  }
  .detail-error { color: #dc2626; }
  .spinner {
    width: 40px; height: 40px;
    border: 3px solid #e5e7eb;
    border-top-color: var(--color-accent);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto 16px;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  @media (max-width: 768px) {
    .article-wrap { padding: 24px 0 60px; }
    .related-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 480px) {
    .related-grid { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  <!-- PAGE HEADER -->
  <section class="page-header">
    <div class="container">
      <div class="page-header-inner">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
          <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
          <path d="M18 14h-8"></path>
          <path d="M15 18h-5"></path>
          <path d="M10 6h8v4h-8V6z"></path>
        </svg>
        <div>
          <h1 class="page-header-title">Detail Berita</h1>
          <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Berita Desa Munggur</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <section class="page-main">
    <div class="container">
      <div class="article-wrap" id="article-wrap">
        <!-- Loading state -->
        <div class="detail-loading" id="detail-loading">
          <div class="spinner"></div>
          <p>Memuat berita...</p>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')
<script>
  function formatTanggal(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function getSlugFromUrl() {
    const parts = window.location.pathname.split('/');
    return parts[parts.length - 1];
  }

  function loadDetail() {
    const slug = getSlugFromUrl();
    if (!slug) {
      showError('Berita tidak ditemukan.');
      return;
    }

    fetch(`/api/berita/${slug}`, { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error('not found');
        return res.json();
      })
      .then(item => {
        renderArticle(item);
        loadRelated(item.id);
        // Update title
        document.title = `${item.judul} - Desa Munggur`;
      })
      .catch(() => showError('Berita tidak ditemukan atau telah dihapus.'));
  }

  function renderArticle(item) {
    const wrap = document.getElementById('article-wrap');
    const tanggal = formatTanggal(item.tanggal_terbit);

    const imgHtml = item.image_url
      ? `<img src="${item.image_url}" alt="${item.judul}" class="article-thumbnail" onerror="this.style.display='none'" />`
      : '';

    wrap.innerHTML = `
      <a href="/berita" class="article-back-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
        Kembali ke Berita
      </a>

      <span class="article-badge">Berita</span>
      <h1 class="article-title">${item.judul}</h1>

      <div class="article-meta">
        ${tanggal ? `<div class="article-meta-item">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          ${tanggal}
        </div>` : ''}
        ${item.penulis ? `<div class="article-meta-item">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          ${item.penulis}
        </div>` : ''}
      </div>

      ${imgHtml}

      <div class="article-body" id="article-body">${item.isi || ''}</div>

      <hr class="article-divider" />

      <p class="related-section-title">📰 Berita Lainnya</p>
      <div class="related-grid" id="related-grid">
        <p style="color:#9ca3af;font-size:0.82rem;">Memuat berita terkait...</p>
      </div>
    `;
  }

  function loadRelated(currentId) {
    fetch('/api/berita?page=1', { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error(`Server error ${res.status}`);
        return res.json();
      })
      .then(resp => {
        const grid = document.getElementById('related-grid');
        if (!grid) return;

        const items = (resp.data || []).filter(b => b.id !== currentId).slice(0, 3);

        if (items.length === 0) {
          grid.innerHTML = `<p style="color:#9ca3af;font-size:0.82rem;">Belum ada berita lain.</p>`;
          return;
        }

        let html = '';
        items.forEach(item => {
          const tanggal = formatTanggal(item.tanggal_terbit);
          const imgHtml = item.image_url
            ? `<img src="${item.image_url}" alt="${item.judul}" class="related-card-img" onerror="this.style.display='none'" />`
            : `<div class="related-card-no-img"><svg width="36" height="36" fill="none" stroke="#4caf50" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path></svg></div>`;

          html += `
            <a href="/berita/${item.slug}" class="related-card">
              ${imgHtml}
              <div class="related-card-body">
                ${tanggal ? `<p class="related-card-date">${tanggal}</p>` : ''}
                <h3 class="related-card-title">${item.judul}</h3>
              </div>
            </a>
          `;
        });
        grid.innerHTML = html;
      })
      .catch(() => {
        const grid = document.getElementById('related-grid');
        if (grid) grid.innerHTML = '';
      });
  }

  function showError(msg) {
    document.getElementById('article-wrap').innerHTML = `
      <a href="/berita" class="article-back-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
        Kembali ke Berita
      </a>
      <div class="detail-error">
        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:12px;opacity:0.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <p>${msg}</p>
        <a href="/berita" style="font-size:0.85rem;color:var(--color-accent);font-weight:600;">← Lihat semua berita</a>
      </div>`;
  }

  document.addEventListener('DOMContentLoaded', loadDetail);
</script>
@endsection

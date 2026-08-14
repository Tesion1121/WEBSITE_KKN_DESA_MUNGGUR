@extends('layouts.app')

@section('title', 'Berita - Desa Munggur')
@section('description', 'Berita dan informasi terkini dari Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  /* ---- BERITA GRID ---- */
  .berita-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 28px;
  }

  .berita-card {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
  }
  .berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border-color: var(--color-accent);
  }

  .berita-card-img-wrap {
    position: relative;
    width: 100%;
    height: 200px;
    background: #f0f2f5;
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
    transform: scale(1.04);
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
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 10px;
  }

  .berita-card-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }
  .berita-badge {
    display: inline-block;
    background: rgba(45,106,79,0.1);
    color: var(--color-accent);
    font-size: 0.7rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
  .berita-date {
    font-size: 0.72rem;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .berita-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    letter-spacing: -0.01em;
    margin: 0;
  }
  .berita-card-ringkasan {
    font-size: 0.82rem;
    color: #6c757d;
    line-height: 1.65;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
  }
  .berita-card-footer {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--color-accent);
    margin-top: 4px;
  }
  .berita-card-footer svg {
    transition: transform 0.2s;
  }
  .berita-card:hover .berita-card-footer svg {
    transform: translateX(4px);
  }

  /* Skeleton loading */
  .skeleton {
    background: linear-gradient(90deg, #f0f2f5 25%, #e5e7eb 50%, #f0f2f5 75%);
    background-size: 200% 100%;
    animation: shimmer 1.4s infinite;
    border-radius: 8px;
  }
  @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

  .skeleton-card { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 16px; overflow: hidden; }
  .skeleton-img { width: 100%; height: 200px; border-radius: 0; }
  .skeleton-body { padding: 20px; display: flex; flex-direction: column; gap: 10px; }
  .skeleton-line { height: 14px; }
  .skeleton-line.short { width: 45%; }
  .skeleton-line.medium { width: 75%; }
  .skeleton-line.full { width: 100%; }

  /* Pagination */
  .pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 48px;
    flex-wrap: wrap;
  }
  .page-btn {
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border: 1.5px solid #e5e7eb;
    background: #fff;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    font-family: inherit;
  }
  .page-btn:hover:not(:disabled) {
    border-color: var(--color-accent);
    color: var(--color-accent);
    background: rgba(45,106,79,0.05);
  }
  .page-btn.active {
    background: var(--color-accent);
    border-color: var(--color-accent);
    color: #fff;
  }
  .page-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
  }
  .page-info {
    font-size: 0.82rem;
    color: #9ca3af;
    text-align: center;
    margin-top: 12px;
  }

  /* Empty state */
  .empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: #9ca3af;
  }
  .empty-state svg {
    margin-bottom: 16px;
    opacity: 0.4;
  }
  .empty-state p {
    font-size: 1rem;
    font-weight: 600;
    color: #6c757d;
  }
  .empty-state span {
    font-size: 0.82rem;
    color: #9ca3af;
  }

  @media (max-width: 768px) {
    .berita-grid { grid-template-columns: 1fr; gap: 18px; }
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
            <h1 class="page-header-title">Berita Desa Munggur</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Informasi dan kabar terkini dari Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section class="page-main">
      <div class="container">
        <p style="color:#4b5563;margin-bottom:32px;line-height:1.7;max-width:680px;">
          Simak berita dan pengumuman terbaru seputar kegiatan, program, dan perkembangan Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.
        </p>

        <div class="berita-grid" id="berita-grid">
          <!-- Skeleton loading -->
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line short"></div><div class="skeleton skeleton-line full"></div><div class="skeleton skeleton-line medium"></div></div></div>
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line short"></div><div class="skeleton skeleton-line full"></div><div class="skeleton skeleton-line medium"></div></div></div>
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line short"></div><div class="skeleton skeleton-line full"></div><div class="skeleton skeleton-line medium"></div></div></div>
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

  function formatTanggal(dateStr) {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function renderSkeletons() {
    const grid = document.getElementById('berita-grid');
    let html = '';
    for (let i = 0; i < 6; i++) {
      html += `<div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line short"></div><div class="skeleton skeleton-line full"></div><div class="skeleton skeleton-line medium"></div></div></div>`;
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
        const grid = document.getElementById('berita-grid');
        const data = resp.data || [];
        currentPage = resp.current_page || 1;
        totalPages = resp.last_page || 1;

        if (data.length === 0) {
          grid.innerHTML = `
            <div class="empty-state">
              <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
                <path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6z"></path>
              </svg>
              <p>Belum ada berita yang dipublikasikan</p>
              <span>Pantau terus halaman ini untuk informasi terbaru</span>
            </div>`;
          return;
        }

        let html = '';
        data.forEach(item => {
          const tanggal = formatTanggal(item.tanggal_terbit);
          const imgHtml = item.image_url
            ? `<img src="${item.image_url}" alt="${item.judul}" class="berita-card-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" /><div class="berita-card-no-img" style="display:none"><svg width="48" height="48" fill="none" stroke="#4caf50" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 9 4-4 4 4 4-4 4 4"/><circle cx="8.5" cy="13.5" r="1.5"/></svg></div>`
            : `<div class="berita-card-no-img"><svg width="48" height="48" fill="none" stroke="#4caf50" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6z"></path></svg></div>`;

          html += `
            <a href="/berita/${item.slug}" class="berita-card">
              <div class="berita-card-img-wrap">${imgHtml}</div>
              <div class="berita-card-body">
                <div class="berita-card-meta">
                  <span class="berita-badge">Berita</span>
                  ${tanggal ? `<span class="berita-date"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>${tanggal}</span>` : ''}
                </div>
                <h2 class="berita-card-title">${item.judul}</h2>
                ${item.ringkasan ? `<p class="berita-card-ringkasan">${item.ringkasan}</p>` : ''}
                <div class="berita-card-footer">
                  Baca selengkapnya
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </div>
              </div>
            </a>
          `;
        });

        grid.innerHTML = html;

        // Render pagination
        if (totalPages > 1) {
          renderPagination(currentPage, totalPages, resp.from, resp.to, resp.total);
        }
      })
      .catch(err => {
        console.error('Gagal memuat berita:', err);
        document.getElementById('berita-grid').innerHTML = `<p style="grid-column:1/-1;text-align:center;color:#dc2626;padding:40px;">Gagal memuat berita. Silakan coba lagi.</p>`;
      });
  }

  function renderPagination(current, total, from, to, totalItems) {
    const wrap = document.getElementById('pagination-wrap');
    const info = document.getElementById('page-info');

    let html = '';

    // Prev button
    html += `<button class="page-btn" onclick="goToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''}>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
    </button>`;

    // Page numbers
    const range = [];
    for (let i = Math.max(1, current - 2); i <= Math.min(total, current + 2); i++) {
      range.push(i);
    }
    if (range[0] > 1) {
      html += `<button class="page-btn" onclick="goToPage(1)">1</button>`;
      if (range[0] > 2) html += `<span style="padding:0 4px;color:#9ca3af">…</span>`;
    }
    range.forEach(p => {
      html += `<button class="page-btn ${p === current ? 'active' : ''}" onclick="goToPage(${p})">${p}</button>`;
    });
    if (range[range.length - 1] < total) {
      if (range[range.length - 1] < total - 1) html += `<span style="padding:0 4px;color:#9ca3af">…</span>`;
      html += `<button class="page-btn" onclick="goToPage(${total})">${total}</button>`;
    }

    // Next button
    html += `<button class="page-btn" onclick="goToPage(${current + 1})" ${current >= total ? 'disabled' : ''}>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
    </button>`;

    wrap.innerHTML = html;
    wrap.style.display = 'flex';

    info.textContent = `Menampilkan ${from}–${to} dari ${totalItems} berita`;
    info.style.display = 'block';
  }

  function goToPage(page) {
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    window.scrollTo({ top: 0, behavior: 'smooth' });
    loadBerita(page);
  }

  document.addEventListener('DOMContentLoaded', () => loadBerita(1));
</script>
@endsection

@extends('layouts.app')

@section('title', 'UMKM - Desa Munggur')
@section('description', 'Direktori UMKM (Usaha Mikro, Kecil, dan Menengah) Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
    /* ---- UMKM GRID ---- */
    .umkm-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
    }

    .umkm-card {
      background: #fff;
      border: 1.5px solid #e5e7eb;
      border-radius: 14px;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    }
    .umkm-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 32px rgba(0,0,0,0.11);
      border-color: var(--color-accent);
    }

    .umkm-card-img {
      width: 100%;
      height: 185px;
      object-fit: cover;
      background: #f0f2f5;
      display: block;
    }

    .umkm-card-body { padding: 16px; }
    .umkm-card-name { font-size: 0.95rem; font-weight: 700; color: #1a1a1a; margin-bottom: 5px; }
    .umkm-card-desc { font-size: 0.8rem; color: #6c757d; line-height: 1.6; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .umkm-card-badge { display: inline-block; background: rgba(45,106,79,0.1); color: var(--color-accent); font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; }

    .umkm-card-tap-hint {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 0.72rem;
      color: #9ca3af;
      margin-top: 10px;
    }

    /* Skeleton loading */
    .skeleton {
      background: linear-gradient(90deg, #f0f2f5 25%, #e5e7eb 50%, #f0f2f5 75%);
      background-size: 200% 100%;
      animation: shimmer 1.4s infinite;
      border-radius: 8px;
    }
    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

    .skeleton-card { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px; overflow: hidden; }
    .skeleton-img { width: 100%; height: 185px; }
    .skeleton-body { padding: 16px; }
    .skeleton-line { height: 14px; margin-bottom: 10px; }
    .skeleton-line.short { width: 60%; }
    .skeleton-line.medium { width: 80%; }

    /* ---- MODAL POPUP ---- */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.55);
      z-index: 2000;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.25s ease;
      backdrop-filter: blur(4px);
    }
    .modal-overlay.open {
      opacity: 1;
      pointer-events: all;
    }

    .modal-box {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      width: 100%;
      max-width: 780px;
      max-height: 90vh;
      display: grid;
      grid-template-columns: 1fr 1fr;
      box-shadow: 0 24px 80px rgba(0,0,0,0.2);
      transform: translateY(20px) scale(0.97);
      transition: transform 0.28s ease;
      overflow-y: auto;
      position: relative;
    }
    .modal-overlay.open .modal-box {
      transform: translateY(0) scale(1);
    }

    .modal-image-wrap {
      position: relative;
      background: #f0f2f5;
      min-height: 320px;
    }
    .modal-image {
      width: 100%;
      height: 100%;
      min-height: 320px;
      object-fit: cover;
      display: block;
    }

    .modal-content {
      padding: 32px 28px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      overflow-y: auto;
    }

    .modal-close {
      position: absolute;
      top: 12px;
      right: 12px;
      width: 36px;
      height: 36px;
      background: rgba(0,0,0,0.5);
      border: none;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #fff;
      font-size: 1.1rem;
      transition: background 0.2s;
      z-index: 10;
    }
    .modal-close:hover { background: rgba(0,0,0,0.75); }

    .modal-badge { display: inline-block; background: rgba(45,106,79,0.1); color: var(--color-accent); font-size: 0.7rem; font-weight: 700; padding: 4px 12px; border-radius: 999px; }
    .modal-title { font-size: 1.3rem; font-weight: 800; color: #1a1a1a; letter-spacing: -0.02em; line-height: 1.3; }

    .modal-info-block {
      background: #f8f9fa;
      border: 1.5px solid #e5e7eb;
      border-radius: 10px;
      padding: 14px 16px;
    }
    .modal-info-label {
      font-size: 0.68rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: #9ca3af;
      margin-bottom: 6px;
    }
    .modal-info-value {
      font-size: 0.88rem;
      color: #1a1a1a;
      line-height: 1.65;
      font-weight: 500;
    }

    .modal-contact-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #25D366;
      color: #fff;
      padding: 12px 20px;
      border-radius: 10px;
      font-size: 0.88rem;
      font-weight: 700;
      transition: all 0.2s;
      border: none;
      cursor: pointer;
      font-family: inherit;
      width: 100%;
      justify-content: center;
      text-decoration: none;
    }
    .modal-contact-btn:hover { background: #1ebe57; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37,211,102,0.3); }

    @media (max-width: 768px) {
      .umkm-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
      .modal-box { grid-template-columns: 1fr; max-width: 480px; }
      .modal-image-wrap { min-height: 220px; }
      .modal-image { min-height: 220px; }
    }
    @media (max-width: 480px) {
      .umkm-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          <div>
            <h1 class="page-header-title">UMKM Desa Munggur</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Direktori Usaha Mikro, Kecil, dan Menengah</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section class="page-main">
      <div class="container">
        <p style="color:#4b5563;margin-bottom:32px;line-height:1.7;max-width:680px;">
          Desa Munggur memiliki berbagai usaha mikro, kecil, dan menengah (UMKM) unggulan yang dikelola oleh warga setempat. Klik pada kartu untuk melihat detail dan kontak WhatsApp pengelola.
        </p>

        <div class="umkm-grid" id="umkm-grid">
          <!-- Skeleton loading awal -->
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line medium"></div><div class="skeleton skeleton-line short"></div></div></div>
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line medium"></div><div class="skeleton skeleton-line short"></div></div></div>
          <div class="skeleton-card"><div class="skeleton skeleton-img"></div><div class="skeleton-body"><div class="skeleton skeleton-line medium"></div><div class="skeleton skeleton-line short"></div></div></div>
        </div>
      </div>
    </section>
    <div class="modal-overlay" id="umkmModal" onclick="closeModalOnOverlay(event)">
      <div class="modal-box">
        <button class="modal-close" onclick="closeModal()" aria-label="Tutup Modal">&times;</button>
        <div class="modal-image-wrap">
          <img src="" id="modalImg" class="modal-image" alt="Foto UMKM" />
        </div>
        <div class="modal-content">
          <div>
            <span class="modal-badge" id="modalBadge">UMKM</span>
            <h3 class="modal-title" id="modalTitle" style="margin-top: 6px;">Nama UMKM</h3>
          </div>

          <div class="modal-info-block">
            <div class="modal-info-label">Deskripsi Usaha</div>
            <div class="modal-info-value" id="modalDesc">---</div>
          </div>

          <div class="modal-info-block">
            <div class="modal-info-label">Alamat / Lokasi</div>
            <div class="modal-info-value" id="modalAlamat">---</div>
          </div>

          <div class="modal-info-block">
            <div class="modal-info-label">Kisaran Harga</div>
            <div class="modal-info-value" id="modalHarga">---</div>
          </div>

          <a href="#" id="modalWaBtn" target="_blank" class="modal-contact-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.154 4.215 4.316-1.132z"/></svg>
            Hubungi via WhatsApp
          </a>
        </div>
      </div>
    </div>
  
@endsection

@section('scripts')
<script>
  let umkmData = [];

  function loadUmkmData() {
    const grid = document.getElementById('umkm-grid');

    fetch('/api/umkm', { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error(`Server error ${res.status}`);
        return res.json();
      })
      .then(data => {
        umkmData = data || [];
        if (umkmData.length === 0) {
          grid.innerHTML = `
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:#9ca3af;">
              <p style="font-size:1.1rem; font-weight:600;">Belum ada data UMKM terdaftar</p>
            </div>
          `;
          return;
        }

        let html = '';
        umkmData.forEach((item, index) => {
          const imgUrl = item.image_url || item.imageUrl || '/assets/images/1.jpeg';
          html += `
            <div class="umkm-card" onclick="openModal(${index})">
              <img src="${imgUrl}" alt="${item.nama}" class="umkm-card-img" onerror="this.src='/assets/images/1.jpeg'" />
              <div class="umkm-card-body">
                <span class="umkm-card-badge">${item.kategori || 'UMKM'}</span>
                <h3 class="umkm-card-name" style="margin-top:6px;">${item.nama}</h3>
                <p class="umkm-card-desc">${item.deskripsi || ''}</p>
                <div class="umkm-card-tap-hint">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                  Klik untuk detail & kontak
                </div>
              </div>
            </div>
          `;
        });
        grid.innerHTML = html;
      })
      .catch(err => {
        console.error('Gagal memuat UMKM:', err);
        grid.innerHTML = `<p style="grid-column:1/-1; text-align:center; color:#dc2626; padding:40px;">Gagal memuat data UMKM.</p>`;
      });
  }

  function openModal(index) {
    const item = umkmData[index];
    if (!item) return;

    const imgUrl = item.image_url || item.imageUrl || '/assets/images/1.jpeg';
    document.getElementById('modalImg').src = imgUrl;
    document.getElementById('modalBadge').textContent = item.kategori || 'UMKM';
    document.getElementById('modalTitle').textContent = item.nama;
    document.getElementById('modalDesc').textContent = item.deskripsi || '-';
    document.getElementById('modalAlamat').textContent = item.alamat || 'Desa Munggur, Kecamatan Andong';
    document.getElementById('modalHarga').textContent = item.harga ? `Rp ${item.harga}` : 'Menyesuaikan pesanan';

    let phone = (item.kontak || '').replace(/\D/g, '');
    if (phone.startsWith('0')) phone = '62' + phone.substring(1);
    document.getElementById('modalWaBtn').href = `https://wa.me/${phone}?text=Halo%20${encodeURIComponent(item.nama)},%20saya%20tertarik%20dengan%20produk%20Anda%20dari%20website%20Desa%20Munggur.`;

    document.getElementById('umkmModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    document.getElementById('umkmModal').classList.remove('open');
    document.body.style.overflow = 'auto';
  }

  function closeModalOnOverlay(e) {
    if (e.target.classList.contains('modal-overlay')) {
      closeModal();
    }
  }

  document.addEventListener('DOMContentLoaded', loadUmkmData);
</script>
@endsection

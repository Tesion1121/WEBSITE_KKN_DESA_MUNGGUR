@extends('layouts.app')

@section('title', 'Komoditas Unggulan - Desa Munggur')
@section('description', 'Komoditas Hasil Pertanian Padi, Jagung, dan Perkebunan Unggulan Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  .komoditas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 32px;
    margin-bottom: 40px;
  }

  .komoditas-card {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    display: flex;
    flex-direction: column;
  }

  .komoditas-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.09);
    border-color: var(--color-accent);
  }

  .komoditas-img-wrap {
    width: 100%;
    height: 220px;
    background: #f0f2f5;
    position: relative;
    overflow: hidden;
  }

  .komoditas-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .komoditas-card:hover .komoditas-img {
    transform: scale(1.05);
  }

  .komoditas-body {
    padding: 28px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .komoditas-badge {
    display: inline-block;
    background: rgba(45, 106, 79, 0.1);
    color: var(--color-accent);
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    align-self: flex-start;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .komoditas-name {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 12px;
    line-height: 1.3;
  }

  .komoditas-desc {
    font-size: 0.95rem;
    color: #4b5563;
    line-height: 1.75;
    text-align: justify;
  }

  /* Skeleton Loading */
  .skeleton-komoditas {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 18px;
    overflow: hidden;
    height: 380px;
  }
  
  .skeleton-box {
    background: linear-gradient(90deg, #f0f2f5 25%, #e5e7eb 50%, #f0f2f5 75%);
    background-size: 200% 100%;
    animation: shimmer 1.4s infinite;
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <path d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7z"/><circle cx="12" cy="9" r="2.5"/>
          </svg>
          <div>
            <h1 class="page-header-title">Komoditas Utama Desa Munggur</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Informasi Hasil Pertanian Padi, Jagung & Perkebunan Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="page-main">
      <div class="container">
        <p style="color:#4b5563; margin-bottom:36px; line-height:1.7; font-size:1rem; max-width:780px;">
          Desa Munggur kaya akan hasil sektor pertanian dan perkebunan. Berikut adalah komoditas unggulan yang menjadi penopang utama ketahanan pangan dan perekonomian warga Desa Munggur:
        </p>

        <!-- GRID DATA KOMODITAS -->
        <div class="komoditas-grid" id="komoditas-grid">
          <!-- Skeleton Loading -->
          <div class="skeleton-komoditas"><div class="skeleton-box" style="height:220px;"></div></div>
          <div class="skeleton-komoditas"><div class="skeleton-box" style="height:220px;"></div></div>
          <div class="skeleton-komoditas"><div class="skeleton-box" style="height:220px;"></div></div>
        </div>

        <div style="background:#f8f9fa; border:1.5px solid #e5e7eb; border-radius:12px; padding:20px 24px; margin-top:24px;">
          <p style="font-size:0.85rem; color:#6c757d; font-style:italic;">
            💡 Informasi data komoditas pertanian ini dikelola oleh Administrator Desa Munggur.
          </p>
        </div>
      </div>
    </section>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('komoditas-grid');

    fetch('/api/komoditas')
      .then(res => res.json())
      .then(data => {
        if (!Array.isArray(data) || data.length === 0) {
          grid.innerHTML = `
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:#9ca3af;">
              <p style="font-size:1.1rem; font-weight:600;">Belum ada data komoditas terdaftar.</p>
            </div>
          `;
          return;
        }

        let html = '';
        data.forEach(item => {
          const imgUrl = item.image_url || item.imageUrl || '/assets/images/1.jpeg';
          html += `
            <div class="komoditas-card">
              <div class="komoditas-img-wrap">
                <img src="${imgUrl}" alt="${item.nama}" class="komoditas-img" onerror="this.src='/assets/images/1.jpeg'" />
              </div>
              <div class="komoditas-body">
                <span class="komoditas-badge">Komoditas Unggulan</span>
                <h3 class="komoditas-name">${item.nama}</h3>
                <p class="komoditas-desc">${item.deskripsi || ''}</p>
              </div>
            </div>
          `;
        });
        grid.innerHTML = html;
      })
      .catch(err => {
        console.error('Gagal memuat Komoditas:', err);
        grid.innerHTML = `<p style="grid-column:1/-1; text-align:center; color:#dc2626; padding:40px;">Gagal memuat data komoditas.</p>`;
      });
  });
</script>
@endsection

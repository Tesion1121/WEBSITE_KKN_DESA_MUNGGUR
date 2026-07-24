@extends('layouts.app')

@section('title', 'Potensi Desa - Desa Munggur')
@section('description', 'Detail Potensi Sektor Pertanian, Musim Tanam, Hasil Panen & Harga Komoditas Padi dan Jagung Desa Munggur.')
@section('extra-css', true)

@section('head')
<style>
  .potensi-card {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
    margin-bottom: 32px;
  }

  .potensi-title-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
  }

  .potensi-icon {
    width: 48px;
    height: 48px;
    background: rgba(45, 106, 79, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    flex-shrink: 0;
  }

  .crop-badge {
    background: #e8f5e9;
    color: #2d6a4f;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 20px;
    display: inline-block;
    margin-right: 8px;
    margin-bottom: 8px;
  }

  /* Grid Data Pertanian */
  .agri-detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 24px;
    margin: 24px 0 32px;
  }

  .agri-box {
    background: #f9fafb;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
  }

  .agri-box-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .agri-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .agri-list li {
    font-size: 0.92rem;
    color: #374151;
    margin-bottom: 12px;
    line-height: 1.6;
    border-bottom: 1px dashed #e5e7eb;
    padding-bottom: 8px;
  }

  .agri-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .agri-list strong {
    color: var(--color-accent);
  }

  .price-tag {
    background: #fef3c7;
    color: #d97706;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    font-size: 0.85rem;
  }

  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 16px;
    margin-top: 24px;
  }

  .gallery-item {
    border-radius: 12px;
    overflow: hidden;
    height: 200px;
    border: 1.5px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .gallery-item img:hover {
    transform: scale(1.05);
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <line x1="18" y1="20" x2="18" y2="10"></line>
            <line x1="12" y1="20" x2="12" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="14"></line>
          </svg>
          <div>
            <h1 class="page-header-title">Potensi & Komoditas Pertanian Desa</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Detail Pola Tanam, Hasil Panen & Harga Komoditas Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="page-main">
      <div class="container">
        
        <!-- INTRO CARD -->
        <div class="potensi-card">
          <div class="potensi-title-wrap">
            <div class="potensi-icon">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 0 1 10 10c0 5.5-4.5 10-10 10S2 17.5 2 12 6.5 2 12 2z"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <div>
              <h2 style="font-size:1.3rem; font-weight:800; color:#1a1a1a;">Sektor Pertanian & Komoditas Utama</h2>
              <span style="font-size:0.85rem; color:#6b7280;">Urat Nadi Perekonomian Desa Munggur (Kecamatan Andong, Boyolali)</span>
            </div>
          </div>

          <p style="color:#4b5563; line-height:1.7; font-size:0.98rem; margin-bottom:16px;">
            Pertanian merupakan penopang utama perekonomian masyarakat Desa Munggur. Lahan pertanian dimanfaatkan secara maksimal dengan rotasi komoditas utama berupa <strong>Padi Sawah</strong> dan <strong>Jagung</strong>, serta tanaman palawija pendukung yaitu <strong>Kacang Tanah</strong>.
          </p>

          <div style="margin: 16px 0 24px;">
            <span class="crop-badge">🌾 Komoditas 1: Padi Sawah</span>
            <span class="crop-badge">🌽 Komoditas 2: Jagung (Unyil & Hibrida)</span>
            <span class="crop-badge">🥜 Palawija: Kacang Tanah</span>
          </div>

          <!-- RINCIAN DETAIL PADI DAN JAGUNG -->
          <div class="agri-detail-grid">
            
            <!-- BOX PADI -->
            <div class="agri-box" style="border-top: 4px solid #2d6a4f;">
              <h3 class="agri-box-title">
                🌾 Komoditas Padi Sawah
              </h3>
              <ul class="agri-list">
                <li>
                  <strong>📅 Musim Tanam:</strong> 2 Periode setahun (Masa tanam dimulai <em>akhir September</em>).
                </li>
                <li>
                  <strong>🌾 Hasil Panen:</strong> Per hektar persanggan <em>(±1.200 m²)</em> menghasilkan <strong>8 - 9 kuintal gabah</strong>.
                </li>
                <li>
                  <strong>🛒 Pemasaran:</strong> Dijual langsung ke pasar lokal atau melalui tengkulak gabah.
                </li>
                <li>
                  <strong>💰 Harga Jual:</strong><br />
                  - Normal: <span class="price-tag">Rp 8.000 / kg</span><br />
                  - Pas Musim Panen Raya: <span class="price-tag">Rp 6.500 / kg</span>
                </li>
              </ul>
            </div>

            <!-- BOX JAGUNG & PALAWIJA -->
            <div class="agri-box" style="border-top: 4px solid #d97706;">
              <h3 class="agri-box-title">
                🌽 Komoditas Jagung & Palawija
              </h3>
              <ul class="agri-list">
                <li>
                  <strong>📅 Musim Tanam:</strong> Ditanam bulan <em>Mei</em> (di sela-sela pergantian musim tanam padi).
                </li>
                <li>
                  <strong>🥜 Palawija Pendukung:</strong> Kacang Tanah.
                </li>
                <li>
                  <strong>🌽 Hasil Panen:</strong><br />
                  - Jagung Unyil Super: <strong>4 kuintal</strong> / sanggan.<br />
                  - Jagung Besar Hibrida: <strong>1 ton</strong> / sanggan.
                </li>
                <li>
                  <strong>🛒 Pemasaran:</strong> Hasil panen dipasarkan ke pasar / tengkulak sekaligus.
                </li>
                <li>
                  <strong>💰 Harga Jual:</strong><br />
                  - Jagung Unyil: <span class="price-tag">Rp 8.000 / kg</span><br />
                  - Jagung Besar Hibrida: <span class="price-tag">Rp 6.000 / kg</span>
                </li>
              </ul>
            </div>

          </div>

          <!-- DOKUMENTASI FOTO PERTANIAN -->
          <h3 style="font-size:1.05rem; font-weight:700; color:#1a1a1a; margin-top:28px; margin-bottom:12px;">
            📸 Dokumentasi Pertanian & Hasil Panen
          </h3>
          
          <div class="gallery-grid">
            <div class="gallery-item">
              <img src="{{ asset('assets/images/1.jpeg') }}" alt="Sawah & Lahan Pertanian Desa Munggur 1" />
            </div>
            <div class="gallery-item">
              <img src="{{ asset('assets/images/2.jpeg') }}" alt="Sawah & Lahan Pertanian Desa Munggur 2" />
            </div>
            <div class="gallery-item">
              <img src="{{ asset('assets/images/3.jpeg') }}" alt="Sawah & Lahan Pertanian Desa Munggur 3" />
            </div>
            <div class="gallery-item">
              <img src="{{ asset('assets/images/4.jpeg') }}" alt="Tanaman Jagung & Palawija Desa Munggur" />
            </div>
          </div>
        </div>

        <!-- POTENSI SDM & UMKM -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:24px;">
          <div class="potensi-card" style="margin-bottom:0;">
            <div class="potensi-title-wrap">
              <div class="potensi-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 1 0 7.75"/></svg>
              </div>
              <div>
                <h3 style="font-size:1.1rem; font-weight:700; color:#1a1a1a;">Sumber Daya Manusia</h3>
                <span style="font-size:0.8rem; color:#6b7280;">Gotong Royong & Kerja Sama</span>
              </div>
            </div>
            <p style="font-size:0.9rem; color:#4b5563; line-height:1.6;">
              Warga Desa Munggur memiliki ikatan sosial yang kuat dengan semangat gotong royong tinggi, produktif di usia kerja, serta mendukung iklim wirausaha lokal.
            </p>
          </div>

          <div class="potensi-card" style="margin-bottom:0;">
            <div class="potensi-title-wrap">
              <div class="potensi-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              </div>
              <div>
                <h3 style="font-size:1.1rem; font-weight:700; color:#1a1a1a;">UMKM & Usaha Lokal</h3>
                <span style="font-size:0.8rem; color:#6b7280;">Pemberdayaan Ekonomi Warga</span>
              </div>
            </div>
            <p style="font-size:0.9rem; color:#4b5563; line-height:1.6;">
              Berbagai usaha mikro kecil menengah di bidang pengolahan pangan, perdagangan, dan kuliner terus berkembang mendukung kemandirian desa.
            </p>
          </div>
        </div>

      </div>
    </section>
  
@endsection

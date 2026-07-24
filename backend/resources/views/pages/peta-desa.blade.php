@extends('layouts.app')

@section('title', 'Peta Desa - Desa Munggur')
@section('description', 'Peta Lokasi Wilayah Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  .map-card {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    margin-bottom: 32px;
  }

  .map-iframe {
    width: 100%;
    height: 480px;
    border: none;
    display: block;
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 32px;
  }

  .stat-box {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px;
    text-align: center;
  }

  .stat-box-label {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #6b7280;
    margin-bottom: 6px;
    letter-spacing: 0.05em;
  }

  .stat-box-val {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--color-accent);
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <div>
            <h1 class="page-header-title">Peta Wilayah Desa Munggur</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Kecamatan Andong, Kabupaten Boyolali, Jawa Tengah</p>
          </div>
        </div>
      </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="page-main">
      <div class="container">
        <p style="color:#4b5563; margin-bottom:24px; line-height:1.7; font-size:1rem;">
          Berikut adalah peta lokasi interaktif wilayah Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Anda dapat memperbesar (zoom in/out) atau melihat petunjuk arah lokasi melalui Google Maps di bawah ini:
        </p>

        <!-- GOOGLE MAPS EMBED CONTAINER -->
        <div class="map-card">
          <iframe 
            class="map-iframe" 
            src="https://maps.google.com/maps?q=Desa%20Munggur%2C%20Andong%2C%20Boyolali&t=&z=14&ie=UTF8&iwloc=&output=embed" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

        <!-- INFORMASI STATISTIK WILAYAH -->
        <div class="stats-grid">
          <div class="stat-box">
            <div class="stat-box-label">Kecamatan</div>
            <div class="stat-box-val" style="font-size:1.2rem;">Andong</div>
          </div>
          <div class="stat-box">
            <div class="stat-box-label">Kabupaten</div>
            <div class="stat-box-val" style="font-size:1.2rem;">Boyolali</div>
          </div>
          <div class="stat-box">
            <div class="stat-box-label">Jumlah Dukuh</div>
            <div class="stat-box-val">6</div>
          </div>
          <div class="stat-box">
            <div class="stat-box-label">Jumlah RW / RT</div>
            <div class="stat-box-val">3 / 15</div>
          </div>
        </div>

      </div>
    </section>
  
@endsection

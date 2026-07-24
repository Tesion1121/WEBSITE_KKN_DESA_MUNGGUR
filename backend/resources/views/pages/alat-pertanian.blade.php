@extends('layouts.app')

@section('title', 'SOP & Perawatan Mesin Pertanian - Desa Munggur')
@section('description', 'Panduan Pemeriksaan Harian dan Bulanan Mesin Pertanian Desa Munggur (Traktor, Mesin 4-Tak, 2-Tak).')
@section('extra-css', true)

@section('head')
<style>
  .sop-header {
    background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
    color: white;
    padding: 60px 0;
    margin-bottom: 40px;
  }
  .sop-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 12px;
  }
  .sop-subtitle {
    font-size: 1.1rem;
    color: #e8f5e9;
    opacity: 0.9;
    max-width: 700px;
  }
  
  .sop-section {
    margin-bottom: 48px;
  }
  
  .sop-section-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .sop-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 24px;
  }

  .sop-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .sop-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    border-color: var(--color-accent);
  }

  .sop-card-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 16px;
  }

  .sop-number {
    width: 32px;
    height: 32px;
    background: var(--color-accent);
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
  }

  .sop-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.4;
  }

  .sop-list {
    list-style-type: disc;
    padding-left: 20px;
    color: #4b5563;
    font-size: 0.95rem;
    line-height: 1.6;
  }

  .sop-list li {
    margin-bottom: 8px;
  }

  .info-alert {
    background: #e8f5e9;
    border-left: 4px solid var(--color-accent);
    padding: 16px 20px;
    border-radius: 0 8px 8px 0;
    margin-bottom: 24px;
    color: #1b4332;
    font-size: 0.95rem;
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="sop-header">
      <div class="container">
        <h1 class="sop-title">Panduan Perawatan Mesin Pertanian</h1>
        <p class="sop-subtitle">Standar Operasional Prosedur (SOP) Pemeriksaan Harian dan Bulanan Alat Mesin Pertanian Desa Munggur</p>
      </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="page-main">
      <div class="container">
        
        <div class="info-alert">
          <div style="margin-bottom: 16px;">
            <strong>Perhatian:</strong> Panduan ini ditujukan bagi petani dan operator alat pertanian di Desa Munggur untuk menjaga keawetan dan keselamatan kerja. Pastikan selalu melakukan pemeriksaan sebelum alat dioperasikan.
          </div>
          <a href="https://drive.google.com/file/d/1t5ibtCzurcGoxr9IL9TvjRaSuoDdOR7z/view?usp=sharing" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #1b4332; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.95rem; transition: background 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><polyline points="9 15 12 18 15 15"></polyline></svg>
            Lihat SOP Lengkap (PDF Beserta Gambar)
          </a>
        </div>

        <!-- SECTION 1: HARIAN DIESEL -->
        <div class="sop-section">
          <h2 class="sop-section-title">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            Pemeriksaan Harian (Traktor Mesin Diesel)
          </h2>
          <div class="sop-grid">
            
            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">1</div>
                <h3 class="sop-card-title">Pemeriksaan Oli Mesin</h3>
              </div>
              <ul class="sop-list">
                <li>Tempatkan traktor di permukaan rata dan periksa ketinggian oli.</li>
                <li>Pastikan level oli berada di rentang tanda MIN hingga MAX pada pengukur.</li>
                <li>Jika kurang, tambahkan oli baru menggunakan wadah corong hingga tanda MAX.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">2</div>
                <h3 class="sop-card-title">Level Tangki & Kebocoran Bahan Bakar</h3>
              </div>
              <ul class="sop-list">
                <li>Isi bahan bakar <strong>setelah pekerjaan selesai</strong> untuk mencegah uap air.</li>
                <li>Pastikan tangki dalam kondisi penuh sebelum memulai pekerjaan.</li>
                <li>Periksa tanda kebocoran air, oli, atau bahan bakar di bawah traktor sebelum dinyalakan.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">3</div>
                <h3 class="sop-card-title">Pemeriksaan Sistem Pendingin</h3>
              </div>
              <ul class="sop-list">
                <li>Traktor dengan tangki cadangan: periksa level air cadangan.</li>
                <li>Traktor tanpa tangki cadangan (lama): lepaskan tutup radiator hati-hati (awas uap panas).</li>
                <li>Jika kurang, tambahkan air radiator jenis <em>Long Life Coolant (LLC)</em>.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">4</div>
                <h3 class="sop-card-title">Pemeriksaan Sistem Kelistrikan</h3>
              </div>
              <ul class="sop-list">
                <li>Verifikasi fungsi lampu sein dari arah depan, lampu rem, dan panel instrumen.</li>
                <li>Ganti komponen yang rusak. Laporkan jika ada lampu peringatan menyala.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">5</div>
                <h3 class="sop-card-title">Sistem Penggerak (Uji Jalan)</h3>
              </div>
              <ul class="sop-list">
                <li>Lakukan uji jalan dari garasi ke jalan umum.</li>
                <li>Periksa kelonggaran kemudi (steering), rem, selip kopling, atau rem satu sisi.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">6</div>
                <h3 class="sop-card-title">Ban, Velg, dan Hub</h3>
              </div>
              <ul class="sop-list">
                <li>Periksa tekanan angin ban kiri dan kanan secara visual.</li>
                <li>Periksa apakah ada baut/mur yang longgar atau hilang di velg dan hub. Lakukan pengencangan tambahan.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">7</div>
                <h3 class="sop-card-title">Grease Up / Pelumasan</h3>
              </div>
              <ul class="sop-list">
                <li>Suntikkan pelumas ke semua nippel gemuk pada bagian yang bergerak.</li>
                <li>Rujuk pada buku manual traktor agar tidak ada titik yang terlewat.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">8</div>
                <h3 class="sop-card-title">Peralatan Rotary & Pin Terlepas</h3>
              </div>
              <ul class="sop-list">
                <li>Periksa kebocoran oli di sekitar kotak rantai rotary.</li>
                <li>Lakukan pelumasan <em>universal joint</em>.</li>
                <li>Pastikan tidak ada pin yang terlepas di area pengait traktor.</li>
              </ul>
            </div>

          </div>
        </div>

        <!-- SECTION 2: BULANAN DIESEL -->
        <div class="sop-section">
          <h2 class="sop-section-title">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Pemeriksaan Berkala Bulanan (Traktor Mesin Diesel)
          </h2>
          <div class="sop-grid">
            
            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">1</div>
                <h3 class="sop-card-title">Cek Kebocoran & Filter Udara</h3>
              </div>
              <ul class="sop-list">
                <li><strong>Bahan Bakar:</strong> Cek kebocoran di lantai, filter, dan sambungan selang.</li>
                <li><strong>Filter Udara:</strong> Lepas penutup, keluarkan elemennya, ketuk ringan. Bersihkan dengan <em>airgun</em> jika berdebu.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">2</div>
                <h3 class="sop-card-title">Radiator, Fan Belt & Baterai</h3>
              </div>
              <ul class="sop-list">
                <li><strong>Radiator:</strong> Cek kebocoran air di sambungan selang.</li>
                <li><strong>Fan Belt & Baterai:</strong> Periksa kekenduran sabuk. Untuk aki <em>maintenance free</em> periksa indikator; aki biasa ukur tegangan dan tambah air bila perlu.</li>
              </ul>
            </div>

          </div>
        </div>

        <!-- SECTION 3: BENSIN 4 TAK & 2 TAK -->
        <div class="sop-section">
          <h2 class="sop-section-title">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2"><path d="M12 2v6M12 18v4M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M2 12h6M18 12h4"/></svg>
            Mesin Bensin 4-Tak & 2-Tak (Bulanan)
          </h2>
          <p style="color:#6c757d; margin-bottom: 20px;">Berlaku untuk: Mesin Penyemprotan, Traktor Tangan, Mesin Penanam Padi, Pemotong Rumput, dan Gergaji Mesin.</p>
          
          <div class="sop-grid">
            
            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">1</div>
                <h3 class="sop-card-title">Pemeriksaan 4-Tak</h3>
              </div>
              <ul class="sop-list">
                <li>Periksa kebocoran oli & bahan bakar di lantai.</li>
                <li>Gunakan indikator level oli, isi ulang jika kurang untuk mencegah kerusakan mesin.</li>
                <li>Cek kotoran saringan bahan bakar. Jika tidak dipakai lama, kosongkan bahan bakar dari karburator sampai mesin mati sendiri.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">2</div>
                <h3 class="sop-card-title">Pemeriksaan 2-Tak</h3>
              </div>
              <ul class="sop-list">
                <li>Periksa kebocoran & kondisi pompa bahan bakar (Priming Pump).</li>
                <li>Periksa kondisi pemasangan pisau pemotong dan lumasi roda gigi <em>(grease up)</em>.</li>
                <li>Pastikan tanda peringatan/safety masih terpasang dengan baik.</li>
              </ul>
            </div>

            <div class="sop-card">
              <div class="sop-card-header">
                <div class="sop-number">3</div>
                <h3 class="sop-card-title">Pengoperasian Mesin 2-Tak</h3>
              </div>
              <ul class="sop-list">
                <li>Pastikan pakai bensin campur (Oli : Bensin = 1:50 atau 1:25).</li>
                <li>Pompa priming pump -> Tutup Choke -> Tarik Starter sampai ada letupan.</li>
                <li>Buka Choke -> Tarik Starter lagi hingga mesin menyala penuh.</li>
              </ul>
            </div>

          </div>
        </div>

      </div>
    </section>
  
@endsection

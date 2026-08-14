@extends('layouts.app')

@section('title', 'Struktur Desa - Desa Munggur')
@section('description', 'Struktur organisasi Pemerintah Desa & BPD Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
    /* ==================== ORG CHART ==================== */
    .org-tree {
      padding: 12px 0 32px;
      overflow-x: auto;
    }

    /* Each level row */
    .org-row {
      display: flex;
      justify-content: center;
      gap: 32px;
      position: relative;
    }

    .vline { width: 2px; height: 28px; background: #d1d5db; margin: 0 auto; }

    .org-node {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .org-card {
      background: #fff;
      border: 1.5px solid #e5e7eb;
      border-radius: 12px;
      padding: 16px 18px 14px;
      width: 160px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: box-shadow 0.2s, border-color 0.2s;
    }
    .org-card:hover {
      box-shadow: 0 6px 20px rgba(0,0,0,0.09);
      border-color: var(--color-accent);
    }
    .org-card.ketua-card {
      border-color: var(--color-accent);
      border-width: 2px;
      width: 175px;
    }

    .org-jabatan {
      font-size: 0.68rem;
      font-weight: 800;
      color: var(--color-accent);
      text-transform: uppercase;
      letter-spacing: 0.07em;
      margin-bottom: 10px;
      line-height: 1.3;
    }
    .ketua-card .org-jabatan { color: #1b4332; }

    .org-photo {
      width: 66px; height: 66px;
      border-radius: 50%;
      background: #e5e7eb;
      margin: 0 auto 8px;
      display: flex; align-items: center; justify-content: center;
      border: 2.5px solid #d1d5db;
      overflow: hidden;
    }
    .ketua-card .org-photo {
      width: 76px; height: 76px;
      border-color: var(--color-accent);
    }
    .org-photo img { width: 100%; height: 100%; object-fit: cover; }

    .org-name {
      font-size: 0.8rem;
      font-weight: 700;
      color: #1a1a1a;
      line-height: 1.3;
    }

    .h-bar-row2 {
      position: relative;
      height: 2px;
      background: #d1d5db;
      width: 230px;
      margin: 0 auto;
    }

    .org-note {
      background: #f8f9fa;
      border: 1.5px solid #e5e7eb;
      border-radius: 10px;
      padding: 14px 20px;
      font-size: 0.85rem;
      color: #6c757d;
      font-style: italic;
      margin-top: 40px;
      text-align: center;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    /* ---- Tabs ---- */
    .struktur-tabs {
      display: flex;
      justify-content: center;
      gap: 16px;
      margin: 10px 0 40px;
    }
    .tab-btn {
      padding: 12px 28px;
      font-size: 0.95rem;
      font-weight: 700;
      border-radius: 30px;
      border: 1.5px solid var(--color-border);
      background: #ffffff;
      color: #6b7280;
      cursor: pointer;
      transition: all 0.22s ease;
      font-family: inherit;
    }
    .tab-btn.active {
      background: var(--color-accent);
      color: #ffffff;
      border-color: var(--color-accent);
      box-shadow: 0 4px 12px rgba(45, 106, 79, 0.25);
    }
    .tab-btn:hover:not(.active) {
      border-color: var(--color-accent);
      color: var(--color-accent);
    }
    
    /* ---- Sections ---- */
    .struktur-section {
      display: none;
    }
    .struktur-section.active {
      display: block;
      animation: fadeIn 0.35s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Pemdes grid layout rows */
    .pemdes-row-4 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      max-width: 860px;
      margin: 0 auto;
    }
    .pemdes-row-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      max-width: 660px;
      margin: 0 auto;
    }

    @media (max-width: 768px) {
      .pemdes-row-4 {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
      }
      .pemdes-row-3 {
        grid-template-columns: 1fr;
        max-width: 180px;
        gap: 16px;
      }
    }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <rect x="8" y="2" width="8" height="4" rx="1"></rect>
            <rect x="1" y="14" width="6" height="4" rx="1"></rect>
            <rect x="9" y="14" width="6" height="4" rx="1"></rect>
            <rect x="17" y="14" width="6" height="4" rx="1"></rect>
            <path d="M12 6v4M4 14v-2h16v2"></path>
          </svg>
          <div>
            <h1 class="page-header-title">Struktur Organisasi Desa</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Lembaga Pemerintahan & Permusyawaratan Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ORG CHART CONTENT -->
    <section class="page-main">
      <div class="container">

        <!-- Tab Buttons -->
        <div class="struktur-tabs">
          <button class="tab-btn active" id="tab-btn-pemdes" onclick="switchStrukturTab('pemdes')">Pemerintah Desa (Pemdes)</button>
          <button class="tab-btn" id="tab-btn-bpd" onclick="switchStrukturTab('bpd')">Badan Permusyawaratan Desa (BPD)</button>
        </div>

        <div class="org-tree" id="org-tree">

          <!-- ==================== TAB 1: PEMERINTAH DESA (PEMDES) ==================== -->
          <div class="struktur-section active" id="section-pemdes">
            
            <!-- Level 1: Kepala Desa -->
            <div class="org-row tree-ketua">
              <div class="org-node">
                <div class="org-card ketua-card" id="org-kepala-desa">
                  <p class="org-jabatan">Kepala Desa</p>
                  <div class="org-photo" id="photo-kepala-desa">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kepala-desa">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Vertical Connector: Kepala Desa → Sekdes -->
            <div style="display:flex;flex-direction:column;align-items:center;">
              <div class="vline"></div>
            </div>

            <!-- Level 2: Sekretaris Desa -->
            <div class="org-row">
              <div class="org-node">
                <div class="org-card" id="org-sekretaris-desa" style="border-color:#40916c;">
                  <p class="org-jabatan" style="color:#40916c;">Sekretaris Desa</p>
                  <div class="org-photo" id="photo-sekretaris-desa" style="border-color:#40916c;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-sekretaris-desa">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Connector: Sekdes → Kaur/Kasi -->
            <div style="display:flex;flex-direction:column;align-items:center;">
              <div class="vline"></div>
              <div style="width: 75%; height: 2px; background: #d1d5db; max-width: 640px;"></div>
            </div>

            <!-- Level 3: Kaur & Kasi (4 columns) -->
            <div style="height:16px;"></div>
            <div class="pemdes-row-4">
              <!-- Kasi Kesra dan Pelayanan -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kasi-kesra">
                  <p class="org-jabatan">Kasi Kesra & Pelayanan</p>
                  <div class="org-photo" id="photo-kasi-kesra">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kasi-kesra">Memuat...</p>
                </div>
              </div>

              <!-- Kasi Pemerintahan -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kasi-pemerintahan">
                  <p class="org-jabatan">Kasi Pemerintahan</p>
                  <div class="org-photo" id="photo-kasi-pemerintahan">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kasi-pemerintahan">Memuat...</p>
                </div>
              </div>

              <!-- Kaur Umum dan Perencanaan -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kaur-umum">
                  <p class="org-jabatan">Kaur Umum & Perenc.</p>
                  <div class="org-photo" id="photo-kaur-umum">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kaur-umum">Memuat...</p>
                </div>
              </div>

              <!-- Kaur Keuangan -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kaur-keuangan">
                  <p class="org-jabatan">Kaur Keuangan</p>
                  <div class="org-photo" id="photo-kaur-keuangan">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kaur-keuangan">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Connector: Kaur/Kasi → Kadun -->
            <div style="display:flex;flex-direction:column;align-items:center;margin-top:20px;">
              <div class="vline"></div>
              <div style="width: 66%; height: 2px; background: #d1d5db; max-width: 440px;"></div>
            </div>

            <!-- Level 4: Kepala Dusun (3 columns) -->
            <div style="height:16px;"></div>
            <div class="pemdes-row-3">
              <!-- Kepala Dusun I -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kadun-1">
                  <p class="org-jabatan">Kepala Dusun I</p>
                  <div class="org-photo" id="photo-kadun-1">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kadun-1">Memuat...</p>
                </div>
              </div>

              <!-- Kepala Dusun II -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kadun-2">
                  <p class="org-jabatan">Kepala Dusun II</p>
                  <div class="org-photo" id="photo-kadun-2">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kadun-2">Memuat...</p>
                </div>
              </div>

              <!-- Kepala Dusun III -->
              <div class="org-node">
                <div class="vline" style="height:12px;"></div>
                <div class="org-card" id="org-kadun-3">
                  <p class="org-jabatan">Kepala Dusun III</p>
                  <div class="org-photo" id="photo-kadun-3">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-kadun-3">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Note Pemdes -->
            <div class="org-note">
              Data nama dan foto Perangkat Pemerintahan Desa Munggur dikelola secara dinamis oleh Administrator Desa.
            </div>
          </div>

          <!-- ==================== TAB 2: BADAN PERMUSYAWARATAN DESA (BPD) ==================== -->
          <div class="struktur-section" id="section-bpd">
            
            <!-- LEVEL 1: KETUA BPD -->
            <div class="org-row tree-ketua">
              <div class="org-node">
                <div class="org-card ketua-card" id="org-ketua-bpd">
                  <p class="org-jabatan">Ketua BPD</p>
                  <div class="org-photo" id="photo-ketua-bpd">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-ketua-bpd">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Connector: Ketua → Level 2 -->
            <div style="display:flex;flex-direction:column;align-items:center;">
              <div style="width:2px;height:28px;background:#d1d5db;"></div>
              <div class="h-bar-row2"></div>
            </div>

            <!-- LEVEL 2: WAKIL KETUA & SEKRETARIS BPD -->
            <div style="height:28px;"></div>
            <div class="org-row">
              <!-- Wakil Ketua -->
              <div class="org-node">
                <div class="org-card" id="org-wakil-ketua-bpd">
                  <p class="org-jabatan">Wakil Ketua BPD</p>
                  <div class="org-photo" id="photo-wakil-ketua-bpd">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-wakil-ketua-bpd">Memuat...</p>
                </div>
              </div>
              <!-- Sekretaris -->
              <div class="org-node">
                <div class="org-card" id="org-sekretaris-bpd">
                  <p class="org-jabatan">Sekretaris BPD</p>
                  <div class="org-photo" id="photo-sekretaris-bpd">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-sekretaris-bpd">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Connector: Level 2 → Level 3 -->
            <div style="display:flex;justify-content:center;margin-top:20px;">
              <div style="position:relative;width:230px;height:2px;background:#d1d5db;display:flex;align-items:flex-start;">
                <div style="width:2px;height:28px;background:#d1d5db;position:absolute;left:0;top:0;"></div>
                <div style="width:2px;height:28px;background:#d1d5db;position:absolute;right:0;top:0;"></div>
              </div>
            </div>

            <!-- LEVEL 3: BIDANG-BIDANG BPD -->
            <div style="height:28px;"></div>
            <div class="org-row">
              <!-- Bid. Pemdes & Binmas -->
              <div class="org-node">
                <div class="org-card" id="org-bid-pemdes">
                  <p class="org-jabatan">Bid. Pemdes & Binmas</p>
                  <div class="org-photo" id="photo-bid-pemdes">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-bid-pemdes">Memuat...</p>
                </div>
              </div>
              <!-- Bid. Bangdes & Permasdes -->
              <div class="org-node">
                <div class="org-card" id="org-bid-bangdes">
                  <p class="org-jabatan">Bid. Bangdes & Permasdes</p>
                  <div class="org-photo" id="photo-bid-bangdes">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                  </div>
                  <p class="org-name" id="name-bid-bangdes">Memuat...</p>
                </div>
              </div>
            </div>

            <!-- Note BPD -->
            <div class="org-note">
              Data foto dan nama perangkat BPD (Badan Permusyawaratan Desa) Desa Munggur dikelola secara dinamis oleh Administrator Desa.
            </div>
          </div>

        </div>

      </div>
    </section>
  
@endsection

@section('scripts')
<script>
  function switchStrukturTab(tab) {
    const btnPemdes = document.getElementById('tab-btn-pemdes');
    const btnBpd = document.getElementById('tab-btn-bpd');
    const secPemdes = document.getElementById('section-pemdes');
    const secBpd = document.getElementById('section-bpd');

    if (tab === 'pemdes') {
      btnPemdes.classList.add('active');
      btnBpd.classList.remove('active');
      secPemdes.classList.add('active');
      secBpd.classList.remove('active');
    } else if (tab === 'bpd') {
      btnBpd.classList.add('active');
      btnPemdes.classList.remove('active');
      secBpd.classList.add('active');
      secPemdes.classList.remove('active');
    }
  }

  // Map jabatan string dari DB ke ID HTML element
  const jabatanMap = {
    'Kepala Desa': 'kepala-desa',
    'Sekretaris Desa': 'sekretaris-desa',
    'Kasi Kesra dan Pelayanan': 'kasi-kesra',
    'Kasi Pemerintahan': 'kasi-pemerintahan',
    'Kepala Urusan Umum dan Perencanaan': 'kaur-umum',
    'Kepala Urusan Keuangan': 'kaur-keuangan',
    'Kepala Dusun I': 'kadun-1',
    'Kepala Dusun II': 'kadun-2',
    'Kepala Dusun III': 'kadun-3',
    'Ketua': 'ketua-bpd',
    'Wakil Ketua': 'wakil-ketua-bpd',
    'Sekretaris': 'sekretaris-bpd',
    'Bid. Pemdes & Binmas': 'bid-pemdes',
    'Bid. Bangdes & Permasdes': 'bid-bangdes'
  };

  // Data Bawaan Default
  const defaultData = {
    'kepala-desa': { nama: 'Nur Salim' },
    'sekretaris-desa': { nama: 'Danang W.S' },
    'kasi-kesra': { nama: 'Juwadi' },
    'kasi-pemerintahan': { nama: 'Lilis Pujiyati' },
    'kaur-umum': { nama: 'Priyo Sutanto' },
    'kaur-keuangan': { nama: 'Tri Setiyoningsih' },
    'kadun-1': { nama: 'Kuswadi' },
    'kadun-2': { nama: 'Paiman' },
    'kadun-3': { nama: 'Paino' },
    'ketua-bpd': { nama: 'Suhardi' },
    'wakil-ketua-bpd': { nama: 'Mulyono' },
    'sekretaris-bpd': { nama: 'Sri Wahyuni' },
    'bid-pemdes': { nama: 'Budi Santoso' },
    'bid-bangdes': { nama: 'Heri Prasetyo' }
  };

  document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/perangkat-desa', { headers: { 'Accept': 'application/json' } })
      .then(res => {
        if (!res.ok) throw new Error(`Server error ${res.status}`);
        return res.json();
      })
      .then(data => {
        // Terapkan default dulu
        Object.keys(defaultData).forEach(key => {
          const nameEl = document.getElementById('name-' + key);
          if (nameEl) nameEl.textContent = defaultData[key].nama;
        });

        // Terapkan data dari API database jika ada
        if (Array.isArray(data) && data.length > 0) {
          data.forEach(item => {
            const key = jabatanMap[item.jabatan];
            if (key) {
              const nameEl = document.getElementById('name-' + key);
              const photoEl = document.getElementById('photo-' + key);
              if (nameEl && item.nama) nameEl.textContent = item.nama;
              
              const imgUrl = item.image_url || item.imageUrl;
              if (photoEl && imgUrl) {
                photoEl.innerHTML = `<img src="${imgUrl}" alt="${item.nama}" />`;
              }
            }
          });
        }
      })
      .catch(err => {
        console.log('Menggunakan data bawaan:', err);
        Object.keys(defaultData).forEach(key => {
          const nameEl = document.getElementById('name-' + key);
          if (nameEl) nameEl.textContent = defaultData[key].nama;
        });
      });
  });
</script>
@endsection

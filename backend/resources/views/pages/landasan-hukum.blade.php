@extends('layouts.app')

@section('title', 'Landasan Hukum - Desa Munggur')
@section('description', 'Pusat Edukasi Hukum dan Tata Kelola Desa Munggur berdasarkan UU No. 6 Tahun 2014 jo UU No. 3 Tahun 2024 tentang Desa.')
@section('extra-css', true)

@section('head')
<style>
  .legal-section {
    padding: 40px 0 60px;
  }
  
  .legal-intro-card {
    background: linear-gradient(135deg, rgba(45,106,79,0.06) 0%, rgba(27,67,50,0.02) 100%);
    border: 1.5px solid rgba(45,106,79,0.15);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 40px;
  }

  .legal-intro-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--color-primary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .legal-intro-text {
    font-size: 1rem;
    color: #4b5563;
    line-height: 1.7;
  }

  /* Feature Grid */
  .why-know-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin: 32px 0 48px;
  }

  .why-card {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  }

  .why-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.06);
    border-color: var(--color-accent);
  }

  .why-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: rgba(45, 106, 79, 0.1);
    color: var(--color-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
  }

  .why-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
  }

  .why-card-desc {
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.6;
  }

  /* Table Style */
  .table-container {
    overflow-x: auto;
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    margin: 24px 0 48px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
  }

  .legal-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }

  .legal-table th {
    background: #f9fafb;
    padding: 16px 24px;
    font-size: 0.9rem;
    font-weight: 700;
    color: #374151;
    border-bottom: 1.5px solid #e5e7eb;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .legal-table td {
    padding: 20px 24px;
    font-size: 0.95rem;
    color: #4b5563;
    border-bottom: 1px solid #f3f4f6;
    line-height: 1.6;
  }

  .legal-table tr:last-child td {
    border-bottom: none;
  }

  .legal-table tr:hover td {
    background: #fcfdfd;
  }

  /* Rights & Duties Split */
  .rights-duties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 32px;
    margin-bottom: 48px;
  }

  .rights-box, .duties-box {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    padding: 28px;
  }

  .rights-box { border-top: 4px solid #2d6a4f; }
  .duties-box { border-top: 4px solid #d97706; }

  .box-title {
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .rights-box .box-title { color: #2d6a4f; }
  .duties-box .box-title { color: #d97706; }

  .custom-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .custom-list li {
    position: relative;
    padding-left: 32px;
    margin-bottom: 14px;
    font-size: 0.95rem;
    color: #4b5563;
    line-height: 1.6;
  }

  .custom-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 6px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
  }

  .rights-box .custom-list li::before {
    background: rgba(45, 106, 79, 0.12);
    color: #2d6a4f;
    content: '✓';
  }

  .duties-box .custom-list li::before {
    background: rgba(217, 119, 6, 0.12);
    color: #d97706;
    content: '★';
  }

  /* FAQ Accordion */
  .faq-container {
    margin-bottom: 56px;
  }

  .faq-item {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    margin-bottom: 16px;
    overflow: hidden;
  }

  .faq-question {
    padding: 20px 24px;
    font-size: 1.05rem;
    font-weight: 700;
    color: #1a1a1a;
    background: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
  }

  .faq-answer {
    padding: 0 24px 20px;
    font-size: 0.95rem;
    color: #4b5563;
    line-height: 1.7;
    background: #ffffff;
  }

  /* Form Aspirasi / Pertanyaan */
  .aspirasi-section {
    background: #ffffff;
    border: 2px solid var(--color-accent);
    border-radius: 20px;
    padding: 36px;
    box-shadow: 0 8px 30px rgba(45, 106, 79, 0.08);
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 8px;
  }

  .form-input, .form-textarea {
    width: 100%;
    padding: 14px 16px;
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    font-family: inherit;
    font-size: 0.95rem;
    color: #1f2937;
    background: #f9fafb;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: var(--color-accent);
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(45, 106, 79, 0.1);
  }

  .word-counter-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 6px;
    font-size: 0.8rem;
    color: #6b7280;
  }

  .btn-submit-aspirasi {
    background: var(--color-accent);
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
    padding: 14px 28px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: background 0.2s, transform 0.1s;
  }

  .btn-submit-aspirasi:hover {
    background: var(--color-accent-hover, #1b4332);
    transform: translateY(-2px);
  }

  .btn-submit-aspirasi:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
  }
</style>
@endsection

@section('content')

  <!-- HEADER PAGE -->
  <section class="page-header">
    <div class="container">
      <div class="page-header-inner">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
          <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        <div>
          <h1 class="page-header-title">Landasan Hukum & Edukasi UU Desa</h1>
          <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Pusat Edukasi Hukum Tata Kelola Pemerintahan Desa Munggur</p>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <section class="legal-section">
    <div class="container">

      <!-- INTRO CARD -->
      <div class="legal-intro-card">
        <h2 class="legal-intro-title">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 21h18M3 7h18M5 7v14M19 7v14M9 7v14M15 7v14M4 3h16l-1 4H5L4 3z"/></svg>
          Paham UU Desa: Bersama Membangun Desa Mandiri & Sejahtera
        </h2>
        <p class="legal-intro-text">
          Selamat datang di pusat edukasi hukum dan tata kelola desa. Halaman ini hadir untuk membantu seluruh warga memahami hak, kewajiban, serta aturan main dalam penyelenggaraan pemerintahan desa berdasarkan <strong>Undang-Undang Nomor 6 Tahun 2014 jo Undang-Undang Nomor 3 Tahun 2024 tentang Desa</strong>.
        </p>
      </div>

      <!-- MENGAPA WARGA PERLU TAHU -->
      <div style="margin-bottom: 40px;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: #1a1a1a; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
          💡 Mengapa Warga Perlu Tahu UU Desa?
        </h3>
        <p style="color: #6b7280; font-size: 0.95rem;">
          Undang-Undang Desa memberikan wewenang penuh kepada desa untuk mengurus rumah tangganya sendiri. Dengan memahami UU ini, warga dapat terlibat aktif dalam pembangunan:
        </p>

        <div class="why-know-grid">
          <div class="why-card">
            <div class="why-card-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h4 class="why-card-title">Mengetahui Hak & Kewajiban</h4>
            <p class="why-card-desc">Memahami peran aktif dan hak yang bisa diambil serta kewajiban dalam pembangunan Desa Munggur.</p>
          </div>

          <div class="why-card">
            <div class="why-card-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <h4 class="why-card-title">Mendorong Transparansi</h4>
            <p class="why-card-desc">Ikut mengawasi penggunaan anggaran desa, alokasi dana, dan efektivitas kebijakan pemerintah desa.</p>
          </div>

          <div class="why-card">
            <div class="why-card-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h4 class="why-card-title">Berpartisipasi Aktif</h4>
            <p class="why-card-desc">Terlibat langsung dalam pengambilan keputusan dan perancangan usulan melalui Musyawarah Desa (Musdes).</p>
          </div>
        </div>
      </div>

      <!-- POIN IMPORTANT TABLE -->
      <div style="margin-bottom: 48px;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: #1a1a1a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
          📜 Poin-Poin Penting UU Desa yang Wajib Warga Tahu
        </h3>

        <div class="table-container">
          <table class="legal-table">
            <thead>
              <tr>
                <th style="width: 32%;">Pokok Bahasan</th>
                <th>Penjelasan Singkat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Kedudukan Desa</strong></td>
                <td>Desa adalah kesatuan masyarakat hukum yang memiliki batas wilayah dan berhak mengurus kepentingannya sendiri.</td>
              </tr>
              <tr>
                <td><strong>Kepala Desa & Perangkat</strong></td>
                <td>Memimpin penyelenggaraan pemerintahan desa dan melayani kebutuhan masyarakat secara adil.</td>
              </tr>
              <tr>
                <td><strong>Badan Permusyawaratan Desa (BPD)</strong></td>
                <td>Lembaga yang menampung dan menyalurkan aspirasi warga serta mengawasi kinerja Kepala Desa.</td>
              </tr>
              <tr>
                <td><strong>Keuangan & Aset Desa</strong></td>
                <td>Pendapatan desa (termasuk Dana Desa) digunakan untuk pembangunan, pembinaan, dan pemberdayaan warga.</td>
              </tr>
              <tr>
                <td><strong>Musyawarah Desa (Musdes)</strong></td>
                <td>Forum tertinggi bagi warga untuk menentukan arah pembangunan dan kebijakan strategis desa.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- HAK & KEWAJIBAN -->
      <div style="margin-bottom: 48px;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: #1a1a1a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
          ⚖️ Hak dan Kewajiban Masyarakat Desa
        </h3>

        <div class="rights-duties-grid">
          <div class="rights-box">
            <h4 class="box-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Hak Warga Desa
            </h4>
            <ul class="custom-list">
              <li>Meminta dan memperoleh informasi dari Pemerintah Desa secara akurat dan terbuka.</li>
              <li>Memperoleh pelayanan publik yang adil, responsif, dan setara tanpa diskriminasi.</li>
              <li>Menyampaikan aspirasi, saran, dan pendapat secara lisan maupun tertulis demi kemajuan desa.</li>
              <li>Memilih dan dipilih dalam pemilihan Kepala Desa atau anggota BPD (sesuai ketentuan hukum yang berlaku).</li>
            </ul>
          </div>

          <div class="duties-box">
            <h4 class="box-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              Kewajiban Warga Desa
            </h4>
            <ul class="custom-list">
              <li>Membangun dan memelihara ketenteraman serta ketertiban lingkungan kemasyarakatan.</li>
              <li>Mendorong terciptanya tata pemerintahan desa yang baik, transparan, dan akuntabel.</li>
              <li>Berpartisipasi aktif dalam berbagai kegiatan gotong royong dan pembangunan desa.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- FAQ -->
      <div class="faq-container">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: #1a1a1a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
          ❓ Pertanyaan Sering Diajukan (FAQ)
        </h3>

        <div class="faq-item">
          <div class="faq-question">
            <span>Q: Bagaimana cara warga mengusulkan program pembangunan di RT/RW?</span>
          </div>
          <div class="faq-answer">
            <strong>Jawaban:</strong> Warga dapat menyampaikan aspirasi melalui Musyawarah Dusun (Musdus) atau Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) yang diadakan secara berkala.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            <span>Q: Di mana warga bisa melihat transparansi Anggaran Desa?</span>
          </div>
          <div class="faq-answer">
            <strong>Jawaban:</strong> Laporan APBDes dan realisasi anggaran dipublikasikan secara terbuka melalui papan informasi resmi di Balai / Kantor Desa Munggur.
          </div>
        </div>
      </div>

      <!-- FORM ASPIRASI ONLINE (FORMSUBMIT TO GMAIL) -->
      <div class="aspirasi-section" id="form-aspirasi">
        <div style="margin-bottom: 24px;">
          <h3 style="font-size: 1.4rem; font-weight: 800; color: var(--color-primary); margin-bottom: 6px; display: flex; align-items: center; gap: 10px;">
            📢 Suarakan Aspirasi Anda!
          </h3>
          <p style="color: #4b5563; font-size: 0.95rem; line-height: 1.6;">
            Punya pertanyaan terkait UU Desa, saran tata kelola, atau ingin menyampaikan usulan untuk kemajuan Desa Munggur? Isi form di bawah ini. Pesan Anda akan terkirim langsung ke email resmi: <strong>desamunggur15@gmail.com</strong>.
          </p>
        </div>

        <form action="https://formsubmit.co/desamunggur15@gmail.com" method="POST">
          <!-- FormSubmit Configuration -->
          <input type="hidden" name="_subject" value="[Aspirasi Warga Desa Munggur]" />
          <input type="hidden" name="_template" value="table" />
          <input type="hidden" name="_captcha" value="false" />

          <div class="form-group">
            <label for="nama_pengirim" class="form-label">Nama Lengkap <span style="color: #e11d48;">*</span></label>
            <input type="text" name="Nama Pengirim" id="nama_pengirim" class="form-input" placeholder="Masukkan nama Anda..." required />
          </div>

          <div class="form-group">
            <label for="deskripsi_aspirasi" class="form-label">Pesan / Usulan / Pertanyaan <span style="color: #e11d48;">*</span></label>
            <textarea name="Isi Aspirasi / Pertanyaan" id="deskripsi_aspirasi" class="form-textarea" rows="5" placeholder="Tuliskan pertanyaan atau usulan Anda di sini..." required oninput="countWords(this)"></textarea>
            <div class="word-counter-wrap">
              <span>Batas maksimal: <strong>200 kata</strong></span>
              <span id="wordCounter">0 / 200 kata</span>
            </div>
          </div>

          <button type="submit" class="btn-submit-aspirasi">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            Kirim Pesan Ke Email Desa
          </button>
        </form>
      </div>

    </div>
  </section>

@endsection

@section('scripts')
<script>
  const MAX_WORDS = 200;

  function countWords(textarea) {
    const text = textarea.value.trim();
    const words = text ? text.split(/\s+/).filter(w => w.length > 0) : [];
    const counterEl = document.getElementById('wordCounter');
    
    if (words.length > MAX_WORDS) {
      const truncated = words.slice(0, MAX_WORDS).join(' ');
      textarea.value = truncated;
      counterEl.textContent = `${MAX_WORDS} / ${MAX_WORDS} kata (Batas Tercapai)`;
      counterEl.style.color = '#e11d48';
      counterEl.style.fontWeight = '700';
    } else {
      counterEl.textContent = `${words.length} / ${MAX_WORDS} kata`;
      counterEl.style.color = words.length >= MAX_WORDS - 10 ? '#d97706' : '#6b7280';
      counterEl.style.fontWeight = 'normal';
    }
  }
</script>
@endsection

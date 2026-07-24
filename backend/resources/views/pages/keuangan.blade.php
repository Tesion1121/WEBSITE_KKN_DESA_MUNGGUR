@extends('layouts.app')

@section('title', 'Pojok Pajak & Modul Keuangan - Desa Munggur')
@section('description', 'Pojok Pajak Desa Munggur: Layanan Pendaftaran NPWP Coretax DJP, PBB Boyolali & Booklet Pembukuan UMKM.')
@section('extra-css', true)

@section('head')
<style>
  .tax-section-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--color-primary);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .finance-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 32px;
    margin-bottom: 48px;
  }

  .finance-card {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
  }

  .finance-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.08);
    border-color: var(--color-accent);
  }

  .finance-card-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
  }

  .finance-card-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: rgba(45, 106, 79, 0.1);
    color: var(--color-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .tag-badge {
    display: inline-block;
    background: #e8f5e9;
    color: #2d6a4f;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
  }

  .finance-card-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1.3;
  }

  .finance-card-desc {
    font-size: 0.92rem;
    color: #4b5563;
    line-height: 1.65;
    margin-bottom: 24px;
    flex: 1;
  }

  .btn-open-detail {
    background: var(--color-accent);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 12px 24px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s, transform 0.1s;
    width: 100%;
    text-decoration: none;
  }

  .btn-open-detail:hover {
    background: var(--color-accent-hover, #1b4332);
    transform: translateY(-2px);
  }

  .btn-download-excel {
    background: #107c41;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    padding: 14px 24px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background 0.2s, transform 0.1s;
    margin-top: 20px;
    box-shadow: 0 4px 14px rgba(16, 124, 65, 0.25);
  }

  .btn-download-excel:hover {
    background: #0b5c30;
    transform: translateY(-2px);
  }

  /* Modal Full Content */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 2000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    backdrop-filter: blur(4px);
  }

  .modal-overlay.open {
    display: flex;
  }

  .modal-large-box {
    background: #ffffff;
    border-radius: 20px;
    width: 100%;
    max-width: 860px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    position: relative;
    padding: 36px;
  }

  .modal-close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f3f4f6;
    border: none;
    font-size: 1.2rem;
    font-weight: 700;
    color: #4b5563;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
  }

  .modal-close-btn:hover {
    background: #e5e7eb;
    color: #111827;
  }

  .pojok-pajak-content h3 {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--color-primary);
    margin: 24px 0 12px;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 6px;
  }

  .pojok-pajak-content h4 {
    font-size: 1.02rem;
    font-weight: 700;
    color: #1f2937;
    margin: 16px 0 8px;
  }

  .step-list {
    background: #f9fafb;
    border: 1.5px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 16px;
  }

  .step-list ul, .step-list ol {
    padding-left: 20px;
    margin: 8px 0;
    color: #374151;
    line-height: 1.75;
    font-size: 0.93rem;
  }

  .step-list li {
    margin-bottom: 8px;
  }

  .highlight-badge {
    background: #fef3c7;
    color: #b45309;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
  }

  .source-box {
    background: #f3f4f6;
    border-left: 4px solid var(--color-accent);
    padding: 12px 16px;
    border-radius: 0 8px 8px 0;
    font-size: 0.85rem;
    color: #4b5563;
    margin-top: 20px;
  }

  .source-box a {
    color: var(--color-accent);
    text-decoration: underline;
    word-break: break-all;
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <line x1="12" y1="1" x2="12" y2="23"></line>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          </svg>
          <div>
            <h1 class="page-header-title">Modul Keuangan & Pojok Pajak</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Layanan Informasi Perpajakan Digital & Pembukuan UMKM Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="page-main">
      <div class="container">
        
        <p style="color:#4b5563; margin-bottom:36px; line-height:1.7; font-size:1rem; max-width:780px;">
          Desa Munggur, Kecamatan Andong, Kabupaten Boyolali menghadirkan pusat informasi digital layanan keuangan dan perpajakan. Inisiatif ini hadir untuk mempermudah warga memahami pendaftaran NPWP, laporan SPT Coretax DJP, PBB Boyolali, serta panduan & template pembukuan UMKM.
        </p>

        <!-- 2 CARD KEUANGAN & PAJAK -->
        <div class="finance-cards-grid">

          <!-- CARD 1: POJOK PAJAK DESA MUNGGUR -->
          <div class="finance-card">
            <div class="finance-card-header">
              <div class="finance-card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
              </div>
              <div>
                <span class="tag-badge">Layanan Digital Perpajakan</span>
                <h2 class="finance-card-title">Pojok Pajak Desa Munggur</h2>
              </div>
            </div>
            <p class="finance-card-desc">
              Panduan lengkap pendaftaran & aktivasi NPWP via <strong>Coretax DJP (coretaxdjp.pajak.go.id)</strong>, tata cara lapor SPT Tahunan/Masa, info PBB Kabupaten Boyolali, hingga cara cek & bayar pajak online.
            </p>
            <button class="btn-open-detail" onclick="openPajakModal()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
              Baca Panduan Pojok Pajak
            </button>
          </div>

          <!-- CARD 2: BOOKLET KEUANGAN & TEMPLATE UMKM -->
          <div class="finance-card">
            <div class="finance-card-header">
              <div class="finance-card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              </div>
              <div>
                <span class="tag-badge">Panduan Pembukuan Usaha</span>
                <h2 class="finance-card-title">Template Pembukuan Keuangan UMKM</h2>
              </div>
            </div>
            <p class="finance-card-desc">
              Panduan pentingnya pembukuan arus kas harian/bulanan bagi pelaku usaha mikro, kecil, dan menengah (UMKM) serta <strong>Template Excel Pembukuan Gratis</strong> yang siap diunduh dan digunakan.
            </p>
            <button class="btn-open-detail" onclick="openUmkmModal()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
              Baca Panduan & Unduh Template
            </button>
          </div>

        </div>

      </div>
    </section>

    <!-- MODAL POPUP: POJOK PAJAK DETAIL MATERI -->
    <div class="modal-overlay" id="pajakModal" onclick="closeModalOnOverlay(event, 'pajakModal')">
      <div class="modal-large-box">
        <button class="modal-close-btn" onclick="closeModal('pajakModal')">&times;</button>
        
        <div style="margin-bottom:20px;">
          <span class="tag-badge">Informasi Resmi Perpajakan</span>
          <h2 style="font-size:1.6rem; font-weight:800; color:var(--color-primary); margin-top:4px;">
            " POJOK PAJAK " DESA MUNGGUR
          </h2>
          <p style="color:#6b7280; font-size:0.9rem;">Layanan dan Informasi Pajak Untuk Warga Desa Munggur (Kecamatan Andong, Kabupaten Boyolali)</p>
        </div>

        <div class="pojok-pajak-content">
          <p style="color:#4b5563; line-height:1.7; font-size:0.95rem;">
            Desa Munggur kini menghadirkan <strong>“ Pojok Pajak ”</strong> sebagai bagian dari layanan informasi digital desa. Inisiatif ini hadir sebagai upaya mendekatkan warga dengan informasi seputar perpajakan, baik pajak pusat maupun pajak daerah agar masyarakat lebih mudah memahami hak dan kewajiban perpajakannya tanpa harus jauh-jauh mencari informasi ke kantor pajak.
          </p>

          <!-- SECTION 1 -->
          <h3>1. Panduan & Layanan Direktorat Jenderal Pajak (DJP)</h3>
          <p style="color:#4b5563; line-height:1.6; font-size:0.92rem;">
            Direktorat Jenderal Pajak (DJP) menyediakan berbagai layanan yang dapat diakses masyarakat mulai dari pendaftaran NPWP, Pelaporan SPT Tahunan, hingga konsultasi perpajakan:
          </p>

          <h4>a. Cara Mendaftar dan Mengaktifkan Nomor Pokok Wajib Pajak (NPWP)</h4>
          <div class="step-list">
            <strong>📋 Dokumen yang Perlu Disiapkan:</strong>
            <ul>
              <li>Kartu Tanda Penduduk (KTP)</li>
              <li>Kartu Keluarga (KK)</li>
              <li>Nomor HP Aktif</li>
              <li>Alamat Email Aktif</li>
            </ul>

            <strong>💻 Langkah-Langkah Pendaftaran Online:</strong>
            <ol>
              <li>Buka laman resmi Coretax DJP di <strong><a href="https://coretaxdjp.pajak.go.id" target="_blank" style="color:var(--color-accent); text-decoration:underline;">coretaxdjp.pajak.go.id</a></strong>, pastikan koneksi internet stabil lalu klik tombol <strong>“ Daftar di Sini ”</strong> untuk membuat akun baru.</li>
              <li>Pilih jenis wajib pajak yang ingin Anda daftarkan sesuai kategori, lalu pilih <strong>“ Ya, Wajib Pajak Memiliki NIK ”</strong>.</li>
              <li>Pilih menu <strong>“ Pendaftaran dengan Aktivasi NIK/Aktivasi NIK ”</strong>.</li>
              <li>Isikan data diri yang diminta dengan lengkap dan benar, saat mengisi pastikan NIK dan Nomor Kartu Keluarga sudah sesuai dengan data yang tercatat di Dukcapil.</li>
              <li>Unggah hasil pindaian atau foto dokumen yang diminta dengan jelas agar dapat terbaca sistem dan isi alamat domisili sesuai dokumen resmi.</li>
              <li>Pada tahap akhir, sistem akan meminta pengguna melakukan verifikasi wajah sebagai bagian dari proses validasi identitas.</li>
            </ol>

            <strong>📬 Setelah Pendaftaran / Aktivasi Akun Coretax:</strong>
            <p style="margin-top:6px; font-size:0.9rem; color:#4b5563;">
              NPWP biasanya terbit dalam 1-3 hari kerja setelah data disubmit. Kartu NPWP elektronik akan dikirim langsung ke email yang didaftarkan.
            </p>

            <strong style="margin-top:10px; display:block;">🔑 Langkah-Langkah Aktivasi:</strong>
            <ol>
              <li>Buka laman resmi Coretax DJP di <strong>coretaxdjp.pajak.go.id</strong>, klik tombol <strong>“ Belum Aktivasi? ”</strong>.</li>
              <li>Centang <strong>“ Apakah Wajib Pajak sudah terdaftar? ”</strong>.</li>
              <li>Isikan NIK yang terdaftar lalu klik <strong>“ Cari ”</strong> lalu verifikasi wajah dengan mengikuti instruksi.</li>
              <li>Masukkan email dan nomor HP yang aktif, centang pernyataan lalu klik <strong>“ Simpan ”</strong>.</li>
              <li>Masuk (login) menggunakan informasi nama pengguna (username) dan kata sandi (password) yang dikirimkan melalui email.</li>
            </ol>
          </div>

          <h4>b. Surat Pemberitahuan (SPT)</h4>
          <p style="color:#4b5563; line-height:1.6; font-size:0.92rem; margin-bottom:10px;">
            Surat Pemberitahuan (SPT) merupakan dokumen resmi yang digunakan oleh Wajib Pajak di Indonesia untuk melaporkan perhitungan pajak, pembayaran pajak, harta dan kewajiban sesuai undang-undang perpajakan.
          </p>

          <div class="step-list">
            <strong>📅 Jenis-jenis SPT:</strong>
            <ul>
              <li><strong>SPT Tahunan</strong>: Dilaporkan setahun sekali (SPT Tahunan Orang Pribadi batas lapor <span class="highlight-badge">31 Maret</span> dan SPT Tahunan Badan batas lapor <span class="highlight-badge">30 April</span>).</li>
              <li><strong>SPT Masa</strong>: Digunakan untuk melaporkan pajak yang dipotong/dipungut setiap bulannya (misalnya PPh Pasal 21 atau PPN).</li>
            </ul>

            <strong>📝 Langkah-langkah Lapor SPT di Coretax:</strong>
            <ol>
              <li>Login ke akun Coretax di <strong>pajak.go.id</strong> lalu buka menu <strong>Surat Pemberitahuan (SPT)</strong>.</li>
              <li>Klik <strong>“ Buat Konsep SPT ”</strong> lalu pilih jenis SPT sesuai kebutuhan lalu klik lanjut.</li>
              <li>Pilih jenis periode SPT Tahunan/Masa lalu masukkan periode dan tahun pajak, klik lanjut.</li>
              <li>Pilih model SPT – Normal untuk pelaporan pertama kali (atau Pembetulan jika ingin membetulkan SPT).</li>
              <li>Klik <strong>“ Buat Konsep SPT ”</strong>, lalu klik ikon pensil untuk mulai mengisi formulir SPT.</li>
              <li>Klik tombol <strong>“ Posting ”</strong> dan sistem akan otomatis mengisi sebagian data berdasarkan data terdaftar di DJP.</li>
              <li>Periksa kembali seluruh data (harta, utang, tanggungan), lalu klik <strong>“ Bayar dan Lapor ”</strong> dan isi tanda tangan digital.</li>
              <li>Klik <strong>“ Simpan dan Konfirmasi Tanda Tangan ”</strong> untuk menyelesaikan proses. Bukti Penerimaan Elektronik (BPE) dapat diunduh sebagai bukti sah.</li>
            </ol>
          </div>

          <!-- SECTION 2 -->
          <h3>2. Informasi Pajak Daerah (PBB Kabupaten Boyolali)</h3>
          <p style="color:#4b5563; line-height:1.7; font-size:0.93rem;">
            Selain pajak pusat, pajak daerah yang paling sering bersinggungan langsung dengan warga desa adalah <strong>Pajak Bumi dan Bangunan (PBB)</strong>. Setiap tahun, warga yang memiliki tanah dan/atau bangunan wajib membayar PBB sesuai SPPT yang diterbitkan pemerintah daerah.
          </p>
          <div class="step-list">
            <ul>
              <li><strong>Batas Waktu Pembayaran PBB</strong>: Jatuh sekitar akhir <span class="highlight-badge">Agustus atau September</span> setiap tahunnya (bisa dicek di SPPT masing-masing).</li>
              <li><strong>Denda Keterlambatan</strong>: Dikenakan denda sebesar <strong>2% per bulan</strong> dari jumlah pajak yang terutang.</li>
              <li><strong>Pajak Usaha Daerah Lainnya</strong>: Usaha rumah makan (pajak restoran), reklame usaha, atau penggunaan air tanah usaha dapat berkonsultasi ke <strong>Badan Pendapatan Daerah (Bapenda) Kabupaten Boyolali</strong>.</li>
            </ul>
          </div>

          <!-- SECTION 3 -->
          <h3>3. Cara Mudah Cek & Bayar Pajak Online</h3>
          <div class="step-list">
            <p style="color:#4b5563; font-size:0.92rem; line-height:1.6;">
              Untuk PBB, tagihan bisa dicek lewat website pajak daerah setempat dengan menyiapkan nomor SPPT / Nomor Objek Pajak (NOP) 18 digit, atau bertanya langsung ke perangkat desa. Pembayaran bisa dilakukan via Bank, ATM, Minimarket, Kantor Pos, hingga Mobile Banking.
            </p>
          </div>

          <!-- SECTION 4 -->
          <h3>4. Jadwal Pelayanan & Lokasi Bantuan Pajak</h3>
          <p style="color:#4b5563; font-size:0.92rem;">Bagi warga Desa Munggur yang membutuhkan bantuan langsung terkait perpajakan, lokasi berikut dapat dikunjungi:</p>
          <div class="step-list">
            <ul>
              <li>🏢 <strong>Kantor Balai Desa Munggur</strong>: Senin – Jumat (08.00 – 15.00 WIB)</li>
              <li>🏛️ <strong>Kantor Pelayanan Pajak (KPP) Pratama Boyolali</strong></li>
              <li>🏛️ <strong>Kantor Badan Pendapatan Daerah (Bapenda) Kabupaten Boyolali</strong></li>
              <li>📞 <strong>Kring Pajak DJP</strong>: Call Center <strong>1500200</strong> (Semua layanan gratis)</li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <!-- MODAL POPUP: TEMPLATE PEMBUKUAN KEUANGAN UMKM -->
    <div class="modal-overlay" id="umkmModal" onclick="closeModalOnOverlay(event, 'umkmModal')">
      <div class="modal-large-box">
        <button class="modal-close-btn" onclick="closeModal('umkmModal')">&times;</button>
        
        <div style="margin-bottom:20px;">
          <span class="tag-badge">Pemberdayaan UMKM Desa Munggur</span>
          <h2 style="font-size:1.6rem; font-weight:800; color:var(--color-primary); margin-top:4px;">
            Pentingnya Pembukuan Keuangan Untuk UMKM
          </h2>
          <p style="color:#6b7280; font-size:0.9rem;">Panduan Pencatatan Pembukuan Arus Kas Praktis Harian Pelaku Usaha Desa Munggur</p>
        </div>

        <div class="pojok-pajak-content">
          
          <p style="color:#4b5563; line-height:1.75; font-size:0.96rem;">
            <strong>Pembukuan</strong> adalah kegiatan mencatat semua transaksi keuangan usaha secara rutin dan teratur, baik uang yang masuk dari hasil penjualan maupun uang yang keluar untuk kebutuhan usaha.
          </p>

          <!-- 🎯 TUJUAN PEMBUKUAN -->
          <h3>🎯 Tujuan Pembukuan</h3>
          <div class="step-list">
            <ol>
              <li><strong>Mengetahui Keuntungan / Kerugian</strong>: Mengetahui secara tepat apakah usaha sedang untung atau rugi.</li>
              <li><strong>Pelacakan Arus Kas</strong>: Mengetahui dengan jelas ke mana saja uang usaha digunakan.</li>
              <li><strong>Pertanggungjawaban Keuangan</strong>: Menjadi catatan yang bisa dipertanggungjawabkan sewaktu-waktu diperlukan.</li>
            </ol>
          </div>

          <!-- 💡 MANFAAT PEMBUKUAN -->
          <h3>💡 Manfaat Pembukuan</h3>
          <div class="step-list">
            <ol>
              <li><strong>Pengaturan Tertata</strong>: Membantu mengatur keuangan usaha jadi lebih tertata.</li>
              <li><strong>Kemudahan Pinjaman Modal</strong>: Memudahkan saat ingin mengajukan pinjaman modal ke bank atau lembaga keuangan lain.</li>
              <li><strong>Pengambilan Keputusan Tepat</strong>: Membantu pelaku usaha mengambil keputusan dengan lebih yakin, misalnya kapan waktu yang tepat menambah modal usaha.</li>
            </ol>
          </div>

          <p style="color:#4b5563; line-height:1.7; font-size:0.94rem; background:#f9fafb; border:1.5px solid #e5e7eb; border-radius:12px; padding:16px 20px;">
            💬 <em>"Pembukuan yang baik tidak perlu rumit. Pencatatan cukup diisi setiap hari dengan tertib agar pelaku usaha dapat melihat kondisi keuangan usahanya dengan jelas."</em>
          </p>

          <!-- 📥 TOMBOL DOWNLOAD SPREADSHEET GOOGLE DRIVE -->
          <div style="text-align:center; margin-top:28px;">
            <a href="https://docs.google.com/spreadsheets/d/15QynAgroDun5liSqWUW48TXjaSoHrYZK/edit?usp=sharing&ouid=118271527724657768905&rtpof=true&sd=true" target="_blank" class="btn-download-excel">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Unduh / Akses Template Pembukuan UMKM (Google Spreadsheet / Excel)
            </a>
          </div>

          <!-- 📌 SUMBER REFERENSI -->
          <div class="source-box">
            <strong>Sumber Referensi Resmi:</strong><br />
            1. Pentingnya Pembukuan Keuangan Untuk UMKM – <a href="https://www.djkn.kemenkeu.go.id/kpknl-semarang/baca-artikel/16388/Pentingnya-Pembukuan-Keuangan-Untuk-UMKM.html" target="_blank">KPKNL Semarang Direktorat Jenderal Kekayaan Negara (DJKN) Kemenkeu</a><br />
            2. 10 Alasan Pentingnya Pembukuan Bagi UMKM – <a href="https://accurate.id/akuntansi/pentingnya-pembukuan-bagi-umkm-di-indonesia/" target="_blank">Accurate ID</a>
          </div>

        </div>
      </div>
    </div>

@endsection

@section('scripts')
<script>
  function openPajakModal() {
    document.getElementById('pajakModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function openUmkmModal() {
    document.getElementById('umkmModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('open');
    document.body.style.overflow = 'auto';
  }

  function closeModalOnOverlay(e, modalId) {
    if (e.target.classList.contains('modal-overlay')) {
      closeModal(modalId);
    }
  }
</script>
@endsection

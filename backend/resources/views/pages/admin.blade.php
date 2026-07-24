<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Admin - Desa Munggur</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #f0f2f5; color: #1a1a1a; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }

    /* ---- SIDEBAR ---- */
    .admin-layout { display: flex; min-height: 100vh; }

    .sidebar {
      width: 240px;
      background: #111;
      color: #fafafa;
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 100;
      overflow-y: auto;
    }

    .sidebar-brand {
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .sidebar-brand-name { font-size: 0.9rem; font-weight: 700; }
    .sidebar-brand-sub { font-size: 0.7rem; color: #9ca3af; margin-top: 2px; }

    .sidebar-nav { padding: 12px 0; flex: 1; }
    .sidebar-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; color: #6b7280; padding: 10px 20px 4px; }
    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 20px;
      font-size: 0.82rem;
      font-weight: 500;
      color: #d1d5db;
      cursor: pointer;
      border-radius: 0;
      transition: background 0.18s, color 0.18s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
    }
    .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.08); color: #fff; }
    .sidebar-link.active { border-left: 3px solid #2d6a4f; padding-left: 17px; }

    .sidebar-footer {
      padding: 16px 20px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }
    .btn-logout {
      width: 100%;
      padding: 9px;
      background: rgba(220, 38, 38, 0.15);
      color: #fca5a5;
      border: 1px solid rgba(220,38,38,0.25);
      border-radius: 8px;
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      font-family: inherit;
      transition: background 0.2s;
    }
    .btn-logout:hover { background: rgba(220,38,38,0.28); }

    /* ---- MAIN CONTENT ---- */
    .admin-main {
      margin-left: 240px;
      flex: 1;
      padding: 32px;
      min-height: 100vh;
    }

    .admin-topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px;
    }

    .admin-page-title { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.02em; }
    .admin-user-info { font-size: 0.8rem; color: #6c757d; }

    /* ---- TABS ---- */
    .admin-section { display: none; }
    .admin-section.active { display: block; }

    /* ---- CARDS ---- */
    .admin-card {
      background: #fff;
      border: 1.5px solid #e5e7eb;
      border-radius: 14px;
      padding: 24px;
      margin-bottom: 20px;
    }
    .admin-card-title {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* ---- FORM ELEMENTS ---- */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .form-row.one-col { grid-template-columns: 1fr; }
    .form-row.three-col { grid-template-columns: 1fr 1fr 1fr; }

    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-label { font-size: 0.78rem; font-weight: 600; color: #374151; }
    .form-input, .form-textarea, .form-select {
      padding: 10px 13px;
      border: 1.5px solid #e5e7eb;
      border-radius: 8px;
      font-size: 0.875rem;
      font-family: inherit;
      color: #1a1a1a;
      background: #fff;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      width: 100%;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus {
      border-color: #2d6a4f;
      box-shadow: 0 0 0 3px rgba(45,106,79,0.10);
    }
    .form-textarea { min-height: 80px; resize: vertical; }
    .form-hint { font-size: 0.72rem; color: #9ca3af; margin-top: -2px; }

    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 20px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; transition: all 0.2s; }
    .btn-primary { background: #2d6a4f; color: #fff; }
    .btn-primary:hover { background: #1b4332; }
    .btn-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .btn-danger:hover { background: #dc2626; color: #fff; }
    .btn-secondary { background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }
    .btn-secondary:hover { background: #e5e7eb; }
    .btn-sm { padding: 6px 14px; font-size: 0.75rem; }

    .btn-row { display: flex; gap: 10px; margin-top: 16px; align-items: center; }

    /* ---- TABLE ---- */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th {
      text-align: left;
      font-size: 0.72rem;
      font-weight: 700;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      padding: 10px 14px;
      border-bottom: 1.5px solid #e5e7eb;
    }
    .data-table td {
      padding: 12px 14px;
      font-size: 0.82rem;
      border-bottom: 1px solid #f3f4f6;
      color: #374151;
      vertical-align: middle;
    }
    .data-table tr:hover td { background: #f9fafb; }
    .data-table .td-img { width: 52px; height: 52px; object-fit: cover; border-radius: 8px; background: #f0f0f0; }
    .data-table .td-actions { display: flex; gap: 8px; }

    /* ---- ORG FORM ---- */
    .org-member-list { display: flex; flex-direction: column; gap: 14px; }
    .org-member-card {
      background: #f9fafb;
      border: 1.5px solid #e5e7eb;
      border-radius: 10px;
      padding: 16px;
    }
    .org-member-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
    .org-member-title { font-size: 0.85rem; font-weight: 700; color: #1a1a1a; }

    /* ---- BADGE ---- */
    .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 600; }
    .badge-green { background: rgba(45,106,79,0.1); color: #2d6a4f; }
    .badge-gray { background: #f3f4f6; color: #6b7280; }

    /* ---- TOAST ---- */
    .toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #1a1a1a;
      color: #fff;
      padding: 12px 20px;
      border-radius: 10px;
      font-size: 0.82rem;
      font-weight: 500;
      z-index: 9999;
      opacity: 0;
      transform: translateY(12px);
      transition: all 0.3s ease;
      pointer-events: none;
    }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: #2d6a4f; }
    .toast.error { background: #dc2626; }

    /* ---- LOADING ---- */
    .loading-spinner {
      display: inline-block;
      width: 18px; height: 18px;
      border: 2.5px solid rgba(255,255,255,0.3);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 0.6s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    .empty-state { text-align: center; padding: 40px; color: #9ca3af; font-size: 0.85rem; }

    @media (max-width: 768px) {
      .sidebar { width: 100%; position: relative; }
      .admin-main { margin-left: 0; padding: 20px 16px; }
      .admin-layout { flex-direction: column; }
      .form-row { grid-template-columns: 1fr; }
      .form-row.three-col { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body style="display: none;">

<div class="admin-layout">
  <!-- Sidebar -->
  <aside class="sidebar" id="admin-sidebar">
    <div class="sidebar-brand">
      <p class="sidebar-brand-name">Admin Panel</p>
      <p class="sidebar-brand-sub">Desa Munggur</p>
    </div>
    <nav class="sidebar-nav">
      <p class="sidebar-label">Kelola Data</p>
      <button class="sidebar-link active" id="tab-umkm-btn" onclick="showTab('umkm')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        UMKM
      </button>
      <button class="sidebar-link" id="tab-struktur-btn" onclick="showTab('struktur')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="8" y="2" width="8" height="4" rx="1"/><rect x="1" y="14" width="6" height="4" rx="1"/><rect x="9" y="14" width="6" height="4" rx="1"/><rect x="17" y="14" width="6" height="4" rx="1"/><path d="M12 6v4M4 14v-2h16v2"/></svg>
        Struktur Desa
      </button>

      <p class="sidebar-label">Navigasi</p>
      <a class="sidebar-link" href="/" target="_blank">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        Lihat Website
      </a>
    </nav>
    <div class="sidebar-footer">
      <p style="font-size:0.7rem;color:#6b7280;margin-bottom:8px;" id="admin-email-display">â€”</p>
      <button class="btn-logout" id="btn-logout">Keluar / Logout</button>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="admin-main">
    <div class="admin-topbar">
      <div>
        <p class="admin-page-title" id="admin-page-title">Kelola UMKM</p>
        <p class="admin-user-info">Panel Administrator Desa Munggur</p>
      </div>
    </div>

    <!-- ===== TAB: UMKM ===== -->
    <div class="admin-section active" id="section-umkm">

      <!-- Tambah UMKM Form -->
      <div class="admin-card">
        <p class="admin-card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah / Edit UMKM
        </p>

        <input type="hidden" id="umkm-edit-id" value="" />

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Nama UMKM *</label>
            <input type="text" class="form-input" id="umkm-nama" placeholder="Contoh: Warung Bu Sari" />
          </div>
          <div class="form-group">
            <label class="form-label">Kategori *</label>
            <select class="form-select" id="umkm-kategori">
              <option value="">-- Pilih Kategori --</option>
              <option value="Kuliner">Kuliner</option>
              <option value="Kerajinan">Kerajinan</option>
              <option value="Pertanian">Pertanian</option>
              <option value="Perdagangan">Perdagangan</option>
              <option value="Jasa">Jasa</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
        </div>

        <div class="form-row one-col">
          <div class="form-group">
            <label class="form-label">Deskripsi Usaha *</label>
            <textarea class="form-textarea" id="umkm-deskripsi" placeholder="Deskripsi singkat mengenai produk atau keunggulan usaha..."></textarea>
          </div>
        </div>

        <div class="form-row one-col">
          <div class="form-group">
            <label class="form-label">Alamat Lengkap *</label>
            <input type="text" class="form-input" id="umkm-alamat" placeholder="Contoh: RT 02 / RW 01, Dukuh Munggur" />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Harga / Rentang Harga</label>
            <input type="text" class="form-input" id="umkm-harga" placeholder="Contoh: Rp 5.000 - Rp 20.000" />
          </div>
          <div class="form-group">
            <label class="form-label">Kontak (WhatsApp/Telepon) *</label>
            <input type="text" class="form-input" id="umkm-kontak" placeholder="Contoh: 0812-3456-7890" />
          </div>
        </div>

        <div class="form-row one-col">
          <div class="form-group">
            <label class="form-label">Upload Foto Produk (Maks 2MB) *</label>
            <input type="file" id="umkm-image-file" accept="image/*" class="form-input" onchange="uploadImage(this, 'umkm')" />
            <div id="umkm-upload-progress" class="form-hint" style="display:none; color: #2d6a4f; font-weight: 600; margin-top: 4px;">Mengunggah: 0%</div>
            <input type="hidden" id="umkm-image" />
            <div id="umkm-image-preview" style="margin-top: 12px; display: none;">
              <img id="umkm-preview-img" src="" style="max-height: 120px; border-radius: 8px; object-fit: cover; border: 1.5px solid #e5e7eb;" alt="Preview Foto Produk" />
            </div>
          </div>
        </div>

        <div class="btn-row">
          <button class="btn btn-primary" id="btn-save-umkm" onclick="saveUmkm()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Simpan UMKM
          </button>
          <button class="btn btn-secondary" onclick="resetUmkmForm()">Batal / Reset</button>
        </div>
      </div>

      <!-- Daftar UMKM -->
      <div class="admin-card">
        <p class="admin-card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          Daftar UMKM Terdaftar
        </p>
        <div id="umkm-table-wrap">
          <p class="empty-state">Memuat data...</p>
        </div>
      </div>
    </div>

    <!-- ===== TAB: STRUKTUR DESA ===== -->
    <div class="admin-section" id="section-struktur">

      <div class="admin-card">
        <p class="admin-card-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2"><rect x="8" y="2" width="8" height="4" rx="1"/><rect x="1" y="14" width="6" height="4" rx="1"/><rect x="9" y="14" width="6" height="4" rx="1"/><rect x="17" y="14" width="6" height="4" rx="1"/><path d="M12 6v4M4 14v-2h16v2"/></svg>
          Input Perangkat Desa
        </p>
        <p style="font-size:0.82rem;color:#6c757d;margin-bottom:20px;">Isi data perangkat desa di bawah ini. Klik "Simpan" untuk menyimpan ke database.</p>

        <div class="org-member-list" id="perangkat-list">
          <!-- Diisi dinamis oleh JS -->
        </div>
      </div>
    </div>



  </main>
</div>

<!-- Toast Notifikasi -->
<div class="toast" id="toast"></div>

<!-- API Service -->
<script src="/assets/js/api.service.js"></script>

<script>
  // ============================================================
  // AUTH GUARD â€” Redirect ke login jika belum login
  // ============================================================
  if (!Api.isLoggedIn()) {
    window.location.href = 'login.html';
  } else {
    // Verifikasi token
    Api.get('/check-token')
      .then(res => {
        document.getElementById('admin-email-display').textContent = res.user.email;
        loadUmkm();
        loadPerangkat();
        // Tampilkan halaman setelah token terverifikasi sukses
        document.body.style.display = 'block';
      })
      .catch(() => {
        Api.removeToken();
        window.location.href = 'login.html';
      });
  }

  // Logout
  document.getElementById('btn-logout').addEventListener('click', () => {
    Api.post('/logout', {}).finally(() => {
      Api.removeToken();
      window.location.href = 'login.html';
    });
  });

  // ============================================================
  // TAB SWITCHING
  // ============================================================
  function showTab(tab) {
    document.querySelectorAll('.admin-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
    document.getElementById('section-' + tab).classList.add('active');
    document.getElementById('tab-' + tab + '-btn').classList.add('active');
    const titles = { 
      umkm: 'Kelola UMKM', 
      struktur: 'Struktur Desa',
      kebudayaan: 'Kelola Budaya & Wisata',
      kuliner: 'Kelola Kuliner Lokal',
      komoditas: 'Kelola Komoditas'
    };
    document.getElementById('admin-page-title').textContent = titles[tab] || '';
  }

  // ============================================================
  // TOAST
  // ============================================================
  function showToast(msg, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.className = 'toast show ' + type;
    setTimeout(() => { toast.classList.remove('show'); }, 3000);
  }

  // ============================================================
  // UMKM â€” CRUD
  // ============================================================
  async function uploadImage(input, folder) {
    const file = input.files[0];
    if (!file) return;

    // Validasi Ukuran (Maksimal 2MB)
    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
      showToast('Ukuran file maksimal 2MB!', 'error');
      input.value = ''; // Reset input
      return;
    }

    // Validasi Tipe File (Harus gambar)
    if (!file.type.startsWith('image/')) {
      showToast('File harus berupa gambar (JPG, PNG, WebP, dll)!', 'error');
      input.value = '';
      return;
    }

    const progressDiv = document.getElementById(`${folder}-upload-progress`);
    const urlInput = document.getElementById(`${folder}-image`);
    const previewDiv = document.getElementById(`${folder}-image-preview`);
    const previewImg = document.getElementById(`${folder}-preview-img`);

    progressDiv.style.display = 'block';
    progressDiv.textContent = 'Mengunggah gambar...';
    progressDiv.style.color = '#2d6a4f';

    try {
      const result = await Api.uploadImage(file);
      if (result.success) {
        const downloadURL = result.data.url;
        urlInput.value = downloadURL;
        
        // Tampilkan preview
        if (previewDiv && previewImg) {
          previewImg.src = downloadURL;
          previewDiv.style.display = 'block';
        }
        
        progressDiv.textContent = 'Unggah selesai!';
        progressDiv.style.color = '#2d6a4f';
        showToast('Foto berhasil diunggah!');
      } else {
        throw new Error(result.message || 'Gagal mengunggah.');
      }
    } catch (error) {
      showToast('Gagal mengunggah foto: ' + error.message, 'error');
      progressDiv.style.color = '#dc2626';
      progressDiv.textContent = 'Gagal mengunggah.';
    }
  }

  function resetUmkmForm() {
    document.getElementById('umkm-edit-id').value = '';
    document.getElementById('umkm-nama').value = '';
    document.getElementById('umkm-kategori').value = '';
    document.getElementById('umkm-deskripsi').value = '';
    document.getElementById('umkm-alamat').value = '';
    document.getElementById('umkm-harga').value = '';
    document.getElementById('umkm-kontak').value = '';
    document.getElementById('umkm-image').value = '';
    
    // Reset file input & preview
    const fileInput = document.getElementById('umkm-image-file');
    if (fileInput) fileInput.value = '';
    const progressDiv = document.getElementById('umkm-upload-progress');
    if (progressDiv) progressDiv.style.display = 'none';
    const previewDiv = document.getElementById('umkm-image-preview');
    if (previewDiv) previewDiv.style.display = 'none';
    const previewImg = document.getElementById('umkm-preview-img');
    if (previewImg) previewImg.src = '';
    
    document.getElementById('btn-save-umkm').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan UMKM
    `;
  }

  function editUmkm(id, data) {
    document.getElementById('umkm-edit-id').value = id;
    document.getElementById('umkm-nama').value = data.nama || '';
    document.getElementById('umkm-kategori').value = data.kategori || '';
    document.getElementById('umkm-deskripsi').value = data.deskripsi || '';
    document.getElementById('umkm-alamat').value = data.alamat || '';
    document.getElementById('umkm-harga').value = data.harga || '';
    document.getElementById('umkm-kontak').value = data.kontak || '';
    
    const imgUrl = data.image_url || data.imageUrl || '';
    document.getElementById('umkm-image').value = imgUrl;
    
    const previewDiv = document.getElementById('umkm-image-preview');
    const previewImg = document.getElementById('umkm-preview-img');
    if (imgUrl) {
      previewImg.src = imgUrl;
      previewDiv.style.display = 'block';
    } else {
      previewDiv.style.display = 'none';
    }
    
    document.getElementById('btn-save-umkm').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Update UMKM
    `;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteUmkm(id, nama) {
    if (!confirm(`Hapus UMKM "${nama}"? Tindakan ini tidak bisa dibatalkan.`)) return;
    try {
      await Api.delete(`/umkm/${id}`);
      showToast('UMKM berhasil dihapus.');
      loadUmkm();
    } catch (e) {
      showToast('Gagal menghapus: ' + e.message, 'error');
    }
  }

  async function saveUmkm() {
    const nama = document.getElementById('umkm-nama').value.trim();
    const kategori = document.getElementById('umkm-kategori').value;
    const deskripsi = document.getElementById('umkm-deskripsi').value.trim();
    const alamat = document.getElementById('umkm-alamat').value.trim();
    const harga = document.getElementById('umkm-harga').value.trim();
    const kontak = document.getElementById('umkm-kontak').value.trim();
    const imageUrl = document.getElementById('umkm-image').value.trim();
    const editId = document.getElementById('umkm-edit-id').value;

    if (!nama || !deskripsi || !alamat || !kontak) {
      showToast('Nama, deskripsi, alamat, dan kontak wajib diisi!', 'error');
      return;
    }

    const btn = document.getElementById('btn-save-umkm');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';

    const data = { nama, kategori, deskripsi, alamat, harga, kontak, imageUrl };

    try {
      if (editId) {
        await Api.put(`/umkm/${editId}`, data);
        showToast('UMKM berhasil diupdate!');
      } else {
        await Api.post('/umkm', data);
        showToast('UMKM berhasil ditambahkan!');
      }
      resetUmkmForm();
      loadUmkm();
    } catch (e) {
      showToast('Gagal menyimpan: ' + e.message, 'error');
    }

    btn.disabled = false;
    btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan UMKM`;
  }

  function loadUmkm() {
    const wrap = document.getElementById('umkm-table-wrap');
    wrap.innerHTML = '<p class="empty-state">Memuat data...</p>';

    Api.get('/umkm').then((data) => {
      if (!data || data.length === 0) {
        wrap.innerHTML = '<p class="empty-state">Belum ada data UMKM. Tambahkan di atas.</p>';
        return;
      }

      let rows = '';
      data.forEach((d) => {
        rows += `
          <tr>
            <td>
              <div style="position:relative; width:52px; height:52px; background:#f0f2f5; border-radius:8px; overflow:hidden;">
                <img src="${d.image_url || d.imageUrl || ''}" alt="${d.nama}" style="width:100%; height:100%; object-fit:cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div style="display:none; width:100%; height:100%; align-items:center; justify-content:center;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
              </div>
            </td>
            <td><strong>${d.nama || 'â€”'}</strong></td>
            <td><span class="badge badge-green">${d.kategori || 'â€”'}</span></td>
            <td>${d.alamat || 'â€”'}</td>
            <td>${d.harga || 'â€”'}</td>
            <td>${d.kontak || 'â€”'}</td>
            <td>
              <div class="td-actions">
                <button class="btn btn-secondary btn-sm" onclick='editUmkm(${d.id}, ${JSON.stringify(d).replace(/'/g, "&apos;")})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteUmkm(${d.id}, '${d.nama?.replace(/'/g, "\\'")}')">Hapus</button>
              </div>
            </td>
          </tr>
        `;
      });

      wrap.innerHTML = `
        <table class="data-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Alamat</th>
              <th>Harga</th>
              <th>Kontak</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>${rows}</tbody>
        </table>
      `;
    }).catch((e) => {
      wrap.innerHTML = `<p class="empty-state" style="color:#dc2626">Gagal memuat data: ${e.message}</p>`;
    });
  }

  // ============================================================
  // STRUKTUR DESA â€” Input Perangkat (Fixed 5 Jabatan)
  // ============================================================
  const jabatanPemdes = [
    'Kepala Desa',
    'Sekretaris Desa',
    'Kepala Urusan Umum dan Perencanaan',
    'Kepala Urusan Keuangan',
    'Kasi Kesra dan Pelayanan',
    'Kasi Pemerintahan',
    'Kepala Dusun I',
    'Kepala Dusun II',
    'Kepala Dusun III'
  ];

  const jabatanBpd = [
    'Ketua',
    'Wakil Ketua',
    'Sekretaris',
    'Bid. Pemdes & Binmas',
    'Bid. Bangdes & Permasdes'
  ];

  let perangkatData = {};

  function buildPerangkatCard(jabatan, index, data) {
    const imgUrl = (data && (data.image_url || data.imageUrl)) || '';
    return `
      <div class="org-member-card" id="perangkat-card-${index}">
        <div class="org-member-header">
          <p class="org-member-title">${jabatan}</p>
        </div>
        <div class="form-row three-col">
          <div class="form-group">
            <label class="form-label">Jabatan</label>
            <input type="text" class="form-input jabatan-input" data-index="${index}" value="${jabatan}" readonly style="background-color: #f3f4f6; cursor: not-allowed;" />
          </div>
          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" class="form-input nama-input" data-index="${index}" value="${(data && data.nama) || ''}" placeholder="Nama perangkat desa" />
          </div>
          <div class="form-group">
            <label class="form-label">Foto Perangkat</label>
            <div style="display: flex; gap: 8px; align-items: center;">
              <input type="file" accept="image/*" class="form-input" style="padding: 4px;" onchange="uploadPerangkatImage(this, ${index})" />
              <input type="hidden" class="foto-input" data-index="${index}" value="${imgUrl}" />
            </div>
            <div class="foto-preview-container" style="margin-top: 8px; display: ${imgUrl ? 'block' : 'none'};">
              <img class="foto-preview-img" src="${imgUrl}" style="max-height: 50px; border-radius: 4px; object-fit: cover;" />
            </div>
            <div class="upload-hint" style="font-size: 0.75rem; color: #2d6a4f; font-weight: 600; display: none;">Mengunggah...</div>
          </div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="savePerangkat(${index})">
          Simpan Perangkat Ini
        </button>
      </div>
    `;
  }

  async function uploadPerangkatImage(input, index) {
    const file = input.files[0];
    if (!file) return;

    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
      showToast('Ukuran file maksimal 2MB!', 'error');
      input.value = '';
      return;
    }

    if (!file.type.startsWith('image/')) {
      showToast('File harus berupa gambar (JPG, PNG, WebP, dll)!', 'error');
      input.value = '';
      return;
    }

    const card = document.getElementById('perangkat-card-' + index);
    const hint = card.querySelector('.upload-hint');
    const urlInput = card.querySelector('.foto-input');
    const previewContainer = card.querySelector('.foto-preview-container');
    const previewImg = card.querySelector('.foto-preview-img');

    hint.style.display = 'block';
    hint.textContent = 'Mengunggah...';
    hint.style.color = '#2d6a4f';

    try {
      const result = await Api.uploadImage(file);
      if (result.success) {
        urlInput.value = result.data.url;
        previewImg.src = result.data.url;
        previewContainer.style.display = 'block';
        hint.textContent = 'Selesai!';
        showToast('Foto perangkat desa berhasil diunggah!');
      } else {
        throw new Error(result.message);
      }
    } catch (e) {
      hint.textContent = 'Gagal!';
      hint.style.color = '#dc2626';
      showToast('Gagal mengunggah foto: ' + e.message, 'error');
    }
  }

  async function savePerangkat(index) {
    const card = document.getElementById('perangkat-card-' + index);
    const jabatan = card.querySelector('.jabatan-input').value;
    const nama = card.querySelector('.nama-input').value.trim();
    const imageUrl = card.querySelector('.foto-input').value.trim();

    if (!jabatan || !nama) {
      showToast('Jabatan dan nama wajib diisi!', 'error');
      return;
    }

    try {
      await Api.post('/perangkat-desa', { jabatan, nama, imageUrl, image_url: imageUrl });
      showToast(`${jabatan} berhasil disimpan!`);
      perangkatData[jabatan] = { nama, image_url: imageUrl, imageUrl: imageUrl };
    } catch (e) {
      showToast('Gagal menyimpan: ' + e.message, 'error');
    }
  }

  function loadPerangkat() {
    Api.get('/perangkat-desa').then((data) => {
      const list = document.getElementById('perangkat-list');
      list.innerHTML = '';
      
      perangkatData = {};
      
      // Default data kosong untuk seluruh jabatan standar
      const allJabatans = [...jabatanPemdes, ...jabatanBpd];
      allJabatans.forEach((jab) => {
        perangkatData[jab] = { nama: '', imageUrl: '' };
      });

      // Tindih dengan data dari DB jika ada
      if (data && data.length > 0) {
        data.forEach((item) => {
          perangkatData[item.jabatan] = item;
        });
      }

      // 1. Render Pemdes Section
      const h3Pemdes = document.createElement('h3');
      h3Pemdes.style.cssText = 'margin-top: 10px; margin-bottom: 16px; font-size: 1.1rem; color: #1b4332; border-bottom: 2px solid #2d6a4f; padding-bottom: 6px;';
      h3Pemdes.textContent = 'Pemerintah Desa (Pemdes)';
      list.appendChild(h3Pemdes);

      jabatanPemdes.forEach((jab, i) => {
        const card = document.createElement('div');
        card.innerHTML = buildPerangkatCard(jab, i, perangkatData[jab]);
        list.appendChild(card.firstElementChild);
      });

      // 2. Render BPD Section
      const h3Bpd = document.createElement('h3');
      h3Bpd.style.cssText = 'margin-top: 36px; margin-bottom: 16px; font-size: 1.1rem; color: #1b4332; border-bottom: 2px solid #2d6a4f; padding-bottom: 6px;';
      h3Bpd.textContent = 'Badan Permusyawaratan Desa (BPD)';
      list.appendChild(h3Bpd);

      jabatanBpd.forEach((jab, i) => {
        // Offset the index for BPD to avoid ID conflict
        const indexOffset = i + jabatanPemdes.length;
        const card = document.createElement('div');
        card.innerHTML = buildPerangkatCard(jab, indexOffset, perangkatData[jab]);
        list.appendChild(card.firstElementChild);
      });
    }).catch((e) => {
      showToast('Gagal memuat perangkat desa: ' + e.message, 'error');
    });
  }

  // ============================================================
  // KEBUDAYAAN & WISATA â€” CRUD
  // ============================================================
  function resetKebudayaanForm() {
    document.getElementById('kebudayaan-edit-id').value = '';
    document.getElementById('kebudayaan-nama').value = '';
    document.getElementById('kebudayaan-deskripsi').value = '';
    document.getElementById('kebudayaan-image').value = '';
    
    const fileInput = document.getElementById('kebudayaan-image-file');
    if (fileInput) fileInput.value = '';
    const progressDiv = document.getElementById('kebudayaan-upload-progress');
    if (progressDiv) progressDiv.style.display = 'none';
    const previewDiv = document.getElementById('kebudayaan-image-preview');
    if (previewDiv) previewDiv.style.display = 'none';
    const previewImg = document.getElementById('kebudayaan-preview-img');
    if (previewImg) previewImg.src = '';
    
    document.getElementById('btn-save-kebudayaan').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Data
    `;
  }

  function editKebudayaan(id, data) {
    document.getElementById('kebudayaan-edit-id').value = id;
    document.getElementById('kebudayaan-nama').value = data.nama_kegiatan || '';
    document.getElementById('kebudayaan-deskripsi').value = data.deskripsi || '';
    
    const imgUrl = data.image_url || data.imageUrl || '';
    document.getElementById('kebudayaan-image').value = imgUrl;
    
    const previewDiv = document.getElementById('kebudayaan-image-preview');
    const previewImg = document.getElementById('kebudayaan-preview-img');
    if (imgUrl) {
      previewImg.src = imgUrl;
      previewDiv.style.display = 'block';
    } else {
      previewDiv.style.display = 'none';
    }
    
    document.getElementById('btn-save-kebudayaan').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Update Data
    `;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteKebudayaan(id, nama) {
    if (!confirm(`Hapus data "${nama}"? Tindakan ini tidak bisa dibatalkan.`)) return;
    try {
      await Api.delete(`/kebudayaan/${id}`);
      showToast('Data berhasil dihapus.');
      loadKebudayaan();
    } catch (e) {
      showToast('Gagal menghapus: ' + e.message, 'error');
    }
  }

  async function saveKebudayaan() {
    const nama_kegiatan = document.getElementById('kebudayaan-nama').value.trim();
    const deskripsi = document.getElementById('kebudayaan-deskripsi').value.trim();
    const imageUrl = document.getElementById('kebudayaan-image').value.trim();
    const editId = document.getElementById('kebudayaan-edit-id').value;

    if (!nama_kegiatan || !deskripsi) {
      showToast('Nama kegiatan dan deskripsi wajib diisi!', 'error');
      return;
    }

    const btn = document.getElementById('btn-save-kebudayaan');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';

    const data = { nama_kegiatan, deskripsi, imageUrl };

    try {
      if (editId) {
        await Api.put(`/kebudayaan/${editId}`, data);
        showToast('Data berhasil diupdate!');
      } else {
        await Api.post('/kebudayaan', data);
        showToast('Data berhasil ditambahkan!');
      }
      resetKebudayaanForm();
      loadKebudayaan();
    } catch (e) {
      showToast('Gagal menyimpan: ' + e.message, 'error');
    }

    btn.disabled = false;
    btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Data`;
  }

  function loadKebudayaan() {
    const wrap = document.getElementById('kebudayaan-table-wrap');
    if (!wrap) return;
    wrap.innerHTML = '<p class="empty-state">Memuat data...</p>';

    Api.get('/kebudayaan').then((data) => {
      if (!data || data.length === 0) {
        wrap.innerHTML = '<p class="empty-state">Belum ada data kebudayaan & wisata. Tambahkan di atas.</p>';
        return;
      }

      let rows = '';
      data.forEach((d) => {
        rows += `
          <tr>
            <td>
              <div style="position:relative; width:52px; height:52px; background:#f0f2f5; border-radius:8px; overflow:hidden;">
                <img src="${d.image_url || d.imageUrl || ''}" alt="${d.nama_kegiatan}" style="width:100%; height:100%; object-fit:cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div style="display:none; width:100%; height:100%; align-items:center; justify-content:center;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
              </div>
            </td>
            <td><strong>${d.nama_kegiatan || 'â€”'}</strong></td>
            <td>${d.deskripsi ? (d.deskripsi.length > 80 ? d.deskripsi.substring(0, 80) + '...' : d.deskripsi) : 'â€”'}</td>
            <td>
              <div class="td-actions">
                <button class="btn btn-secondary btn-sm" onclick='editKebudayaan(${d.id}, ${JSON.stringify(d).replace(/'/g, "&apos;")})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteKebudayaan(${d.id}, '${d.nama_kegiatan?.replace(/'/g, "\\'")}')">Hapus</button>
              </div>
            </td>
          </tr>
        `;
      });

      wrap.innerHTML = `
        <table class="data-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama Kegiatan</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>${rows}</tbody>
        </table>
      `;
    }).catch((e) => {
      wrap.innerHTML = `<p class="empty-state" style="color: #dc2626;">Gagal memuat data: ${e.message}</p>`;
    });
  }

  // ============================================================
  // KULINER LOKAL â€” CRUD
  // ============================================================
  function resetKulinerForm() {
    document.getElementById('kuliner-edit-id').value = '';
    document.getElementById('kuliner-nama').value = '';
    document.getElementById('kuliner-deskripsi').value = '';
    document.getElementById('kuliner-alamat').value = '';
    document.getElementById('kuliner-image').value = '';
    
    const fileInput = document.getElementById('kuliner-image-file');
    if (fileInput) fileInput.value = '';
    const progressDiv = document.getElementById('kuliner-upload-progress');
    if (progressDiv) progressDiv.style.display = 'none';
    const previewDiv = document.getElementById('kuliner-image-preview');
    if (previewDiv) previewDiv.style.display = 'none';
    const previewImg = document.getElementById('kuliner-preview-img');
    if (previewImg) previewImg.src = '';
    
    document.getElementById('btn-save-kuliner').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Data
    `;
  }

  function editKuliner(id, data) {
    document.getElementById('kuliner-edit-id').value = id;
    document.getElementById('kuliner-nama').value = data.nama || '';
    document.getElementById('kuliner-deskripsi').value = data.deskripsi || '';
    document.getElementById('kuliner-alamat').value = data.alamat || '';
    
    const imgUrl = data.image_url || data.imageUrl || '';
    document.getElementById('kuliner-image').value = imgUrl;
    
    const previewDiv = document.getElementById('kuliner-image-preview');
    const previewImg = document.getElementById('kuliner-preview-img');
    if (imgUrl) {
      previewImg.src = imgUrl;
      previewDiv.style.display = 'block';
    } else {
      previewDiv.style.display = 'none';
    }
    
    document.getElementById('btn-save-kuliner').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Update Data
    `;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteKuliner(id, nama) {
    if (!confirm(`Hapus kuliner "${nama}"? Tindakan ini tidak bisa dibatalkan.`)) return;
    try {
      await Api.delete(`/kuliner/${id}`);
      showToast('Kuliner berhasil dihapus.');
      loadKuliner();
    } catch (e) {
      showToast('Gagal menghapus: ' + e.message, 'error');
    }
  }

  async function saveKuliner() {
    const nama = document.getElementById('kuliner-nama').value.trim();
    const deskripsi = document.getElementById('kuliner-deskripsi').value.trim();
    const alamat = document.getElementById('kuliner-alamat').value.trim();
    const imageUrl = document.getElementById('kuliner-image').value.trim();
    const editId = document.getElementById('kuliner-edit-id').value;

    if (!nama || !deskripsi || !alamat) {
      showToast('Nama kuliner, deskripsi, dan alamat wajib diisi!', 'error');
      return;
    }

    const btn = document.getElementById('btn-save-kuliner');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';

    const data = { nama, deskripsi, alamat, imageUrl };

    try {
      if (editId) {
        await Api.put(`/kuliner/${editId}`, data);
        showToast('Kuliner berhasil diupdate!');
      } else {
        await Api.post('/kuliner', data);
        showToast('Kuliner berhasil ditambahkan!');
      }
      resetKulinerForm();
      loadKuliner();
    } catch (e) {
      showToast('Gagal menyimpan: ' + e.message, 'error');
    }

    btn.disabled = false;
    btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Data`;
  }

  function loadKuliner() {
    const wrap = document.getElementById('kuliner-table-wrap');
    if (!wrap) return;
    wrap.innerHTML = '<p class="empty-state">Memuat data...</p>';

    Api.get('/kuliner').then((data) => {
      if (!data || data.length === 0) {
        wrap.innerHTML = '<p class="empty-state">Belum ada data kuliner lokal. Tambahkan di atas.</p>';
        return;
      }

      let rows = '';
      data.forEach((d) => {
        rows += `
          <tr>
            <td>
              <div style="position:relative; width:52px; height:52px; background:#f0f2f5; border-radius:8px; overflow:hidden;">
                <img src="${d.image_url || d.imageUrl || ''}" alt="${d.nama}" style="width:100%; height:100%; object-fit:cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div style="display:none; width:100%; height:100%; align-items:center; justify-content:center;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
              </div>
            </td>
            <td><strong>${d.nama || 'â€”'}</strong></td>
            <td>${d.alamat || 'â€”'}</td>
            <td>${d.deskripsi ? (d.deskripsi.length > 80 ? d.deskripsi.substring(0, 80) + '...' : d.deskripsi) : 'â€”'}</td>
            <td>
              <div class="td-actions">
                <button class="btn btn-secondary btn-sm" onclick='editKuliner(${d.id}, ${JSON.stringify(d).replace(/'/g, "&apos;")})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteKuliner(${d.id}, '${d.nama?.replace(/'/g, "\\'")}')">Hapus</button>
              </div>
            </td>
          </tr>
        `;
      });

      wrap.innerHTML = `
        <table class="data-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama Kuliner</th>
              <th>Alamat</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>${rows}</tbody>
        </table>
      `;
    }).catch((e) => {
      wrap.innerHTML = `<p class="empty-state" style="color: #dc2626;">Gagal memuat data: ${e.message}</p>`;
    });
  }

  // ============================================================
  // KOMODITAS â€” CRUD
  // ============================================================
  function resetKomoditasForm() {
    document.getElementById('komoditas-edit-id').value = '';
    document.getElementById('komoditas-nama').value = '';
    document.getElementById('komoditas-deskripsi').value = '';
    document.getElementById('komoditas-image').value = '';
    
    const fileInput = document.getElementById('komoditas-image-file');
    if (fileInput) fileInput.value = '';
    const progressDiv = document.getElementById('komoditas-upload-progress');
    if (progressDiv) progressDiv.style.display = 'none';
    const previewDiv = document.getElementById('komoditas-image-preview');
    if (previewDiv) previewDiv.style.display = 'none';
    const previewImg = document.getElementById('komoditas-preview-img');
    if (previewImg) previewImg.src = '';
    
    document.getElementById('btn-save-komoditas').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Data
    `;
  }

  function editKomoditas(id, data) {
    document.getElementById('komoditas-edit-id').value = id;
    document.getElementById('komoditas-nama').value = data.nama || '';
    document.getElementById('komoditas-deskripsi').value = data.deskripsi || '';
    document.getElementById('komoditas-image').value = data.imageUrl || '';
    
    const previewDiv = document.getElementById('komoditas-image-preview');
    const previewImg = document.getElementById('komoditas-preview-img');
    if (data.imageUrl) {
      previewImg.src = data.imageUrl;
      previewDiv.style.display = 'block';
    } else {
      previewDiv.style.display = 'none';
    }
    
    document.getElementById('btn-save-komoditas').innerHTML = `
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Update Data
    `;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  async function deleteKomoditas(id, nama) {
    if (!confirm(`Hapus komoditas "${nama}"? Tindakan ini tidak bisa dibatalkan.`)) return;
    try {
      await Api.delete(`/komoditas/${id}`);
      showToast('Komoditas berhasil dihapus.');
      loadKomoditas();
    } catch (e) {
      showToast('Gagal menghapus: ' + e.message, 'error');
    }
  }

  async function saveKomoditas() {
    const nama = document.getElementById('komoditas-nama').value.trim();
    const deskripsi = document.getElementById('komoditas-deskripsi').value.trim();
    const imageUrl = document.getElementById('komoditas-image').value.trim();
    const editId = document.getElementById('komoditas-edit-id').value;

    if (!nama || !deskripsi) {
      showToast('Nama komoditas dan deskripsi wajib diisi!', 'error');
      return;
    }

    const btn = document.getElementById('btn-save-komoditas');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';

    const data = { nama, deskripsi, imageUrl };

    try {
      if (editId) {
        await Api.put(`/komoditas/${editId}`, data);
        showToast('Komoditas berhasil diupdate!');
      } else {
        await Api.post('/komoditas', data);
        showToast('Komoditas berhasil ditambahkan!');
      }
      resetKomoditasForm();
      loadKomoditas();
    } catch (e) {
      showToast('Gagal menyimpan: ' + e.message, 'error');
    }

    btn.disabled = false;
    btn.innerHTML = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Data`;
  }

  function loadKomoditas() {
    const wrap = document.getElementById('komoditas-table-wrap');
    if (!wrap) return;
    wrap.innerHTML = '<p class="empty-state">Memuat data...</p>';

    Api.get('/komoditas').then((data) => {
      if (!data || data.length === 0) {
        wrap.innerHTML = '<p class="empty-state">Belum ada data komoditas unggulan. Tambahkan di atas.</p>';
        return;
      }

      let rows = '';
      data.forEach((d) => {
        rows += `
          <tr>
            <td>
              <div style="position:relative; width:52px; height:52px; background:#f0f2f5; border-radius:8px; overflow:hidden;">
                <img src="${d.image_url || d.imageUrl || ''}" alt="${d.nama}" style="width:100%; height:100%; object-fit:cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div style="display:none; width:100%; height:100%; align-items:center; justify-content:center;">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
              </div>
            </td>
            <td><strong>${d.nama || 'â€”'}</strong></td>
            <td>${d.deskripsi ? (d.deskripsi.length > 80 ? d.deskripsi.substring(0, 80) + '...' : d.deskripsi) : 'â€”'}</td>
            <td>
              <div class="td-actions">
                <button class="btn btn-secondary btn-sm" onclick='editKomoditas(${d.id}, ${JSON.stringify(d).replace(/'/g, "&apos;")})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteKomoditas(${d.id}, '${d.nama?.replace(/'/g, "\\'")}')">Hapus</button>
              </div>
            </td>
          </tr>
        `;
      });

      wrap.innerHTML = `
        <table class="data-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama Komoditas</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>${rows}</tbody>
        </table>
      `;
    }).catch((e) => {
      wrap.innerHTML = `<p class="empty-state" style="color: #dc2626;">Gagal memuat data: ${e.message}</p>`;
    });
  }
</script>
</body>
</html>



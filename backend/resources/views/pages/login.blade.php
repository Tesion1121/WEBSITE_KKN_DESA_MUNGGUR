<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin - Desa Munggur</title>
  <meta name="description" content="Login untuk administrator sistem informasi Desa Munggur." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/style.css?v=1.2" />
  <style>
    body { background: #f0f2f5; min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 24px; }

    .login-wrap {
      width: 100%;
      max-width: 420px;
    }

    .login-card {
      background: #fff;
      border: 1.5px solid #e5e7eb;
      border-radius: 20px;
      padding: 44px 40px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }

    .login-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
      margin-bottom: 28px;
    }
    .login-logo img { width: 44px; height: 44px; object-fit: contain; }
    .login-logo-title { font-size: 1rem; font-weight: 700; color: #1a1a1a; }
    .login-logo-sub { font-size: 0.72rem; color: #6c757d; }

    .login-heading { font-size: 1.4rem; font-weight: 800; color: #1a1a1a; text-align: center; margin-bottom: 4px; letter-spacing: -0.02em; }
    .login-sub { font-size: 0.82rem; color: #6c757d; text-align: center; margin-bottom: 28px; }

    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-size: 0.78rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .form-input {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #e5e7eb;
      border-radius: 8px;
      font-size: 0.9rem;
      font-family: inherit;
      color: #1a1a1a;
      background: #fff;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus { border-color: #2d6a4f; box-shadow: 0 0 0 3px rgba(45,106,79,0.10); }

    .btn-submit {
      width: 100%;
      padding: 13px;
      background: #2d6a4f;
      color: #fff;
      font-size: 0.9rem;
      font-weight: 700;
      border: none;
      border-radius: 9px;
      cursor: pointer;
      font-family: inherit;
      transition: background 0.2s, transform 0.15s;
      margin-top: 8px;
      letter-spacing: 0.01em;
    }
    .btn-submit:hover { background: #1b4332; }
    .btn-submit:active { transform: scale(0.98); }
    .btn-submit:disabled { background: #9ca3af; cursor: not-allowed; }

    .error-msg {
      display: none;
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #dc2626;
      font-size: 0.82rem;
      padding: 10px 14px;
      border-radius: 8px;
      margin-top: 12px;
      text-align: center;
    }
    .error-msg.show { display: block; }

    .back-link { text-align: center; margin-top: 20px; font-size: 0.8rem; color: #6c757d; }
    .back-link a { color: #2d6a4f; font-weight: 600; }
    .back-link a:hover { text-decoration: underline; }

    .admin-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(45,106,79,0.08);
      color: #2d6a4f;
      font-size: 0.72rem;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 999px;
      margin: 0 auto 20px;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>
  <div class="login-wrap">
    <div class="login-card" id="login-card">
      <div class="login-logo">
        <img src="/assets/images/boyolali-logo.svg" alt="Logo Boyolali" />
        <div>
          <p class="login-logo-title">Desa Munggur</p>
          <p class="login-logo-sub">Kabupaten Boyolali</p>
        </div>
      </div>

      <div class="admin-badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Admin Area
      </div>

      <h1 class="login-heading">Masuk ke Sistem</h1>
      <p class="login-sub">Hanya untuk administrator Desa Munggur</p>

      <form id="login-form" autocomplete="off">
        <div class="form-group">
          <label class="form-label" for="login-email">Email Admin</label>
          <input type="email" id="login-email" class="form-input" placeholder="akun@example.com" required autocomplete="email" />
        </div>
        <div class="form-group">
          <label class="form-label" for="login-password">Password</label>
          <input type="password" id="login-password" class="form-input" placeholder="••••••••" required autocomplete="current-password" />
        </div>

        <div class="error-msg" id="error-msg">âŒ <span id="error-text">Email atau password salah.</span></div>

        <button type="submit" class="btn-submit" id="btn-submit">Masuk</button>
      </form>

      <div class="back-link">
        <a href="/" id="link-back-home">â† Kembali ke Beranda</a>
      </div>
    </div>
  </div>

  <!-- API Service -->
  <script src="/assets/js/api.service.js"></script>
  <script>
    // Jika sudah login, redirect ke admin
    if (Api.isLoggedIn()) {
      window.location.href = 'admin.html';
    }

    const form = document.getElementById('login-form');
    const btnSubmit = document.getElementById('btn-submit');
    const errorMsg = document.getElementById('error-msg');
    const errorText = document.getElementById('error-text');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = document.getElementById('login-email').value.trim();
      const password = document.getElementById('login-password').value;

      btnSubmit.disabled = true;
      btnSubmit.textContent = 'Memuat...';
      errorMsg.classList.remove('show');

      try {
        const res = await Api.post('/login', { email, password });
        if (res.token) {
          Api.saveToken(res.token);
          // Berhasil login â†’ redirect ke admin
          window.location.href = 'admin.html';
        } else {
          throw new Error(res.message || 'Email atau password salah.');
        }
      } catch (err) {
        btnSubmit.disabled = false;
        btnSubmit.textContent = 'Masuk';
        errorMsg.classList.add('show');
        errorText.textContent = err.message || 'Terjadi kesalahan. Periksa koneksi ke server Laravel.';
      }
    });
  </script>
</body>
</html>



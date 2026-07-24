<!-- ===================== FOOTER ===================== -->
<footer class="footer" id="main-footer">
  <div class="container">
    <div class="footer-grid">
      <!-- Brand -->
      <div class="footer-brand" id="footer-brand">
        <h3 class="footer-brand-name">Desa Munggur</h3>
        <p class="footer-brand-desc">Kecamatan Andong, Kabupaten Boyolali, Jawa Tengah.</p>
        <p class="footer-brand-desc">Sistem Informasi Profil Desa resmi untuk masyarakat.</p>
      </div>
      <!-- Support -->
      <div class="footer-col" id="footer-support">
        <h4 class="footer-col-title">Support</h4>
        <ul class="footer-links">
          <li>Jl. Munggur No. 1, Andong, Boyolali</li>
          <li><a href="mailto:desamunggur15@gmail.com" class="footer-link" id="footer-email">desamunggur15@gmail.com</a></li>
          <li><a href="tel:+6281234567890" class="footer-link" id="footer-phone">+62 812-3456-7890</a></li>
        </ul>
      </div>
      <!-- Quick Links -->
      <div class="footer-col" id="footer-quicklinks">
        <h4 class="footer-col-title">Menu Utama</h4>
        <ul class="footer-links">
          <li><a href="{{ url('/profil-desa') }}" class="footer-link">Profil Desa</a></li>
          <li><a href="{{ url('/struktur-desa') }}" class="footer-link">Struktur Desa</a></li>
          <li><a href="{{ url('/potensi-desa') }}" class="footer-link">Potensi Desa</a></li>
          <li><a href="{{ url('/peta-desa') }}" class="footer-link">Peta Desa</a></li>
          <li><a href="{{ url('/umkm') }}" class="footer-link">UMKM</a></li>
          <li><a href="{{ url('/kebudayaan-kuliner') }}" class="footer-link">Wisata & Budaya</a></li>
          <li><a href="{{ url('/komoditas') }}" class="footer-link">Komoditas</a></li>
        </ul>
      </div>
      <!-- Account -->
      <div class="footer-col" id="footer-account">
        <h4 class="footer-col-title">Account</h4>
        <ul class="footer-links">
          <li><a href="{{ url('/admin') }}" class="footer-link" id="footer-login-link">My Account</a></li>
          <li><a href="{{ url('/login') }}" class="footer-link" id="footer-login-link2">Login</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom" id="footer-bottom">
      <p class="footer-copy">&copy; 2025 Desa Munggur. Hak Cipta Dilindungi.</p>
      <p class="footer-credit">Dibuat dengan ❤ untuk masyarakat Desa Munggur</p>
    </div>
  </div>
</footer>

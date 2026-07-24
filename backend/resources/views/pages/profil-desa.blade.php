@extends('layouts.app')

@section('title', 'Profil & Sejarah - Desa Munggur')
@section('description', 'Sejarah, Asal-Usul Nama, Mitologi, Kearifan Lokal Pertanian & Profil Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
  .history-hero-card {
    background: linear-gradient(135deg, rgba(45,106,79,0.07) 0%, rgba(27,67,50,0.02) 100%);
    border: 1.5px solid rgba(45,106,79,0.18);
    border-radius: 20px;
    padding: 36px;
    margin-bottom: 40px;
  }

  .dukuh-badge-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 16px 0 24px;
  }

  .dukuh-badge {
    background: #ffffff;
    border: 1.5px solid #2d6a4f;
    color: #2d6a4f;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 999px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  }

  .history-box {
    background: #ffffff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 28px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
  }

  .history-box-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #f0f2f5;
    padding-bottom: 10px;
  }

  .wisdom-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
  }

  .wisdom-card {
    background: #f9fafb;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px;
    transition: transform 0.2s, border-color 0.2s;
  }

  .wisdom-card:hover {
    transform: translateY(-3px);
    border-color: var(--color-accent);
  }

  .wisdom-card-title {
    font-size: 1rem;
    font-weight: 800;
    color: var(--color-primary);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .wisdom-card-desc {
    font-size: 0.88rem;
    color: #4b5563;
    line-height: 1.6;
  }

  .recipe-box {
    background: #fef3c7;
    border: 1.5px solid #f59e0b;
    border-radius: 14px;
    padding: 24px;
    margin-top: 20px;
  }

  .recipe-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: #92400e;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
</style>
@endsection

@section('content')

    <!-- PAGE HEADER -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          <div>
            <h1 class="page-header-title">Profil & Sejarah Desa Munggur</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Asal-Usul, Mitologi, Tradisi Agraria & Kearifan Lokal Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="page-main">
      <div class="container">
        
        <!-- GAMBARAN UMUM & ASAL USUL NAMA -->
        <div class="history-hero-card">
          <span style="background:rgba(45,106,79,0.1); color:var(--color-accent); font-size:0.75rem; font-weight:700; padding:4px 12px; border-radius:999px; text-transform:uppercase;">
            Gambaran Umum Wilayah
          </span>
          <h2 style="font-size:1.6rem; font-weight:800; color:var(--color-primary); margin:10px 0 14px;">
            Asal-Usul Nama & Enam Dukuh Desa Munggur
          </h2>
          <p style="color:#374151; line-height:1.75; font-size:0.98rem; text-align:justify;">
            <strong>Desa Munggur</strong> merupakan salah satu dari 16 desa yang terletak di Kecamatan Andong, Kabupaten Boyolali, Provinsi Jawa Tengah (Kode Pos 57384). Nama desa ini diambil secara historis dari keberadaan <strong>Pohon Munggur / Trembesi</strong> (<em>Samanea saman</em>) yang dahulu tumbuh sangat lebat di wilayah ini. Pohon ini dikenal berakar besar, rimbun, serta menghasilkan buah yang disebut <em>klintok</em> oleh masyarakat setempat.
          </p>

          <p style="color:#374151; line-height:1.75; font-size:0.98rem; text-align:justify; margin-top:12px;">
            Secara administratif, Desa Munggur terbagi menjadi <strong>6 Dukuh</strong> tempat tinggal warga yang rukun dan gotong royong:
          </p>

          <!-- BADGE 6 DUKUH -->
          <div class="dukuh-badge-container">
            <span class="dukuh-badge">🏡 Dukuh Ngasinan</span>
            <span class="dukuh-badge">🏡 Dukuh Kedung Gerbong</span>
            <span class="dukuh-badge">🏡 Dukuh Munggur</span>
            <span class="dukuh-badge">🏡 Dukuh Banyuurip</span>
            <span class="dukuh-badge">🏡 Dukuh Kwarasan</span>
            <span class="dukuh-badge">🏡 Dukuh Ngrebinan</span>
          </div>

          <p style="color:#4b5563; font-size:0.92rem; line-height:1.65;">
            Mayoritas penduduk Desa Munggur (sekitar <strong>99%</strong>) menggantungkan mata pencahariannya pada sektor pertanian. Oleh karena itu, kondisi sosial dan perekonomian desa sangat erat kaitannya dengan keberhasilan panen setiap musinya.
          </p>
        </div>

        <!-- MITOLOGI LISAN SEJARAH AIR DESA -->
        <div class="history-box">
          <h3 class="history-box-title">
            💧 Mitologi & Cerita Lisan Sumber Air Desa
          </h3>
          <p style="color:#4b5563; line-height:1.75; font-size:0.95rem; text-align:justify;">
            Secara historis, Desa Munggur kaya akan tradisi tutur dan cerita lisan yang diwariskan antar generasi. Salah satu cerita rakyat yang terkenal adalah mitologi perjalanan seorang wali yang dahulu pernah singgah di wilayah desa:
          </p>
          <div style="background:#f9fafb; border-left:4px solid var(--color-accent); padding:16px 20px; border-radius:0 10px 10px 0; margin-top:12px; color:#374151; font-size:0.93rem; line-height:1.7;">
            <em>"Diceritakan seorang wali pernah singgah dan memohon air di wilayah Kedung Gerbong namun tidak diberi, sehingga secara lisan diyakini wilayah Kedung Gerbong menjadi daerah yang sulit air. Sebaliknya, masyarakat di wilayah Banyuurip menyambut kedatangan sang wali dengan sangat baik dan penuh keramahan, sehingga wilayah Banyuurip dikaruniai sumber air yang melimpah dan dekat dengan permukaan tanah hingga saat ini."</em>
          </div>
        </div>

        <!-- LATAR BELAKANG HISTORIS PERTANIAN & DINAMIKA HAMA TIKUS -->
        <div class="history-box">
          <h3 class="history-box-title">
            🌾 Sejarah Tradisi Pertanian & Dinamika Hama Tikus
          </h3>
          <p style="color:#4b5563; line-height:1.75; font-size:0.95rem; text-align:justify;">
            Tradisi bercocok tanam di Desa Munggur telah berlangsung secara turun-temurun dengan komoditas utama berupa <strong>Padi Sawah</strong> dan <strong>Jagung</strong>. Dalam catatan sejarah pertanian, para petani Desa Munggur telah menghadapi tantangan hama tikus sawah (<em>Rattus argentiventer</em>) sejak era 1963-an, wabah 2023, hingga perkembangan rotasi tanam modern.
          </p>
          <p style="color:#4b5563; line-height:1.75; font-size:0.95rem; text-align:justify; margin-top:10px;">
            Guna menghadapi tantangan alam tersebut, masyarakat agraris Munggur melahirkan berbagai bentuk ketahanan sosial dan inovasi pengendalian hama berbasis kearifan lokal.
          </p>

          <!-- 5 KEARIFAN LOKAL PENGENDALIAN HAMA -->
          <h4 style="font-size:1.05rem; font-weight:800; color:#1a1a1a; margin-top:24px; margin-bottom:12px;">
            🛡️ 5 Bentuk Kearifan Lokal Pengendalian Hama Desa Munggur:
          </h4>

          <div class="wisdom-grid">
            
            <div class="wisdom-card">
              <div class="wisdom-card-title">
                🤝 1. Gropyokan / Gugur Gunung
              </div>
              <div class="wisdom-card-desc">
                Tradisi gotong royong massal warga pasca panen untuk membongkar sarang tikus bersama-sama menggunakan alat tradisional <em>domprong</em> secara serentak.
              </div>
            </div>

            <div class="wisdom-card">
              <div class="wisdom-card-title">
                🌙 2. Sistem Ronda / Jaga Malam
              </div>
              <div class="wisdom-card-desc">
                Ronda malam mandiri petani memantau dan memburu hama tikus nokturnal secara langsung untuk melindungi tanaman jagung dan padi di sawah.
              </div>
            </div>

            <div class="wisdom-card">
              <div class="wisdom-card-title">
                💨 3. Pengasapan Belerang (Emposan)
              </div>
              <div class="wisdom-card-desc">
                Teknik tradisional membakar belerang kuning dan menyalurkan asapnya ke lubang sarang dengan blower/selang yang dipasang perangkap bagor.
              </div>
            </div>

            <div class="wisdom-card">
              <div class="wisdom-card-title">
                🧪 4. Metode Karbit (Kalsium Karbida)
              </div>
              <div class="wisdom-card-desc">
                Inovasi memanfaatkan reaksi kimia kalsium karbida yang disiram air untuk menghasilkan gas asetilena pembasmi hama di dalam lorong tanah.
              </div>
            </div>

            <div class="wisdom-card" style="grid-column: 1 / -1;">
              <div class="wisdom-card-title">
                🦉 5. Konservasi Burung Hantu (Tyto Alba) & Pagupon
              </div>
              <div class="wisdom-card-desc">
                Pembangunan rumah burung hantu (pagupon) di area persawahan sebagai fasilitas predator alami biologis jangka panjang pendamping sawah petani.
              </div>
            </div>

          </div>

          <!-- RACIKAN INOVASI EMPOSAN KERTAS Sederhana -->
          <div class="recipe-box">
            <div class="recipe-title">
              💡 Inovasi Sederhana: Emposan Kertas Ramah Lingkungan
            </div>
            <p style="font-size:0.9rem; color:#78350f; line-height:1.6; margin-bottom:10px;">
              Inovasi lokal yang dikembangkan warga untuk pengasapan cepat sarang tikus dengan bahan yang mudah diperoleh di toko terdekat:
            </p>
            <ul style="padding-left:20px; font-size:0.88rem; color:#78350f; line-height:1.6;">
              <li><strong>Komposisi Bahan</strong>: Serbuk Belerang (1 kg), Arang Batok Kelapa (1 kg), KNO₃ Kristal (3 kg), & Soda Kue (0.5 kg).</li>
              <li><strong>Cara Pembuatan</strong>: Campurkan bahan hingga merata, masukkan ke dalam tabung gulungan kertas bekas (diameter 2 cm), lipat ujungnya, dan siap dibakar pada mulut lubang sarang saat lahan terbuka.</li>
            </ul>
          </div>
        </div>

        <!-- VISI & MISI DESA -->
        <div class="history-box">
          <h3 class="history-box-title">
            🎯 Visi & Misi Pembangunan Desa Munggur
          </h3>
          <p style="color:#4b5563; font-size:0.95rem; line-height:1.7;">
            <strong>Visi:</strong> Terwujudnya Desa Munggur yang Maju, Mandiri, Sejahtera, Berdaya Saing Berbasis Pertanian & Kearifan Lokal.
          </p>
          <ol style="padding-left:20px; color:#4b5563; font-size:0.92rem; line-height:1.7; margin-top:10px;">
            <li>Meningkatkan kualitas pelayanan publik dan transparansi tata kelola pemerintahan desa digital.</li>
            <li>Mendorong produktivitas sektor pertanian, modernisasi alat tani, serta pengembangan UMKM desa.</li>
            <li>Memelihara tradisi kebudayaan, kearifan lokal gotong royong, dan lingkungan hidup yang berkelanjutan.</li>
          </ol>
        </div>

      </div>
    </section>

@endsection

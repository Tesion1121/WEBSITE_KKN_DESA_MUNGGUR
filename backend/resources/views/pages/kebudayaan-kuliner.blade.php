@extends('layouts.app')

@section('title', 'Wisata dan Budaya - Desa Munggur')
@section('description', 'Wisata dan Budaya Desa Munggur, Kecamatan Andong, Kabupaten Boyolali.')
@section('extra-css', true)

@section('head')
<style>
    .page-main { padding-top: 40px; padding-bottom: 80px; }
    .section-title { font-size: 1.75rem; font-weight: 800; color: #1a1a1a; margin-bottom: 32px; text-align: center; }
    
    .content-block {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 32px;
      margin-bottom: 32px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    
    .content-block-inner {
      display: flex;
      flex-direction: column;
      gap: 32px;
    }
    @media (min-width: 992px) {
      .content-block-inner { flex-direction: row; align-items: center; }
      .content-block-inner.reverse { flex-direction: row-reverse; }
    }
    
    .content-text { flex: 1.2; }
    .content-image-wrap { flex: 1; border-radius: 12px; overflow: hidden; }
    .content-image { width: 100%; height: auto; display: block; }
    .image-caption { font-size: 0.85rem; color: #6c757d; text-align: center; padding: 10px; background: #f8f9fa; font-style: italic; }
    
    .block-title { font-size: 1.35rem; font-weight: 800; color: #2d6a4f; margin-bottom: 16px; }
    .block-subtitle { font-size: 1.15rem; font-weight: 700; color: #1a1a1a; margin-top: 24px; margin-bottom: 12px; }
    .block-desc { font-size: 1rem; color: #4b5563; line-height: 1.7; margin-bottom: 16px; }
    
    .highlight-box {
      background: #e8f5e9;
      border-left: 4px solid var(--color-accent);
      padding: 24px;
      border-radius: 0 12px 12px 0;
      color: #1b4332;
      margin-top: 32px;
    }
</style>
@endsection

@section('content')
    <!-- HEADER PAGE -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d6a4f" stroke-width="2.2" style="flex-shrink:0">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          <div>
            <h1 class="page-header-title">Wisata & Budaya</h1>
            <p style="color:#6c757d;font-size:0.875rem;margin-top:4px;">Eksplorasi Keindahan Budaya, Tradisi, dan Kuliner Khas Desa Munggur</p>
          </div>
        </div>
      </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="page-main">
      <div class="container">
        
        <!-- MODULE DOWNLOAD BANNER -->
        <div style="background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%); border-radius: 16px; padding: 32px; margin-bottom: 48px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; box-shadow: 0 10px 30px rgba(45, 106, 79, 0.2); color: white;">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 16px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
          <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 12px; color: white;">Modul Wisata & Budaya Desa Munggur</h2>
          <p style="font-size: 1rem; color: #d8f3dc; margin-bottom: 24px; max-width: 600px;">
            Unduh dan pelajari buku panduan (modul) komprehensif mengenai kekayaan tradisi, wisata alam, serta kuliner khas Desa Munggur secara gratis.
          </p>
          <a href="https://drive.google.com/file/d/1H-5SkwcdnDA_QkR7BYCzXijY_cubUbBf/view?usp=sharing" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: white; color: #1b4332; padding: 12px 28px; border-radius: 50px; font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: transform 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Unduh Modul (PDF)
          </a>
        </div>
        
        <h2 class="section-title">Tradisi Leluhur</h2>
        
        <div class="content-block">
          <div class="content-block-inner">
            <div class="content-text">
              <h3 class="block-title">Upacara Ruwahan</h3>
              <p class="block-desc">
                Diadakan setiap bulan <em>Ruwah</em> (satu bulan sebelum memasuki bulan suci Ramadan), masyarakat Desa Munggur menggelar tradisi <strong>Ruwahan</strong>. Warga berbondong-bondong membawa sedekah dan doa ke makam leluhur sebagai bentuk penghormatan kepada para pendahulu serta pembersihan diri secara spiritual menyambut bulan puasa.
              </p>
              
              <h3 class="block-title" style="margin-top: 32px;">Bersih Dusun & Sedekah Bumi</h3>
              <p class="block-desc">
                Puncak rasa syukur masyarakat agraris Munggur diwujudkan melalui Tasyakuran Bersih Dusun. Acara ini ditandai dengan hadirnya <strong>Gunungan Hasil Bumi</strong> yang disusun dari hasil panen lokal.
              </p>
              <p class="block-desc">
                Diadakan secara rutin setiap tahunnya, tradisi ini bukan sekadar perayaan, melainkan sebuah ritual syukur masyarakat Munggur atas limpahan hasil bumi serta doa untuk keselamatan seluruh warga desa. Semangat gotong royong membaur dalam setiap prosesinya.
              </p>
            </div>
            <div class="content-image-wrap">
              <img src="{{ asset('assets/images/gunungan hasil panen Desa.png') }}" alt="Gunungan Hasil Panen" class="content-image" />
              <div class="image-caption">Gunungan hasil panen Desa Munggur</div>
            </div>
          </div>
        </div>

        <h2 class="section-title" style="margin-top: 64px;">Seni Tari & Pertunjukan Khas</h2>
        <p style="text-align:center; color:#6c757d; margin-bottom:40px; max-width:800px; margin-left:auto; margin-right:auto; font-size:1.05rem; line-height: 1.7;">
          Di bawah bimbingan praktisi seni kebanggaan lokal, Ibu Jumiatun, tarian tradisional di Desa Munggur tidak hanya diajarkan sebagai gerakan tubuh, tetapi juga sebagai penyaluran energi dan nilai-nilai kehidupan.
        </p>
        
        <div class="content-block">
          <div class="content-block-inner reverse">
            <div class="content-text">
              <h3 class="block-title">Tari Suko Pari Suko</h3>
              <p class="block-desc">
                Tarian khas yang diciptakan khusus untuk <strong>menyambut musim panen</strong>. Para penari membawakan gerakan yang menggambarkan kegembiraan petani dengan menggunakan properti <em>tampah</em> (alat penampi beras dari bambu), menegaskan identitas Munggur sebagai desa agraris yang bersahaja.
              </p>
            </div>
            <div class="content-image-wrap">
              <img src="{{ asset('assets/images/anak-anak penari yang di ampu Ibu Jumiatun di.jpeg') }}" alt="Tari Suko Pari Suko" class="content-image" />
              <div class="image-caption">Anak-anak penari yang diampu Ibu Jumiatun di Desa Munggur</div>
            </div>
          </div>
        </div>

        <div class="content-block">
          <div class="content-block-inner">
            <div class="content-text">
              <h3 class="block-title">Tari Topeng Ireng</h3>
              <p class="block-desc">
                Salah satu tarian yang sarat akan energi kebersamaan. Tarian ini memiliki daya tarik yang unik, di mana para penari merasakan dorongan semangat dan kegembiraan yang luar biasa <em>(dopamine/energi mistis lokal)</em>. 
              </p>
              <p class="block-desc">
                Hal ini membuat para penari mampu menari dalam durasi yang sangat lama dengan penuh sukacita dan daya tahan yang luar biasa.
              </p>
            </div>
            <div class="content-image-wrap">
              <img src="{{ asset('assets/images/penari Topeng Ireng di desa.jpeg') }}" alt="Tari Topeng Ireng" class="content-image" />
              <div class="image-caption">Penari Topeng Ireng di Desa Munggur</div>
            </div>
          </div>
        </div>

        <div class="content-block">
          <div class="content-block-inner reverse">
            <div class="content-text">
              <h3 class="block-title">Nostalgia Kesenian Gambus</h3>
              <p class="block-desc">
                Kesenian Gambus merupakan pertunjukan khas yang memadukan lagu/nyanyian, irama alat musik petik/perkusi, seni tari, dan dialog drama. Kesenian ini pernah menjadi hiburan favorit warga sebelum perlahan redup tergerus zaman dan keterbatasan alat musik.
              </p>
            </div>
            <div class="content-image-wrap">
              <img src="{{ asset('assets/images/sinden dan lakon dalam pentas kesenian.jpeg') }}" alt="Kesenian Gambus" class="content-image" />
              <div class="image-caption">Sinden dan lakon dalam pentas kesenian gambus di Desa Munggur</div>
            </div>
          </div>
        </div>

        <h2 class="section-title" style="margin-top: 64px;">Kuliner Khas: Sajian "Pakem" Warisan Otentik</h2>
        
        <div class="content-block">
          <div class="content-block-inner">
            <div class="content-text">
              <p class="block-desc">
                Berbeda dengan kuliner modern dari luar, Desa Munggur memiliki makanan <strong>pakem</strong> (wajib) yang tidak boleh absen dalam setiap upacara seperti Sedekah Bumi maupun hajatan warga. 
              </p>
              <p class="block-desc">
                Makanan pakem ini disiapkan dengan resep asli yang diwariskan oleh para sesepuh desa. Ragam makanan pakem adat ini meliputi <strong>Jadah, Wajik, dan Lemper</strong>.
              </p>
              
              <div class="highlight-box">
                <h4 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 12px;">Mari Berkunjung dan Menikmati Otentisitas Munggur</h4>
                <p style="font-size: 0.95rem; line-height: 1.6; margin: 0;">
                  Keharmonisan antara doa dalam Ruwahan, ketahanan gerak Tari Topeng Ireng dan Suko Pari Suko, serta cita rasa otentik Jadah dan Wajik buatan sesepuh desa adalah nilai hakiki dari Desa Munggur. Kami mengundang Anda untuk singgah dan merasakan langsung kehangatan tradisi kami.
                </p>
              </div>
            </div>
            <div class="content-image-wrap">
              <img src="{{ asset('assets/images/Jadah, Wajik, Lemper - Warisan Otentik.png') }}" alt="Kuliner Khas" class="content-image" />
              <div class="image-caption">Jadah, Wajik, Lemper - Warisan Otentik</div>
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection

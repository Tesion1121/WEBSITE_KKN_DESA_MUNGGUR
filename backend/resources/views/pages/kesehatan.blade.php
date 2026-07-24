@extends('layouts.app')

@section('title', 'Pojok Kesehatan - Desa Munggur')
@section('description', 'Kenali dan Cegah Stunting untuk Generasi Sehat di Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Informasi 1.000 Hari Pertama Kehidupan, pencegahan, dan pemantauan di Posyandu.')
@section('extra-css', true)

@section('head')
<style>
  /* Base Container & Header styling */
  .stunting-container {
    max-width: 1000px;
    margin: 0 auto;
  }
  
  /* Quick Nav Links */
  .quick-nav {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding: 8px 4px 16px;
    margin-bottom: 32px;
    border-bottom: 1.5px solid var(--color-border);
    scrollbar-width: none; /* Firefox */
  }
  .quick-nav::-webkit-scrollbar {
    display: none; /* Safari and Chrome */
  }
  .quick-nav-link {
    background: var(--color-bg-light);
    color: var(--color-text-muted);
    font-size: 0.85rem;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 99px;
    white-space: nowrap;
    border: 1.5px solid transparent;
    transition: all 0.22s ease;
  }
  .quick-nav-link:hover {
    background: var(--color-border);
    color: var(--color-text);
  }
  .quick-nav-link.active,
  .quick-nav-link:focus {
    background: rgba(45, 106, 79, 0.08);
    color: var(--color-accent);
    border-color: rgba(45, 106, 79, 0.2);
  }

  /* Section layouts */
  .stunting-section {
    background: var(--color-bg-card);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: var(--shadow-sm);
  }
  .section-title-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 24px;
    border-bottom: 2px solid #e8f5e9;
    padding-bottom: 12px;
  }
  .section-icon {
    width: 42px;
    height: 42px;
    background: rgba(45, 106, 79, 0.08);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    flex-shrink: 0;
  }
  .section-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--color-text);
    letter-spacing: -0.01em;
  }
  
  /* Kenali Stunting layout */
  .definition-box {
    display: grid;
    grid-template-columns: 1.3fr 0.7fr;
    gap: 28px;
    align-items: center;
  }
  .definition-text p {
    font-size: 0.95rem;
    color: #4b5563;
    line-height: 1.75;
    margin-bottom: 16px;
  }
  .definition-text p:last-child {
    margin-bottom: 0;
  }
  .definition-highlight {
    background: linear-gradient(135deg, rgba(45, 106, 79, 0.05) 0%, rgba(27, 67, 50, 0.01) 100%);
    border: 1.5px solid rgba(45, 106, 79, 0.16);
    border-radius: var(--radius-md);
    padding: 24px;
    text-align: center;
  }
  .highlight-badge {
    display: inline-block;
    background: #e8f5e9;
    color: var(--color-accent);
    font-size: 0.72rem;
    font-weight: 800;
    padding: 4px 12px;
    border-radius: 99px;
    margin-bottom: 10px;
    letter-spacing: 0.03em;
    text-transform: uppercase;
  }
  .highlight-value {
    font-size: 2.1rem;
    font-weight: 800;
    color: var(--color-accent);
    margin: 8px 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
  }
  .highlight-desc {
    font-size: 0.82rem;
    color: #4b5563;
    line-height: 1.5;
  }
  
  /* Risk Factor Grid */
  .risk-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 24px;
  }
  .risk-card {
    background: var(--color-bg-light);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    padding: 20px;
    transition: var(--transition);
  }
  .risk-card:hover {
    border-color: var(--color-accent);
    background: #ffffff;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    transform: translateY(-2px);
  }
  .risk-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
  }
  .risk-card-icon {
    font-size: 1.3rem;
  }
  .risk-card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--color-text);
  }
  .risk-card-desc {
    font-size: 0.85rem;
    color: #555;
    line-height: 1.6;
  }
  
  /* Alert / Info Box styling */
  .alert-box {
    background: #fffbeb;
    border: 1.5px solid #fef3c7;
    border-radius: var(--radius-md);
    padding: 16px 20px;
    color: #b45309;
    font-size: 0.875rem;
    line-height: 1.6;
    display: flex;
    gap: 12px;
    align-items: flex-start;
  }
  .alert-box-icon {
    font-size: 1.2rem;
    line-height: 1;
    margin-top: 1px;
    flex-shrink: 0;
  }
  
  /* Growth & Posyandu card */
  .growth-box {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 28px;
    align-items: center;
  }
  .posyandu-cycle {
    display: flex;
    justify-content: center;
    gap: 12px;
    background: #e8f5e9;
    border-radius: var(--radius-md);
    padding: 12px 18px;
    margin-bottom: 16px;
    flex-wrap: wrap;
  }
  .cycle-item {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--color-accent);
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .cycle-divider {
    color: #81c784;
    font-weight: 400;
  }
  
  /* HPK Timeline styling */
  .timeline {
    position: relative;
    padding-left: 28px;
    margin-left: 12px;
    border-left: 2px solid var(--color-border);
  }
  .timeline-item {
    position: relative;
    margin-bottom: 28px;
  }
  .timeline-item:last-child {
    margin-bottom: 0;
  }
  .timeline-badge {
    position: absolute;
    left: -39px;
    top: 3px;
    width: 20px;
    height: 20px;
    background: #ffffff;
    border: 3px solid var(--color-accent);
    border-radius: 50%;
    z-index: 2;
    transition: var(--transition);
  }
  .timeline-item:hover .timeline-badge {
    background: var(--color-accent);
    transform: scale(1.15);
  }
  .timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    flex-wrap: wrap;
    gap: 8px;
  }
  .timeline-stage {
    font-size: 0.72rem;
    background: #e8f5e9;
    color: var(--color-accent);
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 99px;
    letter-spacing: 0.02em;
    text-transform: uppercase;
  }
  .timeline-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--color-text);
  }
  .timeline-desc {
    font-size: 0.85rem;
    color: #4b5563;
    line-height: 1.6;
  }

  /* Interactive Prevention Tabs */
  .tabs-nav {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
    border-bottom: 1.5px solid var(--color-border);
    padding-bottom: 12px;
  }
  .tab-btn {
    background: none;
    border: none;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--color-text-muted);
    padding: 10px 18px;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .tab-btn:hover {
    color: var(--color-text);
    background: var(--color-bg-light);
  }
  .tab-btn.active {
    background: rgba(45, 106, 79, 0.08);
    color: var(--color-accent);
  }
  .tab-pane {
    display: none;
  }
  .tab-pane.active {
    display: block;
    animation: tabFadeIn 0.35s ease forwards;
  }
  @keyframes tabFadeIn {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  .prevention-list {
    list-style: none;
    padding: 0;
    margin: 0 0 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .prevention-list li {
    font-size: 0.9rem;
    color: #4b5563;
    line-height: 1.65;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }
  .prevention-list li::before {
    content: "✓";
    color: var(--color-accent);
    font-weight: 800;
    margin-top: 1px;
    font-size: 0.95rem;
  }
  
  /* Menu Box for Local Menu recommendation */
  .menu-box {
    background: linear-gradient(135deg, rgba(45,106,79,0.04) 0%, rgba(27,67,50,0.01) 100%);
    border: 1.5px solid rgba(45,106,79,0.12);
    border-radius: var(--radius-md);
    padding: 20px;
    display: flex;
    gap: 16px;
    align-items: center;
  }
  .menu-box-icon {
    width: 44px;
    height: 44px;
    background: #ffffff;
    border: 1.5px solid rgba(45,106,79,0.16);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
    box-shadow: var(--shadow-sm);
  }
  .menu-box-content {
    font-size: 0.85rem;
    color: #4b5563;
    line-height: 1.6;
    flex-grow: 1;
  }
  .menu-box-title {
    font-size: 0.9rem;
    font-weight: 800;
    color: var(--color-accent);
    margin-bottom: 2px;
  }

  /* ABCDE Cegah Stunting Grid */
  .abcde-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
  }
  .abcde-card {
    background: #ffffff;
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    padding: 20px 14px;
    text-align: center;
    transition: var(--transition);
  }
  .abcde-card:hover {
    border-color: var(--color-accent);
    box-shadow: 0 4px 16px rgba(45, 106, 79, 0.08);
    transform: translateY(-2px);
  }
  .abcde-letter {
    width: 38px;
    height: 38px;
    background: var(--color-accent);
    color: #ffffff;
    font-size: 1.2rem;
    font-weight: 800;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
  }
  .abcde-title {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: 8px;
    min-height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1.3;
  }
  .abcde-desc {
    font-size: 0.78rem;
    color: var(--color-text-muted);
    line-height: 1.5;
  }
  
  /* Urgent/Consultation Callout Box */
  .consult-box {
    background: #fff5f5;
    border: 1.5px solid #fee2e2;
    border-radius: var(--radius-lg);
    padding: 28px;
    display: grid;
    grid-template-columns: 1.25fr 0.75fr;
    gap: 28px;
    align-items: center;
  }
  .consult-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #991b1b;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .consult-desc {
    font-size: 0.875rem;
    color: #7f1d1d;
    line-height: 1.6;
  }
  .consult-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .consult-list li {
    font-size: 0.85rem;
    color: #7f1d1d;
    line-height: 1.5;
    display: flex;
    gap: 8px;
    align-items: flex-start;
    font-weight: 600;
  }
  .consult-list li::before {
    content: "⚠️";
    font-size: 0.85rem;
    flex-shrink: 0;
  }
  
  /* FAQ Accordion layout */
  .faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .faq-item {
    background: #ffffff;
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: var(--transition);
  }
  .faq-item.expanded {
    border-color: var(--color-accent);
  }
  .faq-question {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    padding: 18px 20px;
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--color-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    transition: background 0.2s ease;
  }
  .faq-question:hover {
    background: var(--color-bg-light);
  }
  .faq-icon-arrow {
    width: 16px;
    height: 16px;
    transition: transform 0.22s ease;
    color: var(--color-text-muted);
  }
  .faq-item.expanded .faq-icon-arrow {
    transform: rotate(180deg);
    color: var(--color-accent);
  }
  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.25s ease-out;
  }
  .faq-answer-inner {
    padding: 0 20px 18px;
    font-size: 0.875rem;
    color: #4b5563;
    line-height: 1.7;
    border-top: 1.5px solid #f3f4f6;
    padding-top: 14px;
  }

  /* Full-width CTA Banner */
  .cta-banner {
    background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
    color: #ffffff;
    border-radius: var(--radius-lg);
    padding: 40px;
    text-align: center;
    margin-bottom: 32px;
    box-shadow: var(--shadow-md);
  }
  .cta-title {
    font-size: 1.35rem;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -0.01em;
  }
  .cta-desc {
    font-size: 0.9rem;
    color: #d8f3dc;
    max-width: 640px;
    margin: 0 auto;
    line-height: 1.65;
  }
  
  /* Source References Section */
  .references-box {
    background: var(--color-bg-light);
    border: 1.5px solid var(--color-border);
    border-radius: var(--radius-md);
    padding: 24px;
  }
  .references-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .references-list {
    list-style: decimal;
    padding-left: 20px;
    margin: 0;
  }
  .references-list li {
    font-size: 0.8rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin-bottom: 6px;
  }
  .references-list li:last-child {
    margin-bottom: 0;
  }

  /* Responsive breakpoints */
  @media (max-width: 768px) {
    .definition-box {
      grid-template-columns: 1fr;
    }
    .risk-grid {
      grid-template-columns: 1fr;
    }
    .growth-box {
      grid-template-columns: 1fr;
    }
    .tabs-nav {
      flex-wrap: wrap;
    }
    .tab-btn {
      flex-grow: 1;
      justify-content: center;
    }
    .abcde-grid {
      grid-template-columns: repeat(3, 1fr);
    }
    .consult-box {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 520px) {
    .abcde-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
</style>
@endsection

@section('content')

    <!-- Hero Header -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-inner">
          <div class="section-icon" style="width: 48px; height: 48px; background: rgba(45, 106, 79, 0.1);">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>
          </div>
          <div>
            <span style="font-size:0.75rem; font-weight:700; color:var(--color-accent); text-transform:uppercase; letter-spacing:0.05em;">Pojok Kesehatan Desa Munggur</span>
            <h1 class="page-header-title" style="margin-top:2px;">Kenali & Cegah Stunting</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="page-main">
      <div class="container">
        <div class="stunting-container">
          
          <!-- Sticky Sub Nav / Quick Jump -->
          <div class="quick-nav">
            <a href="#kenali" class="quick-nav-link">Apa itu Stunting?</a>
            <a href="#faktor" class="quick-nav-link">Faktor Risiko</a>
            <a href="#pantau" class="quick-nav-link">Pantau Tumbuh</a>
            <a href="#hpk" class="quick-nav-link">1.000 HPK</a>
            <a href="#pencegahan" class="quick-nav-link">Cara Pencegahan</a>
            <a href="#abcde" class="quick-nav-link">ABCDE Kemenkes</a>
            <a href="#faq" class="quick-nav-link">Tanya Jawab (FAQ)</a>
          </div>

          <!-- Section 1: Kenali Stunting -->
          <div id="kenali" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </div>
              <h2 class="section-title">1. Kenali Stunting</h2>
            </div>
            <div class="definition-box">
              <div class="definition-text">
                <h3 style="font-size:1.05rem; font-weight:700; color:var(--color-text); margin-bottom:10px;">Apa itu Stunting?</h3>
                <p>
                  Menurut <strong>World Health Organization (WHO)</strong>, stunting adalah gangguan pertumbuhan dan perkembangan yang dialami anak akibat gizi yang tidak memadai, infeksi berulang, dan stimulasi psikososial yang tidak memadai.
                </p>
                <p>
                  Stunting tidak dapat ditentukan hanya berdasarkan penampilan fisik anak yang terlihat pendek saja, melainkan harus dinilai secara objektif melalui pengukuran panjang atau tinggi badan berdasarkan umur dengan menggunakan standar pertumbuhan anak yang berlaku resmi.
                </p>
              </div>
              <div class="definition-highlight">
                <span class="highlight-badge">Standar WHO</span>
                <div class="highlight-value">&lt; -2 SD</div>
                <div class="highlight-desc">
                  Anak dikategorikan stunting jika panjang/tinggi badan menurut umur berada lebih dari dua standar deviasi di bawah median Standar Pertumbuhan Anak WHO.
                </div>
              </div>
            </div>
          </div>

          <!-- Section 2: Faktor Risiko -->
          <div id="faktor" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                  <line x1="12" y1="9" x2="12" y2="13"></line>
                  <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
              </div>
              <h2 class="section-title">2. Faktor Risiko Stunting</h2>
            </div>
            <p style="font-size:0.9rem; color:#4b5563; line-height:1.6; margin-bottom:20px;">
              Stunting umumnya tidak disebabkan oleh satu faktor tunggal, melainkan gabungan dari berbagai faktor saling berkaitan berikut ini:
            </p>
            <div class="risk-grid">
              <!-- Card 1 -->
              <div class="risk-card">
                <div class="risk-card-header">
                  <span class="risk-card-icon">🤰</span>
                  <h4 class="risk-card-title">Kondisi Ibu & Kehamilan</h4>
                </div>
                <p class="risk-card-desc">Kesehatan serta pemenuhan gizi yang tidak memadai bagi ibu selama masa kehamilan sangat memengaruhi tumbuh kembang janin di dalam kandungan.</p>
              </div>
              <!-- Card 2 -->
              <div class="risk-card">
                <div class="risk-card-header">
                  <span class="risk-card-icon">🍼</span>
                  <h4 class="risk-card-title">Gizi Anak Kurang</h4>
                </div>
                <p class="risk-card-desc">Asupan zat gizi harian yang tidak mencukupi dalam jangka panjang serta pola pemberian ASI eksklusif dan MPASI yang belum optimal menghambat tumbuh kembang.</p>
              </div>
              <!-- Card 3 -->
              <div class="risk-card">
                <div class="risk-card-header">
                  <span class="risk-card-icon">🦠</span>
                  <h4 class="risk-card-title">Infeksi Berulang</h4>
                </div>
                <p class="risk-card-desc">Anak yang sering terserang penyakit infeksi seperti diare atau ISPA mengalami gangguan penyerapan dan pemanfaatan zat gizi untuk pertumbuhan tubuh.</p>
              </div>
              <!-- Card 4 -->
              <div class="risk-card">
                <div class="risk-card-header">
                  <span class="risk-card-icon">🧼</span>
                  <h4 class="risk-card-title">Sanitasi & Kebersihan</h4>
                </div>
                <p class="risk-card-desc">Ketiadaan akses air bersih, buruknya kondisi sanitasi, dan pola hidup yang kurang bersih meningkatkan risiko infeksi yang menghambat pertumbuhan anak.</p>
              </div>
            </div>
            <div class="alert-box">
              <span class="alert-box-icon">💡</span>
              <div>
                <strong>Ingat!</strong> Stunting tidak disebabkan oleh satu faktor saja. Gizi yang baik, kesehatan yang terjaga, serta sanitasi lingkungan yang bersih secara bersama-sama mendukung tumbuh kembang anak yang optimal.
              </div>
            </div>
          </div>

          <!-- Section 3: Pantau Pertumbuhan Anak -->
          <div id="pantau" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
              </div>
              <h2 class="section-title">3. Pantau Pertumbuhan Anak</h2>
            </div>
            <div class="growth-box">
              <div>
                <div class="posyandu-cycle">
                  <span class="cycle-item">⚖️ Timbang</span>
                  <span class="cycle-divider">·</span>
                  <span class="cycle-item">📐 Ukur</span>
                  <span class="cycle-divider">·</span>
                  <span class="cycle-item">📊 Pantau</span>
                  <span class="cycle-divider">·</span>
                  <span class="cycle-item">🏥 Ke Posyandu</span>
                </div>
                <p style="font-size:0.9rem; color:#4b5563; line-height:1.7; margin-bottom:14px;">
                  Jangan menunggu sampai anak terlihat sangat kurus atau pendek untuk bertindak. Pemantauan tumbuh kembang secara rutin di Posyandu setiap bulan adalah langkah deteksi dini terbaik.
                </p>
                <p style="font-size:0.9rem; color:#4b5563; line-height:1.7; margin-bottom:14px;">
                  Di Posyandu, balita mendapatkan pemantauan berat badan, pengukuran tinggi badan, imunisasi wajib, pemberian vitamin A, serta konseling kesehatan dari bidan desa dan kader.
                </p>
                <p style="font-size:0.9rem; color:#4b5563; line-height:1.7;">
                  Seluruh hasil pemantauan ini dicatat secara resmi pada <strong>Kartu Menuju Sehat (KMS)</strong> yang terdapat di dalam <strong>Buku KIA</strong> (Kesehatan Ibu dan Anak).
                </p>
              </div>
              <div style="background:#f8f9fa; border:1.5px solid var(--color-border); border-radius:12px; padding:20px; text-align:center;">
                <div style="font-size:3rem; margin-bottom:10px;">📅</div>
                <h4 style="font-size:0.95rem; font-weight:700; color:var(--color-text); margin-bottom:6px;">Komitmen Setiap Bulan</h4>
                <p style="font-size:0.8rem; color:#6b7280; line-height:1.5;">
                  Biasakan datang ke Posyandu secara rutin setiap bulan untuk memantau pertumbuhan fisik dan perkembangan motorik buah hati Anda.
                </p>
              </div>
            </div>
          </div>

          <!-- Section 4: 1.000 Hari Pertama Kehidupan -->
          <div id="hpk" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
              </div>
              <h2 class="section-title">4. 1.000 Hari Pertama Kehidupan (HPK)</h2>
            </div>
            <p style="font-size:0.9rem; color:#4b5563; line-height:1.6; margin-bottom:24px;">
              Periode emas yang terhitung sejak janin berada dalam kandungan (270 hari) hingga anak berusia 2 tahun (730 hari). Gangguan tumbuh kembang pada masa ini bersifat permanen dan sulit dipulihkan jika terlambat dicegah.
            </p>
            <div class="timeline">
              <!-- Item 1 -->
              <div class="timeline-item">
                <div class="timeline-badge"></div>
                <div class="timeline-header">
                  <h4 class="timeline-title">Tahap 1: Masa Kehamilan</h4>
                  <span class="timeline-stage">± 270 Hari</span>
                </div>
                <p class="timeline-desc">Memastikan pemenuhan gizi seimbang bagi ibu hamil, rutin mengonsumsi minimal 90 Tablet Tambah Darah (TTD) selama masa kehamilan, serta melakukan pemeriksaan kehamilan (ANC) secara berkala minimal 6 kali.</p>
              </div>
              <!-- Item 2 -->
              <div class="timeline-item">
                <div class="timeline-badge"></div>
                <div class="timeline-header">
                  <h4 class="timeline-title">Tahap 2: Inisiasi Menyusu Dini & ASI Eksklusif</h4>
                  <span class="timeline-stage">0 – 6 Bulan</span>
                </div>
                <p class="timeline-desc">Melakukan Inisiasi Menyusu Dini (IMD) segera setelah bayi lahir ke dunia, dan berkomitmen hanya memberikan ASI eksklusif saja (tanpa air putih, susu formula, maupun makanan lainnya) selama 6 bulan penuh.</p>
              </div>
              <!-- Item 3 -->
              <div class="timeline-item">
                <div class="timeline-badge"></div>
                <div class="timeline-header">
                  <h4 class="timeline-title">Tahap 3: MPASI & Lanjutan ASI</h4>
                  <span class="timeline-stage">6 – 23 Bulan</span>
                </div>
                <p class="timeline-desc">Memberikan Makanan Pendamping ASI (MPASI) yang bergizi seimbang dan bervariasi tepat di usia 6 bulan, sembari terus melanjutkan pemberian ASI hingga anak mencapai usia 2 tahun.</p>
              </div>
              <!-- Item 4 -->
              <div class="timeline-item">
                <div class="timeline-badge"></div>
                <div class="timeline-header">
                  <h4 class="timeline-title">Tahap 4: HPK Terlampaui</h4>
                  <span class="timeline-stage">Usia 2 Tahun</span>
                </div>
                <p class="timeline-desc">Pertumbuhan fisik dan tingkat perkembangan otak anak di periode emas ini sangat menentukan kualitas kesehatannya di masa depan. Inilah mengapa setiap bulan di fase ini begitu berharga.</p>
              </div>
            </div>
          </div>

          <!-- Section 5: Cara Pencegahan (Interactive Tabs) -->
          <div id="pencegahan" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                  <polyline points="9 11 11 13 15 9"></polyline>
                </svg>
              </div>
              <h2 class="section-title">5. Cara Pencegahan Stunting</h2>
            </div>
            
            <!-- Tab Navigation -->
            <div class="tabs-nav">
              <button class="tab-btn active" onclick="openTab(event, 'tab-hamil')">🤰 Saat Hamil</button>
              <button class="tab-btn" onclick="openTab(event, 'tab-asi')">🍼 ASI 0-6 Bulan</button>
              <button class="tab-btn" onclick="openTab(event, 'tab-mpasi')">🥣 MPASI 6+ Bulan</button>
            </div>

            <!-- Tab Content 1: Saat Hamil -->
            <div id="tab-hamil" class="tab-pane active">
              <ul class="prevention-list">
                <li>Ibu hamil mengonsumsi makanan bergizi seimbang, dengan menambahkan 1 porsi makan utama atau selingan padat gizi dari porsi makan biasanya.</li>
                <li>Rutin mengonsumsi Tablet Tambah Darah (TTD) minimal 1 tablet setiap hari (minimal 90 tablet selama kehamilan) untuk mencegah anemia.</li>
                <li>Rutin melakukan pemeriksaan kehamilan (ANC) minimal 6 kali ke fasilitas kesehatan, dengan minimal 2 kali diperiksa oleh dokter menggunakan USG.</li>
                <li>Mencukupi kebutuhan cairan tubuh dengan meminum air bersih sekitar 8–12 gelas per hari.</li>
              </ul>
              <div class="menu-box">
                <div class="menu-box-icon">🍽️</div>
                <div class="menu-box-content">
                  <div class="menu-box-title">Contoh Menu Lokal Ibu Hamil</div>
                  Nasi + sayur bening bayam + telur rebus + tempe goreng + pisang
                </div>
              </div>
            </div>

            <!-- Tab Content 2: ASI 0-6 Bulan -->
            <div id="tab-asi" class="tab-pane">
              <ul class="prevention-list">
                <li>Segera melakukan Inisiasi Menyusu Dini (IMD) begitu bayi dilahirkan untuk mendapatkan kolostrum kaya antibodi.</li>
                <li>Hanya berikan ASI eksklusif saja, tanpa air putih, madu, susu formula, maupun makanan padat selama 6 bulan pertama.</li>
                <li>Susui bayi sesering mungkin sesuai dengan permintaannya (on-demand), tanpa dijadwalkan secara kaku.</li>
                <li>Ibu menyusui harus tetap rutin mengonsumsi makanan bergizi seimbang agar kualitas dan produksi ASI tetap optimal.</li>
              </ul>
              <div class="menu-box" style="background: linear-gradient(135deg, rgba(108,117,125,0.04) 0%, rgba(108,117,125,0.01) 100%); border-color: rgba(108,117,125,0.12);">
                <div class="menu-box-icon" style="color: #6c757d; border-color: rgba(108,117,125,0.18);">💡</div>
                <div class="menu-box-content">
                  <div class="menu-box-title" style="color:#555;">Catatan Penting</div>
                  Belum diperlukan menu makanan pendamping (MPASI) pada tahap usia ini. Fokus utama sepenuhnya diarahkan pada pemberian ASI eksklusif tanpa tambahan makanan apapun.
                </div>
              </div>
            </div>

            <!-- Tab Content 3: MPASI 6+ Bulan -->
            <div id="tab-mpasi" class="tab-pane">
              <ul class="prevention-list">
                <li>Mulai kenalkan Makanan Pendamping ASI (MPASI) secara tepat waktu ketika anak genap berusia 6 bulan (tidak terlalu cepat atau lambat).</li>
                <li>Menyusun variasi menu MPASI berbasis "4 Bintang" yang mengandung karbohidrat, protein hewani, sayur/buah, serta tambahan lemak.</li>
                <li>Tingkatkan frekuensi makan, jumlah porsi, serta konsistensi tekstur makanan secara bertahap menyesuaikan pertambahan usia anak.</li>
                <li>Tetap lanjutkan pemberian ASI secara aktif sebagai pendamping makanan utama hingga anak genap berusia 2 tahun.</li>
              </ul>
              <div class="menu-box">
                <div class="menu-box-icon">🍲</div>
                <div class="menu-box-content">
                  <div class="menu-box-title">Contoh Menu Lokal MPASI 6+ Bulan</div>
                  Bubur nasi + hati ayam atau telur + bayam/wortel yang dihaluskan + sedikit santan atau minyak kelapa sebagai sumber lemak tambahan.
                </div>
              </div>
            </div>

          </div>

          <!-- Section 6: ABCDE Cegah Stunting -->
          <div id="abcde" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="16" x2="12" y2="12"></line>
                  <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
              </div>
              <h2 class="section-title">ABCDE Cegah Stunting</h2>
            </div>
            <p style="font-size:0.9rem; color:#4b5563; line-height:1.6; margin-bottom:20px;">
              Pesan kampanye pencegahan sederhana dari <strong>Kementerian Kesehatan RI</strong> yang sangat mudah diingat dan dipraktikkan oleh warga dalam kehidupan sehari-hari:
            </p>
            <div class="abcde-grid">
              <!-- Card A -->
              <div class="abcde-card">
                <div class="abcde-letter">A</div>
                <h4 class="abcde-title">Aktif Minum TTD</h4>
                <p class="abcde-desc">Remaja putri 1 tablet/minggu; ibu hamil 1 tablet/hari (minimal 90 tablet selama kehamilan).</p>
              </div>
              <!-- Card B -->
              <div class="abcde-card">
                <div class="abcde-letter">B</div>
                <h4 class="abcde-title">Bumil Rutin Periksa</h4>
                <p class="abcde-desc">Melakukan pemeriksaan kehamilan (ANC) minimal 6x, 2x di antaranya dengan USG dokter.</p>
              </div>
              <!-- Card C -->
              <div class="abcde-card">
                <div class="abcde-letter">C</div>
                <h4 class="abcde-title">Cukupi Protein Hewani</h4>
                <p class="abcde-desc">Rutin makan telur, ikan, ayam, atau daging setiap hari, terutama bagi bayi di atas 6 bulan.</p>
              </div>
              <!-- Card D -->
              <div class="abcde-card">
                <div class="abcde-letter">D</div>
                <h4 class="abcde-title">Datang ke Posyandu</h4>
                <p class="abcde-desc">Hadir setiap bulan untuk pemantauan tumbuh kembang, penimbangan, pengukuran, dan imunisasi.</p>
              </div>
              <!-- Card E -->
              <div class="abcde-card">
                <div class="abcde-letter">E</div>
                <h4 class="abcde-title">Eksklusif ASI 6 Bulan</h4>
                <p class="abcde-desc">Hanya memberikan ASI eksklusif selama 6 bulan, dilanjutkan hingga 2 tahun bersama MPASI.</p>
              </div>
            </div>
          </div>

          <!-- Section 7: Kapan Perlu Konsultasi? -->
          <div class="stunting-section" style="padding:0; overflow:hidden; border:none;">
            <div class="consult-box">
              <div>
                <h3 class="consult-title">
                  <span style="font-size:1.3rem;">🚨</span> Kapan Perlu Konsultasi?
                </h3>
                <p class="consult-desc">
                  Jangan menunda untuk mencari bantuan medis. Segera hubungi Bidan Desa Munggur, kader Posyandu, atau berkunjung ke Puskesmas Andong terdekat apabila mendapati tanda-tanda berikut pada balita Anda:
                </p>
              </div>
              <div>
                <ul class="consult-list">
                  <li>Berat atau panjang/tinggi badan anak tidak naik selama 2 bulan berturut-turut.</li>
                  <li>Tinggi badan anak tampak jelas lebih pendek dibandingkan teman-teman seusianya.</li>
                  <li>Nafsu makan menurun drastis atau anak mengalami kesulitan makan dalam waktu lama.</li>
                  <li>Anak sering terserang sakit atau terkena infeksi berulang (diare, ISPA).</li>
                  <li>Perkembangan motorik atau kemampuan bicara anak terasa lambat dari standar usianya.</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Section 8: FAQ (Accordions) -->
          <div id="faq" class="stunting-section">
            <div class="section-title-wrap">
              <div class="section-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                  <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
              </div>
              <h2 class="section-title">Pertanyaan Sering Diajukan (FAQ)</h2>
            </div>
            
            <div class="faq-list">
              <!-- Item 1 -->
              <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                  Apakah stunting bisa disembuhkan?
                  <svg class="faq-icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </button>
                <div class="faq-answer">
                  <div class="faq-answer-inner">
                    Pencegahan sejak dini (terutama di 1.000 HPK) adalah kunci utama. Apabila stunting baru terdeteksi setelah anak melewati usia 2 tahun, dampaknya secara fisik dan kognitif akan sulit dipulihkan sepenuhnya. Namun, intervensi gizi ekstra dan stimulasi psikososial yang tepat tetap sangat membantu mendukung sisa proses tumbuh kembang anak semaksimal mungkin.
                  </div>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                  Anak saya terlihat pendek tapi aktif dan sehat, apakah pasti stunting?
                  <svg class="faq-icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </button>
                <div class="faq-answer">
                  <div class="faq-answer-inner">
                    Belum tentu. Status stunting anak tidak bisa dipastikan secara kasat mata hanya dengan melihat tinggi fisiknya saja. Penentuan diagnosis memerlukan pengukuran panjang atau tinggi badan yang presisi disesuaikan dengan umur anak, lalu membandingkannya dengan kurva standar pertumbuhan WHO. Oleh sebab itu, pengukuran berkala di Posyandu sangat penting.
                  </div>
                </div>
              </div>

              <!-- Item 3 -->
              <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                  Apakah ASI saja cukup sampai anak berusia 1 tahun?
                  <svg class="faq-icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </button>
                <div class="faq-answer">
                  <div class="faq-answer-inner">
                    Tidak. Pemberian ASI eksklusif (hanya ASI saja) sangat dianjurkan hanya untuk kelompok usia bayi 0–6 bulan. Setelah menginjak usia 6 bulan ke atas, kebutuhan gizi mikro dan energi bayi semakin meningkat secara pesat sehingga harus ditunjang oleh Makanan Pendamping ASI (MPASI), sembari ASI tetap terus diberikan secara aktif hingga anak genap berumur 2 tahun.
                  </div>
                </div>
              </div>

              <!-- Item 4 -->
              <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                  Kenapa harus ke Posyandu tiap bulan padahal anak terlihat sehat?
                  <svg class="faq-icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </button>
                <div class="faq-answer">
                  <div class="faq-answer-inner">
                    Pemantauan rutin setiap bulan berfungsi sebagai langkah pencegahan (preventif) dan deteksi dini. Banyak gangguan gizi dan perlambatan pertumbuhan yang tidak langsung terlihat secara kasat mata di fase-fase awal. Mengetahui adanya keterlambatan pertumbuhan lebih awal akan membuat penanganan jauh lebih mudah dan berhasil dibandingkan mengobatinya setelah stunting terjadi.
                  </div>
                </div>
              </div>

              <!-- Item 5 -->
              <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                  Apa bedanya gizi buruk dan stunting?
                  <svg class="faq-icon-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                </button>
                <div class="faq-answer">
                  <div class="faq-answer-inner">
                    Gizi buruk (wasting) dinilai dari indeks berat badan menurut tinggi badan (kondisi anak terlihat sangat kurus akut). Sedangkan stunting (shortness) diukur dari indeks panjang atau tinggi badan menurut umur (kondisi pertumbuhan tulang terhambat sehingga terlihat sangat pendek kronis). Seorang anak balita bisa saja terkena stunting tanpa terlihat kurus sama sekali.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Bottom CTA Banner -->
          <div class="cta-banner">
            <h3 class="cta-title">Bersama Cegah Stunting, Sehat Bersama Desa Munggur</h3>
            <p class="cta-desc">
              Tumbuh kembang anak yang optimal adalah tanggung jawab bersama orang tua, kader kesehatan, bidan desa, dan seluruh warga. Yuk, rutin berpartisipasi datang ke Posyandu setiap bulan!
            </p>
          </div>

          <!-- References Section -->
          <div class="references-box">
            <h3 class="references-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
              </svg>
              Sumber & Referensi Medis
            </h3>
            <ol class="references-list">
              <li>World Health Organization. <em>Global Nutrition Targets 2030: Stunting Brief</em>. Geneva: WHO; 2025.</li>
              <li>World Health Organization. <em>Infant and Young Child Feeding</em>. WHO.</li>
              <li>World Health Organization. <em>Water, Sanitation and Hygiene (WASH)</em>. WHO.</li>
              <li>Kementerian Kesehatan RI. <em>ABCDE Cegah Stunting</em>. ayosehat.kemkes.go.id.</li>
              <li>Kementerian Kesehatan RI. <em>1000 HPK Kunci Cegah Stunting</em>. ayosehat.kemkes.go.id.</li>
              <li>Kementerian Kesehatan RI. <em>Panduan Kartu Menuju Sehat (KMS) & Pemantauan Pertumbuhan Balita</em>.</li>
              <li>UNICEF. <em>Infant and Young Child Feeding</em>. unicef.org.</li>
            </ol>
          </div>

        </div>
      </div>
    </section>

@endsection

@section('scripts')
<script>
  // Tab control function
  function openTab(evt, tabId) {
    // Hide all tab panes
    const panes = document.querySelectorAll('.tab-pane');
    panes.forEach(pane => {
      pane.classList.remove('active');
    });

    // Deactivate all tab buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(btn => {
      btn.classList.remove('active');
    });

    // Show selected tab pane and activate button
    const targetPane = document.getElementById(tabId);
    if (targetPane) {
      targetPane.classList.add('active');
    }
    evt.currentTarget.classList.add('active');
  }

  // FAQ Accordion control function
  function toggleFaq(buttonEl) {
    const item = buttonEl.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isExpanded = item.classList.contains('expanded');

    // Close other open accordions
    const allItems = document.querySelectorAll('.faq-item');
    allItems.forEach(i => {
      if (i !== item) {
        i.classList.remove('expanded');
        i.querySelector('.faq-answer').style.maxHeight = null;
      }
    });

    // Toggle current accordion
    if (isExpanded) {
      item.classList.remove('expanded');
      answer.style.maxHeight = null;
    } else {
      item.classList.add('expanded');
      answer.style.maxHeight = answer.scrollHeight + 'px';
    }
  }

  // Smooth scroll support for local anchors in quick nav
  document.querySelectorAll('.quick-nav-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        // Offset for sticky header if needed
        const headerOffset = 90;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });

        // Set active state in quick nav
        document.querySelectorAll('.quick-nav-link').forEach(link => link.classList.remove('active'));
        this.classList.add('active');
      }
    });
  });

  // Scrollspy feature to highlight quick-nav links on scroll
  window.addEventListener('scroll', () => {
    const sections = ['kenali', 'faktor', 'pantau', 'hpk', 'pencegahan', 'abcde', 'faq'];
    const scrollPosition = window.scrollY + 120; // offset

    sections.forEach(id => {
      const el = document.getElementById(id);
      if (el) {
        const top = el.offsetTop;
        const height = el.offsetHeight;
        
        if (scrollPosition >= top && scrollPosition < top + height) {
          document.querySelectorAll('.quick-nav-link').forEach(link => {
            if (link.getAttribute('href') === `#${id}`) {
              link.classList.add('active');
            } else {
              link.classList.remove('active');
            }
          });
        }
      }
    });
  });
</script>
@endsection

# 🎨 Design Specification — Website Desa Munggur

Dokumen ini adalah hasil audit UI/UX aktual dari aplikasi Desa Munggur. Isinya diturunkan langsung dari seluruh file Blade di `backend/resources/views/`—termasuk scaffold yang tidak dirutekan—stylesheet di `backend/public/assets/css/`, JavaScript di `backend/public/assets/js/`, serta aset visual di `backend/public/assets/`.

Dokumen ini dimaksudkan sebagai **blueprint implementasi ulang**, bukan usulan redesign. Nilai, class, state, dan struktur di bawah menggambarkan codebase saat ini.

---

## 1. Ringkasan Sistem Desain

### 1.1 Karakter visual

- Gaya utama: **clean civic/institutional**, dominan putih, slate, dan hijau agrikultur.
- Aksen identitas: hijau gelap `#2d6a4f` dengan hover `#1b4332`.
- Bentuk: card dengan sudut medium–besar, border tipis, shadow ringan, dan pill untuk badge/tombol tertentu.
- Tipografi: **Inter**, dengan heading tebal `700–800` dan body `400–500`.
- Interaksi: hover lift, perubahan border hijau, reveal-on-scroll, modal, tabs, accordion, dan carousel native.
- Implementasi frontend aktif: Blade + CSS biasa + Vanilla JavaScript; **bukan Tailwind runtime** dan tidak memakai framework komponen UI.

### 1.2 Hierarki sumber style

| Prioritas | Sumber | Peran |
| :---: | :--- | :--- |
| 1 | `<style>` pada masing-masing `pages/*.blade.php` | Variasi halaman dan komponen khusus; dimuat setelah stylesheet global sehingga dapat override class generik. |
| 2 | `public/assets/css/pages.css` | Pola inner page lama: profil, sidebar statistik, organisasi, UMKM, dan komoditas. Hanya dimuat jika view mendefinisikan `@section('extra-css', true)`. |
| 3 | `public/assets/css/style.css` | Reset, token global, layout, navbar, hero, categories, profil home, footer, dan page shell. |

> **Catatan penting:** nama seperti `.section-title`, `.btn-primary`, `.form-input`, `.org-card`, `.tab-btn`, `.faq-item`, `.modal-overlay`, `.umkm-card`, dan `.komoditas-card` digunakan ulang di beberapa tempat. Nilainya dapat berbeda karena CSS internal Blade berada setelah CSS global. Saat membangun ulang, gunakan namespace atau komponen terisolasi agar tidak terjadi collision.

### 1.3 Layout Blade aktif

```blade
{{-- backend/resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Desa Munggur')</title>

  {{-- Inter 300–800 dari Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet"
  >

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @hasSection('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">
  @endif
  @yield('head')
</head>
<body>
  @include('partials.navbar')
  <main>@yield('content')</main>
  @include('partials.footer')

  <script src="{{ asset('assets/js/main.js') }}"></script>
  @yield('scripts')
</body>
</html>
```

### 1.4 Cakupan audit

| Kelompok | Jumlah | Cakupan |
| :--- | :---: | :--- |
| Blade | `19` file | 1 layout, 14 page views, 3 partials, dan 1 scaffold `welcome.blade.php` yang tidak dirutekan. |
| CSS publik | `2` file | `style.css` dan `pages.css`, termasuk seluruh media query, custom property, state, dan animation. |
| JavaScript publik | `3` file | `main.js`, `api.service.js`, dan `firebase-config.js`; script inline pada setiap Blade juga diaudit. |
| Public assets | `26` file | 2 CSS, 3 JS, 10 PNG icon, 2 PNG photography, 8 JPEG, dan 1 SVG logo. |

> Angka di atas mengikuti isi `backend/public/assets/` pada saat audit. Dari 26 file tersebut, 21 adalah image/icon (`12` PNG, `8` JPEG, `1` SVG); 5 lainnya adalah stylesheet dan JavaScript.

---

## 2. Design Tokens

## 2.1 Palet warna global

Token resmi berada di `public/assets/css/style.css` pada `:root`.

| Token CSS | Nilai | Padanan Tailwind terdekat | Pemakaian utama |
| :--- | :---: | :--- | :--- |
| `--color-primary` | `#0f172a` | `slate-900` | Heading, navbar login hover, footer base. |
| `--color-secondary` | `#334155` | `slate-700` | Link navbar, body copy sekunder. |
| `--color-accent` | `#2d6a4f` | `bg-[#2d6a4f]` | Brand green, CTA, icon accent, active state, border hover. |
| `--color-accent-light` | `#40916c` | `bg-[#40916c]` | Varian hijau terang; jarang dipakai langsung. |
| `--color-accent-hover` | `#1b4332` | `bg-[#1b4332]` | Hover CTA dan gradient hijau gelap. |
| `--color-bg` | `#fafafa` | `neutral-50` | Latar halaman publik. |
| `--color-bg-light` | `#f1f5f9` | `slate-100` | Panel lembut, stat cards, hover surface. |
| `--color-bg-card` | `#ffffff` | `white` | Card dan panel. |
| `--color-text` | `#1e293b` | `slate-800` | Teks utama. |
| `--color-text-muted` | `#475569` | `slate-600` | Caption dan deskripsi. |
| `--color-border` | `#e2e8f0` | `slate-200` | Border global. |
| `--color-footer-bg` | `#0f172a` | `slate-900` | Footer. |
| `--color-footer-text` | `#f8fafc` | `slate-50` | Teks footer utama. |
| `--color-footer-muted` | `#94a3b8` | `slate-400` | Link/caption footer. |

### Palet operasional yang sering muncul

Nilai berikut tidak semuanya didefinisikan sebagai custom property, tetapi berulang pada CSS halaman:

| Peran | Nilai | Contoh |
| :--- | :--- | :--- |
| Border card legacy | `#e5e7eb` | Card inner page, form, tabel, modal. |
| Text heading legacy | `#1a1a1a` | Judul card dan modal. |
| Text body legacy | `#4b5563` / `#6b7280` / `#6c757d` | Deskripsi, metadata, label sekunder. |
| Surface lembut | `#f8f9fa`, `#f9fafb`, `#f3f4f6` | Info block, row hover, form secondary. |
| Green tint | `#e8f5e9`, `#d8f3dc` | Highlight box, badge, CTA subtitle. |
| Green translucent | `rgba(45, 106, 79, 0.08–0.16)` | Active nav, badge, icon background, focus ring. |
| Warning | `#d97706`, `#f59e0b`, `#fef3c7`, `#fffbeb` | Price tag, duty box, alert. |
| Danger | `#dc2626`, `#991b1b`, `#7f1d1d`, `#fee2e2`, `#fef2f2` | Delete action, validation, consultation warning. |
| WhatsApp | `#25d366` → `#1ebe57` | Tombol kontak modal UMKM. |
| Excel | `#107c41` → `#0b5c30` | Tombol unduh spreadsheet. |
| Admin shell | `#111`, `#f0f2f5` | Sidebar gelap dan background dashboard. |

### State warna utama

```css
/* Neutral navigation */
.nav-link {
  color: var(--color-secondary);
}

/* Hover / active */
.nav-link:hover,
.nav-link.active {
  color: var(--color-accent);
  background: rgba(45, 106, 79, 0.08);
}

/* CTA */
.btn-primary { background: #2d6a4f; color: #fff; }
.btn-primary:hover { background: #1b4332; }
```

## 2.2 Tipografi

### Font family

```css
--font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
```

- Google Fonts memuat Inter pada weight `300, 400, 500, 600, 700, 800`.
- Halaman publik memakai layout global.
- `login.blade.php` dan `admin.blade.php` adalah dokumen standalone tetapi memuat Inter yang sama.
- `welcome.blade.php` memakai Instrument Sans dan compiled Tailwind, tetapi **tidak dirutekan sebagai UI aplikasi aktif**.

### Skala font global

| Token | Rem | Pixel nominal | Penggunaan tipikal |
| :--- | :---: | :---: | :--- |
| `--font-size-xs` | `0.75rem` | `12px` | Caption, lokasi navbar, stat label, footer copyright. |
| `--font-size-sm` | `0.875rem` | `14px` | Navigasi, button, card label, footer links. |
| `--font-size-base` | `1rem` | `16px` | Body, hero subtitle, profil copy. |
| `--font-size-lg` | `1.125rem` | `18px` | Footer brand dan heading minor. |
| `--font-size-xl` | `1.25rem` | `20px` | Section title. |
| `--font-size-2xl` | `1.5rem` | `24px` | Page heading dan heading profil. |
| `--font-size-3xl` | `2rem` | `32px` | Heading besar/SOP hero. |
| `--font-size-4xl` | `2.5rem` | `40px` | Token tersedia, tidak dominan pada UI aktif. |

### Hierarki aktual

| Level | Ukuran | Weight | Line-height | Catatan |
| :--- | :--- | :---: | :---: | :--- |
| Hero `h1` | `clamp(1.8rem, 4vw, 2.8rem)` | `800` | `1.2` | Mobile menjadi `1.6rem`; putih dengan text-shadow. |
| Page `h1` | `1.5rem` | `700` | inherited | `.page-header-title`. |
| Section heading utama | `1.25rem` | `700–800` | inherited | `.section-title`; beberapa page override hingga `1.75rem`. |
| Card heading | `0.95–1.35rem` | `700–800` | `1.3–1.4` | Berbeda per feature. |
| Body | `0.95–1rem` | `400` | `1.6–1.8` | Inner pages banyak memakai `0.95rem`. |
| Label/button | `0.78–0.9rem` | `600–700` | normal | Form, CTA, tabs. |
| Caption/badge | `0.68–0.8rem` | `500–800` | `1.3–1.5` | Sering uppercase + letter spacing. |

Heading global memakai `letter-spacing: -0.02em`. Label uppercase biasanya memakai `letter-spacing: 0.05–0.06em`.

## 2.3 Spacing dan layout

Tidak ada spacing token resmi. Skala yang muncul konsisten pada kelipatan kecil berikut:

```text
4, 6, 8, 10, 12, 14, 16, 20, 24, 28, 32, 36, 40, 48, 60, 64, 72 px
```

### Container dan shell

| Elemen | Desktop | Responsive |
| :--- | :--- | :--- |
| `.container` | `max-width: 1100px; padding-inline: 24px` | Lebar selalu `100%`. |
| `.navbar-inner` | `max-width: 1200px; padding-inline: 28px` | Menu desktop hilang pada `≤768px`. |
| Navbar | Tinggi `72px`, sticky di atas | Tinggi `auto` pada `≤768px`. |
| Hero | Tinggi `440px` | `320px` pada `≤768px`. |
| `.page-main` | `padding: 48px 0 72px` | Isi mengikuti container. |
| Categories | `padding: 40px 0 32px` | Grid berubah menjadi horizontal scroller. |
| Profil home | `padding: 40px 0 60px` | Stat cards wrap. |
| Footer | `padding: 64px 0 24px` | 4 → 2 → 1 kolom. |

### Gap umum

- Inline icon + text: `6–14px`.
- Form grid: `16px`.
- Small card grid: `14–20px`.
- Standard card grid: `24px`.
- Feature card grid: `24–32px`.
- Footer desktop: `40px`.
- Profil two-column content: `48px`.

## 2.4 Border radius

| Token proyek | Nilai | Padanan Tailwind | Pemakaian |
| :--- | :---: | :--- | :--- |
| `--radius-sm` | `8px` | `rounded-lg` | Nav item, input, icon wrapper. |
| `--radius-md` | `12px` | `rounded-xl` | Card standar, modal info block. |
| `--radius-lg` | `16px` | `rounded-2xl` | Section card, content block. |
| `--radius-xl` | `24px` | `rounded-3xl` | Token tersedia; card besar tertentu. |
| `--radius-full` | `9999px` | `rounded-full` | Login pill, CTA, badge, dot aktif. |

Variasi scoped yang juga digunakan: `10px`, `14px`, `18px`, dan `20px`. Avatar, arrow, icon circle, dan close button memakai `50%`.

## 2.5 Shadow, border, dan transition

### Shadow token

```css
--shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
             0 2px 4px -1px rgba(0, 0, 0, 0.06);
--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
             0 4px 6px -2px rgba(0, 0, 0, 0.05);
--shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
             0 10px 10px -5px rgba(0, 0, 0, 0.04);
```

### Konvensi komponen

- Border card: `1px` atau `1.5px solid #e5e7eb / var(--color-border)`.
- Hover card: border menjadi hijau dan `translateY(-2px … -6px)`.
- Modal: shadow besar `0 20px 60px` atau `0 24px 80px` dengan overlay hitam `0.55–0.60`.
- Focus input: border hijau + ring `0 0 0 3–4px rgba(45,106,79,0.10)`.
- Transition global: `--transition: 0.22s ease`.
- Image hover: `transform: scale(1.05)` selama `0.3s`.

## 2.6 Responsive breakpoints

| Breakpoint | Efek global |
| :---: | :--- |
| `≤1024px` | Categories 6 → 3 kolom; footer 4 → 2 kolom. |
| `≤768px` | Desktop nav disembunyikan, hamburger tampil; hero dipendekkan; categories menjadi horizontal scroll; footer 1 kolom; inner grids umumnya 1–2 kolom. |
| `≤520px` | Penyesuaian khusus halaman kesehatan. |
| `≤480px` | Category card menjadi setengah viewport scroller; UMKM 1 kolom; padding/card diperkecil. |
| `≥992px` | Layout gambar–teks dua kolom pada halaman budaya. |

---

## 3. Breakdown Komponen Global

## 3.1 Header dan navbar

### Anatomy

1. Sticky glass navbar (`rgba(255,255,255,.85)` + blur `16px`).
2. Brand: logo Boyolali `48×48`, nama desa, nama kabupaten.
3. Link Beranda.
4. Tiga dropdown kelompok menu.
5. Tombol Login berbentuk pill outline.
6. Hamburger dan mobile menu pada `≤768px`.

### Blade skeleton

```blade
<header class="navbar" id="main-navbar">
  <div class="navbar-inner">
    <a href="{{ url('/') }}" class="navbar-brand">
      <img
        src="{{ asset('assets/images/boyolali-logo.svg') }}"
        alt="Logo Kabupaten Boyolali"
        class="navbar-logo"
      >
      <div class="navbar-title">
        <span class="navbar-desa">Desa Munggur</span>
        <span class="navbar-kabupaten">Kabupaten Boyolali</span>
      </div>
    </a>

    <nav class="navbar-nav">
      <a
        href="{{ url('/') }}"
        class="nav-link {{ request()->is('/') ? 'active' : '' }}"
      >Beranda</a>

      <div class="nav-dropdown">
        <button class="nav-dropdown-toggle" type="button">
          Pemerintahan & Layanan
          <span class="nav-dropdown-chevron"></span>
        </button>
        <div class="nav-dropdown-menu">
          <a
            href="{{ url('/profil-desa') }}"
            class="nav-dropdown-item {{ request()->is('profil-desa') ? 'active' : '' }}"
          >Profil Desa</a>
          {{-- item lain --}}
        </div>
      </div>
    </nav>

    <div class="navbar-actions">
      <a href="{{ url('/login') }}" class="btn-login">Login</a>
      <button class="hamburger" id="hamburger-btn" aria-label="Toggle Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  @include('partials.mobile-menu')
</header>
```

### State contract

| State | Class | Perubahan visual/behavior |
| :--- | :--- | :--- |
| Scrolled | `.navbar.scrolled` | Background `.95`, shadow kecil. Aktif setelah scroll `>10px`. |
| Link active | `.nav-link.active` | Hijau + green tint. |
| Dropdown open | `.nav-dropdown.open` | Panel opacity/visibility aktif; chevron berputar `180°`. |
| Dropdown item active | `.nav-dropdown-item.active` | Green tint dan weight `600`. |
| Mobile open | `.mobile-menu.open` | `display:flex`. |
| Login hover | `.btn-login:hover` | Background slate-900, text putih. |

Dropdown dibuka dengan click, dropdown lain ditutup, click luar dan tombol `Escape` menutup semua dropdown.

### Mobile menu

Mobile menu bukan accordion. Semua kelompok dan link ditampilkan vertikal dengan:

- group label `0.72rem`, uppercase, weight `700`, hijau;
- child link indent `28px`;
- divider `#e5e7eb`;
- login di bagian bawah.

## 3.2 Hero slider / carousel

### Blade skeleton

```blade
<section class="hero-slider" id="hero-section">
  <div class="slider-wrapper">
    @foreach ($slides as $index => $slide)
      <div
        class="slide {{ $index === 0 ? 'active' : '' }}"
        style="background-image:url('{{ asset($slide['image']) }}')"
      >
        <div class="slide-overlay"></div>
        <div class="slide-content">
          <h1 class="slide-title">{{ $slide['title'] }}</h1>
          <p class="slide-subtitle">{{ $slide['subtitle'] }}</p>
        </div>
      </div>
    @endforeach
  </div>

  <button class="slider-arrow slider-prev" id="slider-prev" aria-label="Slide Sebelumnya">
    {{-- inline chevron SVG --}}
  </button>
  <button class="slider-arrow slider-next" id="slider-next" aria-label="Slide Berikutnya">
    {{-- inline chevron SVG --}}
  </button>

  <div class="slider-dots">
    @foreach ($slides as $index => $slide)
      <button
        class="dot {{ $index === 0 ? 'active' : '' }}"
        aria-label="Slide {{ $index + 1 }}"
      ></button>
    @endforeach
  </div>
</section>
```

### Visual contract

- Desktop: `440px`; mobile: `320px`.
- Slide absolute, fade opacity `0.7s`.
- Desktop image menggunakan `background-size: 100% 100%`; mobile `cover`.
- Overlay: gradient horizontal dari `rgba(15,23,42,.85)` → `.4` → transparent.
- Content max-width `640px`, padding horizontal `60px` (`32px` tablet, `20px` mobile).
- Active content masuk dengan `fadeInUp`, `0.8s`, delay `0.2s`.
- Arrow: lingkaran `42×42`, glass white `.18`, border white `.35`, blur `4px`.
- Dot normal `8×8`; active menjadi capsule `24×8` putih.

### Behavior contract

- Native Vanilla JS; tidak memakai Swiper/Slick.
- Autoplay setiap `4500ms`.
- Pause saat pointer hover di hero.
- Prev/next dan dot mereset autoplay.
- Swipe threshold mobile: `50px`.

## 3.3 Section header dengan aksen vertikal

```blade
<div class="categories-header">
  <div class="section-title-group">
    <span class="section-accent" aria-hidden="true"></span>
    <h2 class="section-title">Categories</h2>
  </div>

  <div class="categories-nav-btns">
    <button class="cat-nav-btn" aria-label="Geser kiri">{{-- SVG --}}</button>
    <button class="cat-nav-btn" aria-label="Geser kanan">{{-- SVG --}}</button>
  </div>
</div>
```

| Elemen | Style |
| :--- | :--- |
| Accent | `5×28px`, hijau, full radius. |
| Group gap | `10px`. |
| Heading | `1.25rem`, weight `700`, slate-900. |
| Nav arrow | `38×38px`, circle, border `1.5px`; hover hijau + tint. |

Pola alternatif inner page menggunakan `border-left: 4px solid #2d6a4f; padding-left: 12px` langsung pada `h2`.

## 3.4 Category / quick access cards

```blade
<div class="categories-grid" id="categories-grid">
  @foreach ($categories as $category)
    <a href="{{ url($category['href']) }}" class="category-card">
      <div class="category-icon-wrap">
        <img
          src="{{ asset($category['icon']) }}"
          alt="{{ $category['label'] }}"
          class="category-icon"
        >
      </div>
      <span class="category-label">{{ $category['label'] }}</span>
    </a>
  @endforeach
</div>
```

### Layout dan style

- Desktop: CSS Grid 6 kolom, gap `14px`.
- `≤1024px`: 3 kolom.
- `≤768px`: horizontal flex scroller, hidden scrollbar, scroll snap.
- Card tablet: basis `calc(33.333% - 8px)`; mobile `calc(50% - 6px)`.
- Card padding `22px 12px 18px`; gap `12px`.
- Border `1.5px`, radius `12px`, background putih.
- Icon wrapper `52×52`; PNG icon `48×48`, `object-fit:contain`.
- Label `0.875rem`, weight `500`, line-height `1.3`.
- Hover: border hijau, shadow hijau lembut, `translateY(-6px) scale(1.02)`.
- Arrow scroll menggeser container `200px` dengan smooth behavior.

> Ikon quick access tampak sebagai ilustrasi line-art, tetapi secara teknis disimpan sebagai **PNG raster**, bukan icon font atau SVG inline.

## 3.5 Profil summary dan statistic cards

```blade
<section class="profil-section">
  <div class="container">
    <div class="profil-icon-title">
      <svg class="profil-section-icon"><!-- house line icon --></svg>
      <div>
        <h2 class="profil-main-title">Profil Desa Munggur</h2>
        <span class="profil-sub-location">Kecamatan Andong, Kabupaten Boyolali</span>
      </div>
    </div>

    <div class="profil-content">
      <p class="profil-intro">...</p>

      <div class="profil-stats-row">
        <div class="stat-card">
          <span class="stat-number">2.700</span>
          <span class="stat-label">Jiwa</span>
        </div>
      </div>

      <a href="{{ url('/profil-desa') }}" class="btn-primary">Selengkapnya →</a>
    </div>
  </div>
</section>
```

- Copy max-width `780px`, line-height `1.75`.
- Stat row flex + wrap, gap `16px`.
- Stat card flex-grow, min-width `120px`, padding `20×24`, background slate-100.
- Number `1.5rem / 800 / green`; label `0.75rem / 500`.
- Number dianimasikan dari 0 selama `1200ms` ketika 30% terlihat melalui `IntersectionObserver`.
- CTA pill `11×28px`; hover lift `-2px` dan green glow.

## 3.6 Shared inner-page header

```blade
<section class="page-header">
  <div class="container">
    <div class="page-header-inner">
      <img class="page-header-icon" src="{{ asset('assets/icons/umkm.png') }}" alt="">
      <div>
        <h1 class="page-header-title">Judul Halaman</h1>
        {{-- subtitle opsional --}}
      </div>
    </div>
  </div>
</section>

<section class="page-main">
  <div class="container">
    {{-- konten --}}
  </div>
</section>
```

- Header padding `36px 0 28px` + bottom border.
- Icon standar `36×36`.
- Heading `1.5rem / 700`.
- Main content `48px 0 72px`, minimum height `60vh`.

Beberapa page mengganti image icon dengan inline SVG di dalam square `42–48px` ber-background green tint.

## 3.7 Generic feature/content card

Tidak ada satu class universal, tetapi pola visual konsisten:

```blade
<article class="feature-card">
  <div class="feature-card-header">
    <div class="feature-card-icon">{{-- SVG / emoji / image --}}</div>
    <div>
      <span class="feature-badge">Kategori</span>
      <h3 class="feature-card-title">Judul</h3>
    </div>
  </div>
  <p class="feature-card-description">Deskripsi...</p>
  <a class="feature-card-action" href="#">Lihat Detail</a>
</article>
```

Blueprint nilai dominan:

```css
.feature-card {
  padding: 24px;                 /* 20–32px pada variasi aktual */
  background: #fff;
  border: 1.5px solid #e5e7eb;
  border-radius: 14px;           /* aktual 12–20px */
  box-shadow: 0 4px 16px rgba(0,0,0,.03);
  transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
}

.feature-card:hover {
  border-color: #2d6a4f;
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0,0,0,.08);
}
```

## 3.8 Footer

```blade
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <h3 class="footer-brand-name">Desa Munggur</h3>
        <p class="footer-brand-desc">Kecamatan Andong, Kabupaten Boyolali...</p>
      </div>

      <div class="footer-col">
        <h4 class="footer-col-title">Support</h4>
        <ul class="footer-links">
          <li><a class="footer-link" href="mailto:...">Email</a></li>
        </ul>
      </div>

      <div class="footer-col">{{-- Menu Utama --}}</div>
      <div class="footer-col">{{-- Account --}}</div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copy">&copy; 2025 Desa Munggur.</p>
      <p class="footer-credit">Dibuat dengan ❤ untuk masyarakat Desa Munggur</p>
    </div>
  </div>
</footer>
```

### Visual contract

- Gradient `#0f172a` → `#1e293b`.
- Grid desktop `2fr 1.5fr 1.5fr 1fr`, gap `40px`.
- `≤1024px`: 2 kolom; `≤768px`: 1 kolom.
- Heading column uppercase `0.875rem / 700 / 0.06em`.
- Link/copy muted slate-400; hover slate-50.
- Footer bottom border white `.1`, flex between; stacked di mobile.

---

## 4. Komponen Pendukung dan Pola Interaksi

## 4.1 Badge / pill

```html
<span class="badge badge-green">Kategori</span>
```

Pola dominan:

```css
padding: 3px 10px;       /* atau 4px 12px */
border-radius: 999px;
font-size: 0.7–0.75rem;
font-weight: 600–800;
background: rgba(45,106,79,.1);
color: #2d6a4f;
```

Varian: gray, warning amber, red/danger, outline green.

## 4.2 Button

| Varian | Visual |
| :--- | :--- |
| Primary | Hijau `#2d6a4f`, putih, weight `600–700`; hover `#1b4332` + lift. |
| Secondary | `#f3f4f6`, text `#374151`, border `#e5e7eb`. |
| Danger | `#fef2f2`, text `#dc2626`, border `#fecaca`; hover merah solid. |
| Outline login | Putih/transparan, slate border, full pill; hover slate-900. |
| WhatsApp | `#25d366`, full-width pada modal UMKM. |
| Excel | `#107c41`, icon + label, shadow hijau. |
| Icon circle | `36–42px`, radius 50%, digunakan untuk close dan arrow. |

## 4.3 Form controls

```blade
<div class="form-group">
  <label class="form-label" for="field">Label</label>
  <input class="form-input" id="field" type="text" placeholder="...">
  <p class="form-hint">Keterangan opsional</p>
</div>
```

Pola dominan:

- label `0.78–0.9rem`, weight `600–700`;
- input padding `10–14px` horizontal `13–16px`;
- border `1.5px solid #e5e7eb / #d1d5db`;
- radius `8–10px`;
- focus border hijau + ring green `.10`;
- textarea vertical resize;
- button disabled menggunakan `#9ca3af`.

## 4.4 Modal

```blade
<div class="modal-overlay" id="detailModal" onclick="closeModalOnOverlay(event)">
  <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <button class="modal-close" aria-label="Tutup modal">&times;</button>
    <div class="modal-image-wrap"><img class="modal-image" alt=""></div>
    <div class="modal-content">
      <span class="modal-badge">Kategori</span>
      <h3 class="modal-title" id="modalTitle">Judul</h3>
      <div class="modal-info-block">...</div>
    </div>
  </div>
</div>
```

- Overlay fixed full-screen; UMKM default menggunakan opacity/pointer-events, keuangan memakai `display:none` → `.open { display:flex }`.
- Box radius `20px`, max-width `780–860px`.
- Desktop UMKM dua kolom image/content; mobile satu kolom.
- Open state memakai `.open` dan transform `translateY(0) scale(1)`.
- Close melalui tombol dan click overlay.

## 4.5 Tabs

```blade
<div class="tabs-nav" role="tablist">
  <button class="tab-btn active" onclick="openTab(event, 'panel-a')">Tab A</button>
  <button class="tab-btn" onclick="openTab(event, 'panel-b')">Tab B</button>
</div>

<section class="tab-pane active" id="panel-a">...</section>
<section class="tab-pane" id="panel-b">...</section>
```

- State aktif selalu memakai `.active`.
- Varian kesehatan: tab flat dengan green tint.
- Varian struktur: pill outline `border-radius:30px`; active hijau solid + shadow.
- Panel nonaktif `display:none`.

## 4.6 FAQ accordion

```blade
<div class="faq-item">
  <button class="faq-question" onclick="toggleFaq(this)">
    <span>Pertanyaan</span>
    <svg class="faq-icon-arrow"><!-- chevron --></svg>
  </button>
  <div class="faq-answer">
    <div class="faq-answer-inner">Jawaban...</div>
  </div>
</div>
```

- State menggunakan `.faq-item.expanded`.
- Arrow berputar `180deg`.
- Jawaban dianimasikan melalui `max-height` sekitar `0.25s`.
- Implementasi kesehatan menutup item lain ketika item baru dibuka.

## 4.7 Timeline

```blade
<div class="timeline">
  <article class="timeline-item">
    <div class="timeline-badge"></div>
    <div class="timeline-header">
      <h4 class="timeline-title">Tahap 1</h4>
      <span class="timeline-stage">± 270 Hari</span>
    </div>
    <p class="timeline-desc">...</p>
  </article>
</div>
```

Timeline kesehatan memakai garis vertikal, badge circle putih dengan border hijau, stage pill hijau, dan hover badge fill + scale.

## 4.8 Skeleton loading dan empty state

- UMKM: skeleton card mengikuti bentuk image `185px` + body lines.
- Komoditas: skeleton card tinggi `380px`.
- Shimmer memakai gradient `#f0f2f5 → #e5e7eb → #f0f2f5`.
- Empty state memakai icon/teks centered dan warna muted.

## 4.9 Toast dan loading spinner admin

- Toast fixed, background gelap, radius `10px`, state `.show` menghapus translate/opacity.
- Success hijau, error merah.
- Spinner dibuat dengan CSS border circle dan animasi rotate; tidak memakai library.

---

## 5. Inventaris Halaman dan Komponen Khusus

| View | Komponen/pola utama | Sumber style |
| :--- | :--- | :--- |
| `pages/home.blade.php` | Hero slider, category cards, profile summary, stat cards, CTA. | `style.css`. |
| `pages/profil-desa.blade.php` | History hero, dukuh pills, history boxes, wisdom grid, recipe warning box. | `style.css` + `pages.css` + internal CSS. |
| `pages/struktur-desa.blade.php` | Tabs Pemdes/BPD, org tree, avatar cards, connector lines, dynamic API data. | Global + `pages.css` + internal CSS. |
| `pages/potensi-desa.blade.php` | Agriculture feature card, crop badge, detail grid, price tags, photo gallery. | Global + `pages.css` + internal CSS. |
| `pages/peta-desa.blade.php` | Google Maps iframe card, geographic stat boxes. | Global + `pages.css` + internal CSS. |
| `pages/landasan-hukum.blade.php` | Legal intro, benefit cards, legal table, rights/duties panels, FAQ, aspiration form. | Global + `pages.css` + internal CSS. |
| `pages/kesehatan.blade.php` | Sticky/scroll quick-nav pills, section cards, risk grid, timeline, tabs, ABCDE cards, alert, FAQ, CTA. | Global + `pages.css` + internal CSS. |
| `pages/alat-pertanian.blade.php` | Green gradient hero, SOP section heading, numbered SOP card grid, info alert. | Global + `pages.css` + internal CSS. |
| `pages/keuangan.blade.php` | Finance cards, category badge, detail buttons, two large modals, Excel CTA, step lists. | Global + `pages.css` + internal CSS. |
| `pages/umkm.blade.php` | API-driven card grid, skeleton, detail modal, WhatsApp CTA. | Global + `pages.css` + internal CSS. |
| `pages/kebudayaan-kuliner.blade.php` | Content image/text blocks, highlight panels, Drive CTA. | Global + `pages.css` + internal CSS. |
| `pages/komoditas.blade.php` | API-driven image cards, image zoom, badge, skeleton. | Global + `pages.css` + internal CSS. |
| `pages/login.blade.php` | Standalone centered auth card, form, error alert, admin badge. | Internal CSS + `style.css`. |
| `pages/admin.blade.php` | Standalone fixed sidebar dashboard, forms, tables, badges, toast, upload state. | Internal CSS. |

### Halaman standalone

`login.blade.php` dan `admin.blade.php` tidak memakai `layouts.app`, navbar publik, atau footer publik.

#### Login shell

- Full viewport centered.
- Background `#f0f2f5`, padding `24px`.
- Card max-width `420px`, padding `44px 40px`, radius `20px`, shadow `0 8px 32px rgba(0,0,0,.08)`.
- Error panel merah tampil melalui `.error-msg.show`.

#### Admin shell

- Sidebar fixed `240px`, background `#111`, link active translucent white.
- Main area margin-left `240px`, padding `32px`.
- Card radius `14px`, form grid 2/3 kolom, data table, badge, toast.
- `≤768px`: sidebar menjadi relative full-width dan form menjadi satu kolom.

---

## 6. JavaScript UI Contract

## 6.1 `public/assets/js/main.js`

| Fitur | Hook | Behavior |
| :--- | :--- | :--- |
| Navbar scroll | `#main-navbar` | Toggle `.scrolled` setelah `10px`. |
| Mobile menu | `#hamburger-btn`, `#mobile-menu` | Toggle `.open`. |
| Dropdown | `.nav-dropdown` | Click open, sibling close, outside/Escape close. |
| Hero | `.slide`, `.dot`, arrow IDs | Autoplay `4500ms`, controls, hover pause, swipe. |
| Category navigation | `#categories-grid` | `scrollBy(±200px)`. |
| Stat counter | `.stat-number` | IntersectionObserver threshold `.3`, animation `1200ms`. |
| Active nav | `.nav-link` | Path matching terhadap `window.location.pathname`. |
| Reveal | card/copy selectors | Initial opacity 0 + translate `16px`; stagger `40ms`; duration `.4s`. |
| Auth label | `admin_token` di localStorage | Login link berubah menjadi logout saat token ada. |

## 6.2 Script per halaman

- **Kesehatan:** tabs, single-open FAQ, smooth anchor nav, active section berdasarkan scroll.
- **Struktur:** switch Pemdes/BPD dan fetch perangkat desa.
- **UMKM:** fetch data, render card, open/close modal, build WhatsApp URL.
- **Komoditas:** fetch data dan render cards/skeleton/error state.
- **Keuangan:** dua modal detail dan click-overlay close.
- **Landasan hukum:** FAQ dan word counter/form behavior.
- **Login:** submit ke API, loading/disabled state, error panel.
- **Admin:** sidebar tabs, CRUD forms/tables, upload progress, toast, spinner, auth checks.

## 6.3 API support

`api.service.js` bukan library visual. File ini menyediakan wrapper fetch same-origin `/api`, bearer token, JSON/FormData, dan redirect unauthorized. `firebase-config.js` ada di aset, tetapi tidak dimuat oleh UI aktif.

---

## 7. Asset dan Library UI

## 7.1 Library eksternal

| Library/resource | Status |
| :--- | :--- |
| Google Fonts — Inter | **Aktif** pada layout publik, login, dan admin. |
| Font Awesome | Tidak digunakan. |
| Bootstrap | Tidak digunakan. |
| Tailwind CSS | Tidak digunakan oleh route aplikasi aktif. Hanya terdapat compiled CSS pada scaffold `welcome.blade.php` yang tidak dirutekan. |
| Swiper / Slick / Owl Carousel | Tidak digunakan; carousel dibuat dengan Vanilla JS. |
| jQuery | Tidak digunakan. |
| Lucide / Heroicons | Tidak dimuat sebagai library. |

Integrasi eksternal non-library yang muncul pada konten: Google Maps embed, Google Drive/Sheets, WhatsApp deep link, FormSubmit, dan tautan referensi eksternal.

## 7.2 Strategi ikon

| Jenis | Lokasi/pola | Penggunaan |
| :--- | :--- | :--- |
| Raster PNG | `public/assets/icons/*.png` | 10 quick-access/category icons. |
| SVG file | `public/assets/images/boyolali-logo.svg` | Logo navbar/login. |
| Inline SVG | Di Blade (`<svg>`) | Arrow, house icon, section icon, action icon; audit menemukan banyak instance inline. |
| CSS-drawn | Border/shape | Dropdown chevron, spinner, connector/timeline line. |
| Emoji Unicode | Beberapa feature cards/tabs | Kesehatan, admin labels, dan konten informatif. |
| Icon font | Tidak ada | Tidak ada Font Awesome/Material Icons. |

## 7.3 Daftar aset UI publik

### Quick-access icons

```text
assets/icons/
├── profil-desa.png
├── struktur-desa.png
├── potensi-desa.png
├── peta-desa.png
├── umkm.png
├── kebudayaan-kuliner.png
├── komoditas.png
├── landasan-hukum.png
├── kesehatan.png
└── keuangan.png
```

### Brand dan photography

```text
assets/images/
├── boyolali-logo.svg
├── 1.jpeg ... 5.jpeg                  # hero slider
├── anak-anak penari ... .jpeg
├── penari Topeng Ireng ... .jpeg
├── sinden dan lakon ... .jpeg
├── gunungan hasil panen Desa.png
└── Jadah, Wajik, Lemper ... .png
```

---

## 8. Blueprint Implementasi Ulang

Jika desain dipindahkan ke proyek lain, struktur komponen yang direkomendasikan:

```text
AppShell
├── SiteHeader
│   ├── Brand
│   ├── DesktopNavigation
│   │   ├── NavItem
│   │   └── NavDropdown
│   ├── LoginAction
│   └── MobileMenu
├── PageContent
│   ├── HeroCarousel
│   ├── SectionHeader
│   ├── QuickAccessGrid
│   ├── PageHeader
│   ├── FeatureCardGrid
│   ├── StatsRow
│   ├── Tabs
│   ├── Accordion
│   ├── Timeline
│   ├── DataCardGrid
│   ├── Modal
│   └── Form
└── SiteFooter
```

### Minimal token port

```css
:root {
  --dm-primary: #0f172a;
  --dm-secondary: #334155;
  --dm-accent: #2d6a4f;
  --dm-accent-hover: #1b4332;
  --dm-bg: #fafafa;
  --dm-surface: #ffffff;
  --dm-surface-muted: #f1f5f9;
  --dm-text: #1e293b;
  --dm-text-muted: #475569;
  --dm-border: #e2e8f0;

  --dm-font: 'Inter', system-ui, sans-serif;
  --dm-radius-sm: 8px;
  --dm-radius-md: 12px;
  --dm-radius-lg: 16px;
  --dm-radius-xl: 24px;
  --dm-radius-full: 9999px;
  --dm-transition: 220ms ease;

  --dm-container: 1100px;
  --dm-gutter: 24px;
  --dm-navbar-height: 72px;
}
```

### Padanan utility bila dibangun dengan Tailwind

Codebase aktif tidak memakai utility Tailwind, tetapi pola utamanya dapat diterjemahkan sebagai:

```html
<!-- Standard card -->
<article class="rounded-xl border border-slate-200 bg-white p-6 transition
                hover:-translate-y-1 hover:border-[#2d6a4f] hover:shadow-lg">
  ...
</article>

<!-- Green pill CTA -->
<a class="inline-flex items-center gap-2 rounded-full bg-[#2d6a4f]
          px-7 py-3 text-sm font-semibold text-white
          transition hover:-translate-y-0.5 hover:bg-[#1b4332]">
  Selengkapnya
</a>

<!-- Section heading -->
<div class="flex items-center gap-2.5">
  <span class="h-7 w-[5px] rounded-full bg-[#2d6a4f]"></span>
  <h2 class="text-xl font-bold text-slate-900">Judul Section</h2>
</div>
```

---

## 9. Catatan UX dan Aksesibilitas dari Implementasi Saat Ini

Hal berikut penting jika blueprint dipakai untuk pembangunan ulang:

1. Banyak inline SVG dekoratif belum konsisten memakai `aria-hidden="true"`.
2. Dropdown button belum mendeklarasikan `aria-expanded`/`aria-controls` secara dinamis.
3. Hamburger belum mengubah state `aria-expanded` dan garisnya tidak dianimasikan menjadi close icon.
4. Modal memiliki visual dialog, tetapi focus trap, restore focus, dan close via Escape belum konsisten.
5. Tabs menggunakan class aktif dan inline `onclick`, tetapi belum lengkap dengan `role="tab"`, `aria-selected`, dan keyboard arrow navigation.
6. Reveal-on-scroll mengubah style inline tanpa pemeriksaan `prefers-reduced-motion`.
7. Hero autoplay tidak menyediakan tombol pause permanen; hanya pause on hover.
8. Beberapa icon hanya berupa emoji; rendering dapat berbeda antar-OS.
9. CSS page-specific di dalam Blade mempersulit reuse dan berpotensi menimpa class global.
10. Struktur visual konsisten, tetapi belum ada komponen Blade parameterized; banyak markup berulang ditulis langsung per halaman.

Untuk rebuild, pertahankan identitas visualnya tetapi tambahkan semantic roles, keyboard support, reduced-motion handling, focus-visible ring, dan namespace komponen.

---

## 10. Referensi Source Utama

| Domain | File sumber |
| :--- | :--- |
| Token/global styling | `backend/public/assets/css/style.css` |
| Inner-page shared styling | `backend/public/assets/css/pages.css` |
| Layout publik | `backend/resources/views/layouts/app.blade.php` |
| Navbar/dropdown/mobile | `backend/resources/views/partials/navbar.blade.php`, `partials/mobile-menu.blade.php` |
| Footer | `backend/resources/views/partials/footer.blade.php` |
| Hero/categories/profil summary | `backend/resources/views/pages/home.blade.php` |
| Interaksi global | `backend/public/assets/js/main.js` |
| Variasi feature | Seluruh `backend/resources/views/pages/*.blade.php` |
| Asset visual | `backend/public/assets/icons/`, `backend/public/assets/images/` |

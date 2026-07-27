# 🏡 Website Profil Desa Munggur

Website profil Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Aplikasi menyediakan halaman informasi desa, potensi pertanian, UMKM, struktur organisasi, peta, landasan hukum, kesehatan, keuangan, alat pertanian, serta kebudayaan dan kuliner lokal.

---

## 🧱 Deskripsi Arsitektur & Tech Stack

Proyek ini adalah **monolit Laravel dengan server-side rendering menggunakan Blade**, bukan aplikasi frontend dan backend yang dipisah ke container atau repository berbeda. Halaman web dan REST API berada dalam aplikasi yang sama di folder `backend/`.

Alur request pada Docker:

```text
Browser
  └── http://localhost:8000
        └── Nginx (container web, port 80)
              └── PHP-FPM (container app, port internal 9000)
                    ├── Laravel Blade: route halaman web
                    ├── Laravel API: route /api/*
                    └── MySQL 8.0: container db
```

| Bagian | Teknologi yang Digunakan |
| :--- | :--- |
| **Framework utama** | Laravel `12` (`12.63.0` pada `composer.lock`) |
| **Runtime PHP** | PHP `^8.2`; image Docker memakai PHP `8.3-fpm-alpine` |
| **Rendering halaman** | Laravel Blade di `backend/resources/views/` |
| **Frontend aktif** | HTML Blade, Vanilla CSS, dan Vanilla JavaScript dari `backend/public/assets/` |
| **API & autentikasi** | REST API Laravel dan Laravel Sanctum `4`; token Bearer disimpan di `localStorage` |
| **Database** | MySQL `8.0` pada Docker; `.env.example` memakai SQLite untuk setup native |
| **Web server Docker** | Nginx Alpine → PHP-FPM |
| **ORM & skema data** | Eloquent ORM, migration, dan seeder Laravel |
| **Tooling aset** | Vite `7`, Tailwind CSS `4`, Axios, dan Laravel Vite Plugin tersedia di manifest npm |
| **Pengujian** | PHPUnit `11` melalui `php artisan test` atau `composer test` |

> **Catatan frontend:** halaman aktif tidak menggunakan React, Vue, Inertia, Next.js, atau Nuxt. Layout utama memuat langsung `public/assets/css/*.css` dan `public/assets/js/*.js`. Vite/Tailwind telah dikonfigurasi untuk scaffold `resources/css/app.css` dan `resources/js/app.js`, tetapi layout halaman aktif tidak memanggil `@vite`, sehingga build npm tidak wajib untuk menjalankan tampilan saat ini.

> **Catatan Firebase:** file `public/assets/js/firebase-config.js` ada di repository, tetapi tidak dimuat oleh Blade atau JavaScript aktif. Penyimpanan data aplikasi saat ini menggunakan Laravel dan database SQL, bukan Firebase.

---

## 📂 Struktur Proyek

```text
.
├── README.md
├── deploy.sh                         # Deployment Docker otomatis untuk VPS
├── asetfoto/                         # Arsip/sumber foto di luar document root aplikasi
└── backend/                          # Root aplikasi Laravel
    ├── app/
    │   ├── Http/Controllers/         # Controller auth, UMKM, komoditas, perangkat, upload
    │   └── Models/                   # Model Eloquent
    ├── bootstrap/app.php             # Registrasi web route, API route, dan health check
    ├── config/                       # Konfigurasi Laravel, CORS, Sanctum, DB, storage
    ├── database/
    │   ├── migrations/               # Skema user, token, cache/job, UMKM, perangkat, komoditas
    │   └── seeders/DatabaseSeeder.php
    ├── docker/
    │   ├── Dockerfile                # PHP 8.3 FPM + extension + Composer
    │   └── nginx.conf                # Document root /var/www/public
    ├── public/assets/                # CSS, JavaScript, ikon, dan gambar yang dilayani langsung
    ├── resources/views/              # Layout, partial, dan halaman Blade
    ├── routes/
    │   ├── web.php                   # Route halaman
    │   └── api.php                   # Route REST API
    ├── tests/                        # PHPUnit unit dan feature test
    ├── .env.example
    ├── composer.json
    ├── docker-compose.yml
    ├── package.json
    └── vite.config.js
```

Folder `asetfoto/` di root bukan document root Nginx. Aset yang benar-benar dapat diakses browser berada di `backend/public/assets/`.

---

## 🧭 Routing & Fitur yang Tersedia

### Halaman Web

| Kelompok | Route |
| :--- | :--- |
| **Beranda** | `/` |
| **Profil & pemerintahan** | `/profil-desa`, `/struktur-desa`, `/landasan-hukum` |
| **Potensi desa** | `/potensi-desa`, `/komoditas`, `/umkm`, `/alat-pertanian` |
| **Informasi publik** | `/peta-desa`, `/kesehatan`, `/keuangan`, `/kebudayaan-kuliner` |
| **Administrator** | `/login`, `/admin` |
| **Health check** | `/up` |

Route lama `/login.html`, `/umkm.html`, dan `/admin.html` tetap tersedia sebagai redirect ke route tanpa ekstensi.

### REST API

Semua endpoint API memiliki prefix `/api`.

| Akses | Endpoint yang Tersedia |
| :--- | :--- |
| **Publik** | `POST /api/login` |
| **Publik** | `GET /api/komoditas` |
| **Publik** | `GET /api/umkm`, `GET /api/umkm/{id}` |
| **Publik** | `GET /api/perangkat-desa` |
| **Sanctum Bearer token** | `POST /api/logout`, `GET /api/check-token` |
| **Sanctum Bearer token** | `POST /api/umkm`, `PUT/DELETE /api/umkm/{id}` |
| **Sanctum Bearer token** | `POST /api/perangkat-desa` |
| **Sanctum Bearer token** | `POST /api/komoditas`, `PUT/DELETE /api/komoditas/{id}` |
| **Sanctum Bearer token** | `POST /api/upload` |

Upload menerima gambar `jpeg`, `png`, `jpg`, `gif`, atau `webp` dengan ukuran maksimum `2 MB`, lalu menyimpannya ke disk `public` Laravel.

> **Batas implementasi saat ini:** UI admin memuat bagian kebudayaan dan kuliner, tetapi `routes/api.php` belum memiliki endpoint, controller, model, atau migration untuk kedua data tersebut. Backend CRUD yang benar-benar tersedia adalah UMKM, perangkat desa, dan komoditas, ditambah upload gambar.

---

## ⚙️ Variabel Environment

File template berada di `backend/.env.example`. Variabel Laravel lain dapat memakai nilai bawaan template; nilai berikut yang paling penting untuk aplikasi ini:

| Variabel | Setup Native | Setup Docker | Keterangan |
| :--- | :--- | :--- | :--- |
| `APP_KEY` | Dibuat dengan `php artisan key:generate` | Dibuat di container `app` | Wajib untuk enkripsi Laravel |
| `APP_URL` | `http://localhost:8000` | `http://localhost:8000` | Dipakai untuk URL file hasil upload |
| `DB_CONNECTION` | `sqlite` | `mysql` | Driver database |
| `DB_HOST` | Tidak diperlukan | `db` | Nama service MySQL di jaringan Compose |
| `DB_PORT` | Tidak diperlukan | `3306` | Port MySQL di dalam jaringan Compose |
| `DB_DATABASE` | Default ke `database/database.sqlite` | `laravel_db` | Nama/path database |
| `DB_USERNAME` | Tidak diperlukan | `laravel_user` | User yang dibuat oleh Compose |
| `DB_PASSWORD` | Tidak diperlukan | Manual atau dibuat otomatis oleh `deploy.sh` | Password user aplikasi MySQL |
| `DB_ROOT_PASSWORD` | Tidak diperlukan | Dibuat otomatis oleh `deploy.sh` | Root password MySQL untuk inisialisasi dan readiness check |

`SESSION_DRIVER`, `CACHE_STORE`, dan `QUEUE_CONNECTION` bernilai `database` pada `.env.example`. Tabel yang diperlukan sudah disediakan oleh migration bawaan proyek.

---

## 💻 Setup Native Tanpa Docker

### Prasyarat

- PHP `8.2` atau lebih baru beserta extension yang dibutuhkan Laravel dan SQLite.
- Composer `2`.
- Node.js dan npm hanya diperlukan jika ingin menjalankan tooling Vite/Tailwind opsional.

### Instalasi

1. Masuk ke root aplikasi Laravel:

   ```powershell
   cd backend
   ```

2. Instal dependensi PHP dan buat file environment:

   ```powershell
   composer install
   Copy-Item .env.example .env
   ```

   Untuk Bash/Git Bash, gunakan `cp .env.example .env`.

3. Ubah nilai berikut di `.env`:

   ```env
   APP_URL=http://localhost:8000
   DB_CONNECTION=sqlite
   ```

4. Buat file database SQLite yang belum disertakan di repository:

   ```powershell
   New-Item -ItemType File -Path database/database.sqlite -Force
   ```

   Untuk Bash/Git Bash, gunakan `touch database/database.sqlite`.

5. Inisialisasi aplikasi, database, dan public storage:

   ```powershell
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   ```

6. Jalankan aplikasi pada port `8000`:

   ```powershell
   php artisan serve --host=localhost --port=8000
   ```

7. Buka [http://localhost:8000](http://localhost:8000).

Frontend menggunakan base path API same-origin `/api`. Karena itu, request otomatis mengikuti domain/IP, port, dan protokol HTTP/HTTPS dari URL yang sedang dibuka tanpa konfigurasi URL tambahan di JavaScript.

Untuk production, ubah `APP_URL` di `backend/.env` menjadi origin publik aplikasi, misalnya `https://desa.example.id`. Nilai ini tidak dipakai untuk menentukan endpoint API frontend, tetapi tetap penting agar Laravel menghasilkan URL file upload dan URL absolut lain dengan domain serta skema HTTPS yang benar.

---

## 🐳 Setup & Menjalankan Docker

Stack Docker terdiri dari tiga service:

| Service | Container | Fungsi |
| :--- | :--- | :--- |
| `web` | `kkn_laravel_web` | Nginx, pintu masuk HTTP publik |
| `app` | `kkn_laravel_app` | PHP 8.3 FPM dan Composer |
| `db` | `kkn_laravel_db` | MySQL 8.0 dengan volume persisten |

Image `app` tidak memasang Node.js/npm. Hal ini sesuai dengan kondisi halaman aktif karena CSS dan JavaScript runtime sudah tersedia di `backend/public/assets/`.

### Setup Pertama Kali

1. Dari root repository, masuk ke folder aplikasi dan salin environment:

   ```powershell
   cd backend
   Copy-Item .env.example .env
   ```

   Untuk Bash/Git Bash, gunakan `cp .env.example .env`.

2. Atur koneksi aplikasi di `backend/.env` agar sesuai dengan `docker-compose.yml`:

   ```env
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_password
   DB_ROOT_PASSWORD=root_password
   ```

3. Build dan jalankan seluruh service:

   ```powershell
   docker compose up -d --build
   ```

4. Instal dependensi PHP ke bind mount `backend/vendor`:

   ```powershell
   docker compose exec app composer install
   ```

5. Pastikan MySQL sudah menerima koneksi, lalu inisialisasi Laravel:

   ```powershell
   docker compose exec db sh -c 'MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysqladmin ping --host=127.0.0.1 --user=root --silent'
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate --seed
   docker compose exec app php artisan storage:link
   ```

   Jika perintah `mysqladmin ping` atau migration gagal saat MySQL masih melakukan inisialisasi pertama, tunggu beberapa detik lalu jalankan kembali perintah tersebut.

6. Periksa status service dan buka website:

   ```powershell
   docker compose ps
   ```

   Website tersedia di [http://localhost:8000](http://localhost:8000).

### Menjalankan Ulang & Mengelola Container

Jalankan semua command berikut dari folder `backend/`:

```powershell
# Membuat/menjalankan kembali service
docker compose up -d

# Melihat status dan log
docker compose ps
docker compose logs -f

# Menghentikan tanpa menghapus container
docker compose stop

# Menyalakan container yang pernah dihentikan
docker compose start

# Restart seluruh service
docker compose restart

# Menghapus container dan network; data MySQL tetap ada di named volume
docker compose down
```

Untuk mereset seluruh tabel dan menjalankan seeder kembali:

```powershell
docker compose exec app php artisan migrate:fresh --seed
```

> `migrate:fresh` menghapus seluruh tabel beserta data aplikasi. Gunakan hanya saat reset memang diinginkan. `docker compose down -v` juga menghapus volume database secara permanen.

---

## 🚀 Deployment Otomatis ke VPS

Script [`deploy.sh`](deploy.sh) di root repository menyediakan deployment production satu perintah. Script mendeteksi otomatis Docker Compose v2 (`docker compose`) atau v1 (`docker-compose`) dan selalu bekerja relatif terhadap lokasi repository, sehingga dapat dipanggil dari direktori mana pun.

### Prasyarat VPS

- Linux dengan Bash, Git, Docker Engine, serta Docker Compose v2 atau v1.
- Repository sudah di-clone dan branch deployment sudah di-checkout (bukan detached HEAD).
- User deployment memiliki akses ke Docker tanpa prompt interaktif, atau script dijalankan oleh user yang sesuai.
- DNS/reverse proxy/TLS domain publik diarahkan ke service web aplikasi pada port host `8000`.

### Deployment Pertama

Dari root repository di VPS:

```bash
DEPLOY_APP_URL=https://desa.example.id ./deploy.sh
```

Ganti `https://desa.example.id` dengan origin publik aplikasi. File `deploy.sh` sudah disimpan di Git dengan mode executable `100755`. Jika metode transfer/checkout tertentu menghilangkan mode Unix tersebut, pulihkan satu kali dengan `chmod +x deploy.sh`.

Deployment berikutnya cukup:

```bash
./deploy.sh
```

Script menjalankan alur berikut secara otomatis:

1. Mendeteksi branch aktif dan menjalankan `git pull --ff-only origin <branch-aktif>`.
2. Membuat `backend/.env` dari `.env.example` jika belum ada, mengaktifkan mode production/MySQL, dan membuat password database acak tanpa mencetak secret ke terminal.
3. Memvalidasi environment serta sintaks Docker Compose.
4. Menjalankan `up -d --build` dan polling `mysqladmin ping` sampai MySQL benar-benar siap.
5. Menjalankan `composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist`.
6. Membuat `APP_KEY` hanya jika masih kosong, lalu menjalankan `migrate --force` dan `storage:link --force`.
7. Mengatur group `www-data` dan permission `775` pada `storage/` serta `bootstrap/cache/`.
8. Membangun config, route, dan view cache Laravel, kemudian menampilkan status container.

Route web proyek saat ini menggunakan Closure. Jika versi Laravel menolak melakukan `route:cache` untuk route tersebut, script membersihkan route cache, menampilkan peringatan, dan tetap menyelesaikan deployment; config cache serta view cache tetap dibuat.

### Environment Production

Jika `backend/.env` sudah ada, script mempertahankan seluruh nilainya. Pastikan setidaknya konfigurasi berikut benar:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://desa.example.id

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=password-kuat
DB_ROOT_PASSWORD=root-password-kuat
```

`DEPLOY_APP_URL` bersifat opsional dan hanya memperbarui `APP_URL`; contoh:

```bash
DEPLOY_APP_URL=https://desa-baru.example.id ./deploy.sh
```

Data MySQL disimpan persisten dalam named volume Docker `db_data`. Seluruh service memakai `restart: unless-stopped`, sehingga container kembali berjalan setelah VPS reboot. Port MySQL host dibatasi ke `127.0.0.1:3306`; komunikasi Laravel ke MySQL tetap menggunakan jaringan internal Docker melalui host `db:3306`.

> Konfigurasi lama memakai volume bernama `kkn_dbdata` (nama aktual Compose biasanya `backend_kkn_dbdata`). Mengganti konfigurasi ke `db_data` membuat volume baru dan **tidak memindahkan data lama secara otomatis**. Backup serta restore database terlebih dahulu jika VPS sudah memiliki data pada volume lama.

> Script menjalankan migration tanpa seeder agar deployment ulang tidak mengubah data produksi. Jika database baru memerlukan data awal, tinjau isi `DatabaseSeeder` terlebih dahulu sebelum menjalankan `docker compose exec app php artisan db:seed --force` dari folder `backend/`.

---

## 📦 Tooling npm & Build Aset

Repository tidak menyertakan `package-lock.json`, sehingga gunakan `npm install`, bukan `npm ci`:

```powershell
cd backend
npm install

# Development server Vite (port default Vite: 5173)
npm run dev

# Build production ke public/build
npm run build
```

Command npm tersebut hanya memproses entry `resources/css/app.css` dan `resources/js/app.js`. Pada kondisi codebase saat ini, halaman utama tetap memuat aset statis dari `public/assets/`; hasil build Vite baru dipakai jika view aktif diubah untuk memanggil `@vite`.

Manifest Composer juga menyediakan command berikut untuk development native:

```powershell
# Menjalankan server Laravel, queue listener, Pail, dan Vite bersamaan
composer run dev

# Menjalankan test PHPUnit (database SQLite in-memory)
composer test
```

`composer run dev` memerlukan dependensi Composer dan npm yang sudah terinstal. Untuk menjalankan website saja, `php artisan serve --host=localhost --port=8000` sudah cukup.

---

## 🔑 Akun Akses Administrator

Akun berikut dibuat oleh `DatabaseSeeder` setelah menjalankan `php artisan migrate --seed` atau `php artisan db:seed`:

| Item | Nilai |
| :--- | :--- |
| **URL Login** | [http://localhost:8000/login](http://localhost:8000/login) |
| **URL Panel Admin** | [http://localhost:8000/admin](http://localhost:8000/admin) |
| **Email** | `desamunggur15@gmail.com` |
| **Password** | `password123` |

Login menghasilkan personal access token Laravel Sanctum. Route halaman `/admin` sendiri tidak memakai middleware server-side; perlindungan operasi data diterapkan pada endpoint API melalui middleware `auth:sanctum`, sementara JavaScript panel memeriksa token dan melakukan redirect ke halaman login.

---

## 🌐 Daftar Port & Akses Layanan

| Layanan | Port Host | Port Container/Proses | Akses | Status |
| :--- | :---: | :---: | :--- | :--- |
| **Website Blade + REST API** | `8000` | Nginx `80` | [http://localhost:8000](http://localhost:8000) | Aktif pada Docker |
| **REST API base URL** | `8000` | Nginx `80` | [http://localhost:8000/api](http://localhost:8000/api) | Aktif pada Docker/native |
| **Health check Laravel** | `8000` | Nginx `80` | [http://localhost:8000/up](http://localhost:8000/up) | Aktif |
| **MySQL** | `3306` (loopback only) | MySQL `3306` | `127.0.0.1:3306` | Aktif pada Docker |
| **PHP-FPM** | Tidak dipublikasikan | `9000` | Hanya service `web` → `app:9000` | Internal Docker |
| **Vite dev server** | `5173` (default) | Proses host | `http://localhost:5173` | Opsional saat `npm run dev` |
| **Frontend lama** | Tidak ada | Tidak ada | Port `3000` tidak tersedia | Service telah dinonaktifkan di Compose |

Tidak ada layanan frontend terpisah pada port `3000`. Baik halaman Blade maupun endpoint API diakses melalui port `8000`.

---

## ✅ Verifikasi Instalasi

Jalankan dari folder `backend/` setelah dependensi dan environment siap:

```powershell
# Melihat seluruh route web dan API
php artisan route:list

# Menjalankan test
php artisan test
```

Pada Docker, tambahkan prefix `docker compose exec app`, misalnya:

```powershell
docker compose exec app php artisan route:list
docker compose exec app php artisan test
```
# 🏡 Website Profil Desa Munggur

Website Resmi Profil Desa Munggur, Kecamatan Andong, Kabupaten Boyolali. Dikembangkan sebagai wadah penyebaran informasi desa, publikasi potensi komoditas pertanian, promosi UMKM warga, struktur organisasi desa, landasan hukum, transparansi keuangan, kesehatan, serta kebudayaan dan kuliner lokal.

---

## 📂 Struktur Proyek
Aplikasi ini menggunakan arsitektur **decoupled** (terpisah):
- **Frontend**: Berupa HTML, CSS (Vanilla CSS), dan Vanilla JavaScript yang dilayani oleh web server **Nginx** (Port `3000`).
- **Backend**: Berupa REST API menggunakan **Laravel** (Port `8000`) dan database **MySQL** (Port `3306`).

---

## 🐳 Panduan Setup & Menjalankan Docker

Pilih panduan di bawah ini yang sesuai dengan kondisi Docker di komputer Anda:

### 🆕 Skenario A: Jika Pertama Kali Setup (Belum Ada Container/Database)

Ikuti langkah-langkah di bawah ini untuk menginisialisasi seluruh sistem dari awal:

1. **Buka Terminal / Command Prompt / PowerShell** di direktori root project (`c:\aya\KKN`).
2. **Setup Environment File Backend**:
   - Salin file `.env.example` menjadi `.env` di dalam folder `backend/`:
     ```bash
     copy backend/.env.example backend/.env
     ```
   - Pastikan konfigurasi database di `backend/.env` sesuai dengan konfigurasi Docker Compose:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=db
     DB_PORT=3306
     DB_DATABASE=laravel_db
     DB_USERNAME=laravel_user
     DB_PASSWORD=laravel_password
     
     APP_URL=http://localhost:8000
     ```
3. **Build dan Jalankan Container Docker**:
   - Jalankan perintah di bawah ini untuk membuat image dan mengaktifkan container di background:
     ```bash
     docker-compose -f backend/docker-compose.yml up -d --build
     ```
4. **Instal dependensi Composer di Container Backend**:
   - Jalankan instalasi library PHP di dalam container:
     ```bash
     docker exec -it kkn_laravel_app composer install
     ```
5. **Generate Application Key**:
   - Buat key enkripsi unik untuk Laravel:
     ```bash
     docker exec -it kkn_laravel_app php artisan key:generate
     ```
6. **Hubungkan Storage Link**:
   - Hubungkan folder penyimpanan publik agar file foto yang diunggah dari Admin Panel dapat diakses oleh browser:
     ```bash
     docker exec -it kkn_laravel_app php artisan storage:link
     ```
7. **Jalankan Migrasi & Seeding Database**:
   - Buat skema tabel dan masukkan data awal (data admin & komoditas standar):
     ```bash
     docker exec -it kkn_laravel_app php artisan migrate:fresh --seed
     ```

---

### 🔄 Skenario B: Jika Sebelumnya Sudah Pernah Setup (Tinggal Menjalankan / Restart)

Gunakan perintah-perintah di bawah ini untuk mengelola container yang sudah ada:

- **Menjalankan Website (Start)**:
  ```bash
  docker-compose -f backend/docker-compose.yml start
  # Atau jika container mati / dibersihkan:
  docker-compose -f backend/docker-compose.yml up -d
  ```
- **Menghentikan Website (Stop)**:
  ```bash
  docker-compose -f backend/docker-compose.yml stop
  ```
- **Mematikan dan Menghapus Container (Down)**:
  ```bash
  docker-compose -f backend/docker-compose.yml down
  ```
- **Melihat Status Container yang Sedang Berjalan**:
  ```bash
  docker ps
  ```
- **Merestart Ulang Container**:
  ```bash
  docker-compose -f backend/docker-compose.yml restart
  ```

---

## 🔑 Akun Akses Administrator

Untuk masuk ke **Panel Admin** dan mengelola data desa (UMKM, Komoditas, Perangkat Desa, Kebudayaan, Kuliner):

- **URL Login**: [http://localhost:3000/pages/login](http://localhost:3000/pages/login)
- **Email**: `desamunggur15@gmail.com`
- **Password**: `password123`

---

## 🌐 Daftar Port & Akses Layanan

Setelah semua container aktif, layanan dapat diakses melalui alamat berikut:

| Layanan | Platform | URL Akses |
| :--- | :--- | :--- |
| **Frontend Web** | Nginx | [http://localhost:3000](http://localhost:3000) |
| **Backend REST API** | Laravel | [http://localhost:8000](http://localhost:8000) |
| **Database Server** | MySQL | `localhost:3306` |
# PoliklinikApp — Sistem Informasi Manajemen Poliklinik

**PoliklinikApp** merupakan aplikasi berbasis web yang dikembangkan untuk membantu pengelolaan operasional dan administrasi poliklinik secara terintegrasi.

Aplikasi ini menyediakan pengelolaan data pasien, dokter, pendaftaran kunjungan, pemeriksaan, resep obat, dan pembayaran dengan sistem hak akses berdasarkan peran pengguna.

## Fitur Utama

- **Dashboard** — Menampilkan ringkasan informasi operasional poliklinik.
- **Manajemen Pasien** — Mengelola data identitas dan informasi pasien.
- **Manajemen Dokter** — Mengelola data dokter, spesialisasi, tarif, dan informasi terkait.
- **Manajemen Poliklinik** — Mengelola data poliklinik.
- **Pendaftaran Pasien** — Mengelola proses pendaftaran dan kunjungan pasien.
- **Pemeriksaan** — Mendukung pencatatan keluhan, diagnosis, dan tindakan medis.
- **Resep Obat** — Mendukung pengelolaan resep obat.
- **Pembayaran** — Mengelola administrasi pembayaran pasien.
- **Manajemen Pengguna** — Mengatur akun pengguna berdasarkan peran dan hak akses.

## Hak Akses Pengguna

Aplikasi memiliki tiga jenis peran pengguna:

| Peran | Hak Akses |
|---|---|
| Operator | Mengelola administrasi dan data operasional poliklinik |
| Dokter | Mengakses data pasien dan melakukan pencatatan pemeriksaan |
| Manajemen | Mengakses bagian manajemen sistem |

## Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Bahasa pemrograman backend |
| Laravel 12 | Framework aplikasi |
| MySQL | Basis data |
| Bootstrap 5 | Framework antarmuka |
| JavaScript | Interaksi antarmuka |
| HTML5 & CSS3 | Struktur dan tampilan website |

## Persyaratan Sistem

- PHP 8.2 atau lebih baru
- Composer
- MySQL
- Node.js dan NPM
- Web browser

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/rizki12-cyber/PoliklinikApp.git
   ```

2. Masuk ke direktori project:

   ```bash
   cd PoliklinikApp
   ```

3. Install dependency:

   ```bash
   composer install
   npm install
   ```

4. Salin file konfigurasi:

   ```powershell
   Copy-Item .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Buat database MySQL, kemudian sesuaikan konfigurasi pada `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

8. Build asset frontend:

   ```bash
   npm run build
   ```

9. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

10. Akses aplikasi melalui:

   ```text
   http://127.0.0.1:8000
   ```

## Pengembang

**Rizki**

Project ini dikembangkan sebagai bagian dari pembelajaran dan pengembangan kemampuan dalam membangun sistem informasi manajemen berbasis web menggunakan Laravel dan MySQL.

## Lisensi

Project ini merupakan project pengembangan dan portofolio pribadi.
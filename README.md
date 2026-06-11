# Green House Fresh - E-Commerce Sayur & Sembako

Green House Fresh adalah aplikasi e-commerce modern berbasis web untuk penjualan sayuran segar dan sembako berkualitas. Proyek ini dibangun menggunakan framework Laravel dengan desain antarmuka premium, transisi halus, dan fitur manajemen pesanan yang lengkap untuk pelanggan dan administrator.

---

## 🚀 Fitur Utama

### 🛒 Sisi Pelanggan (User Area)
- **Beranda Publik**: Katalog produk interaktif dengan filter kategori (Sayuran, Sembako) dan pencarian produk.
- **Keranjang Belanja (Cart)**: Tambah, update kuantitas, dan hapus item belanjaan yang tersimpan dalam session.
- **Checkout Sistem**: Form checkout untuk mengisi alamat pengiriman, nomor telepon, memilih kurir pengiriman (Instant, Same Day, Regular, Pick Up), serta metode pembayaran (Transfer Bank, QRIS, COD).
- **Halaman Riwayat Pesanan**: Pelanggan dapat memantau status pesanan, melihat detail produk yang dibeli, serta melacak informasi kurir dan nomor resi pengiriman.
- **Unggah Bukti Pembayaran**: Upload bukti transfer bank atau QRIS langsung dari dasbor riwayat pesanan.

### 💼 Sisi Administrator (Admin Dashboard)
- **Multi-Guard Authentication**: Autentikasi terpisah antara User (Guard `web`) dan Admin (Guard `admin`).
- **Manajemen Produk**: CRUD produk lengkap dengan validasi gambar, harga, deskripsi, kategori, dan stok barang.
- **Pengelolaan Pesanan (Order Management)**:
  - Melihat daftar semua pesanan pelanggan beserta detail produk yang dibeli.
  - Memperbarui status pesanan secara langsung (Pending, Menunggu Verifikasi, Diproses, Dikemas, Dikirim, Selesai, Dibatalkan).
  - Integrasi input nama kurir dan nomor resi saat status diubah menjadi **Dikirim (Shipped)**.
- **Logika Pengurangan Stok**: Stok produk otomatis berkurang ketika pesanan diubah statusnya menjadi **Selesai (Completed)**.
- **Laporan Penjualan (Sales Report)**:
  - Filter transaksi berdasarkan rentang tanggal dan status transaksi.
  - Total ringkasan pendapatan dan jumlah transaksi yang terhitung secara dinamis.
  - Ekspor laporan penjualan ke format **Excel (CSV)**.
  - Cetak laporan langsung dan ekspor ke **PDF** secara dinamis.

---

## 🛠️ Spesifikasi Teknologi
- **Backend**: Laravel 12.x (PHP >= 8.2)
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Templating + Vanilla CSS (Aksentuasi hijau premium, font Poppins, responsive design)
- **Package Manager**: Composer & NPM
- **Bundler**: Vite
- **Containerization**: Docker & Docker Compose

---

## 💻 Panduan Instalasi Lokal

### Prasyarat
Pastikan komputer Anda sudah terinstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB Server (misal via XAMPP)

### Langkah-Langkah

1. **Clone / Ekstrak Proyek**
   Masuk ke direktori proyek di terminal Anda.

2. **Instal Dependensi PHP dan Node**
   ```bash
   composer install
   npm install
   ```

3. **Salin & Konfigurasi Environment**
   Salin berkas `.env.example` menjadi `.env`:
   ```bash
   copy .env.example .env
   ```
   Buka berkas `.env` dan sesuaikan pengaturan database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=greenhouse_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi & Database Seeder**
   Jalankan migrasi untuk membuat tabel beserta data awal (seeders):
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Hubungkan Storage Symlink**
   Agar file gambar bukti transfer dapat diakses dari browser, hubungkan folder storage:
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   Jalankan server Laravel dan bundler Vite di dua jendela terminal berbeda:
   ```bash
   # Terminal 1
   php artisan serve
   
   # Terminal 2
   npm run dev
   ```
   Akses aplikasi di browser pada alamat `http://127.0.0.1:8000`.

---

## 🔑 Akun Uji Coba (Default Credentials)

Setelah menjalankan seeder, Anda dapat masuk menggunakan akun berikut:

### Akun Pelanggan (User)
- **URL Login**: `http://127.0.0.1:8000/login`
- **Email**: `user@greenhouse.com`
- **Password**: `user123`

### Akun Administrator
- **URL Login**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@greenhouse.com`
- **Password**: `admin123`

---

## 🐳 Panduan Menjalankan dengan Docker

Proyek ini telah dilengkapi dengan konfigurasi Docker untuk mempermudah proses deployment dan standarisasi environment.

1. **Jalankan Docker Compose**
   Jalankan perintah berikut untuk membangun image dan menjalankan container:
   ```bash
   docker-compose up -d --build
   ```

2. **Akses Aplikasi**
   Aplikasi akan berjalan pada port `8000` di lokal Anda: `http://localhost:8000`.

3. **Setup Database di Container (Pertama Kali)**
   Masuk ke container aplikasi untuk menjalankan migrasi dan seed:
   ```bash
   docker-compose exec app php artisan migrate:fresh --seed
   docker-compose exec app php artisan storage:link
   ```

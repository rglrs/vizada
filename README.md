# Vizadaa - Sistem Informasi Percetakan

Project ini adalah aplikasi web berbasis Laravel untuk manajemen layanan percetakan, yang mencakup fitur pemesanan (order), manajemen produk, dan profil pengguna.

## 📋 Prasyarat (Requirements)

Pastikan komputer kamu sudah terinstall software berikut:
- **PHP** (Minimal versi 8.1 atau terbaru)
- **Composer**
- **Node.js & NPM**
- **MySQL** (via XAMPP, Laragon, atau install manual)
- **Git**

## 🚀 Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal (Localhost):

### 1. Clone Repositori
Download source code project ini dari GitHub:
```bash
git clone https://github.com/rglrs/vizada.git
cd vizada
```

### 2. Install Dependensi PHP

Download dan install semua library Laravel yang dibutuhkan:

```bash
composer install
```

### 3. Konfigurasi Environment

Duplikat file konfigurasi contoh menjadi file `.env` aktif:

```bash
cp .env.example .env
```

### 4. Generate Application Key

Buat kunci enkripsi aplikasi:

```bash
php artisan key:generate
```

### 5. Migrasi Database & Seeding

Jalankan migrasi untuk membuat tabel (termasuk tabel sessions, users, products, dll) dan mengisi data awal (seeder):

```bash
php artisan migrate --seed
```

### 6. Setup Frontend (Vite)

Install dependensi JavaScript dan compile aset CSS/JS (Tailwind):

```bash
npm install
npm run build
```

### 7. Buat Shortcut Storage

Agar file gambar produk yang diupload bisa diakses oleh publik:

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

Nyalakan server development Laravel:

```bash
php artisan serve
```
Buka browser dan akses alamat: http://localhost:8000

## 👤 Akun Login Default

Gunakan akun berikut untuk masuk sebagai **Administrator** (jika menggunakan `DatabaseSeeder` bawaan):

- **Email:** `admin@example.com`
- **Password:** `password`

*(Atau sesuaikan dengan data yang ada di `database/seeders/DatabaseSeeder.php`)*

## 🛠 Fitur Utama

- **Autentikasi:** Login, Register, Verifikasi Email, Reset Password.
- **Role Management:** Admin dan User.
- **Dashboard Admin:** Kelola Produk & Pesanan.
- **User Order:** User dapat membuat pesanan percetakan.
- **Manajemen Profil:** Update nama, email, dan password.
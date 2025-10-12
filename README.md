# Proyek Sistem Informasi Koperasi

Ini adalah proyek Sistem Informasi Koperasi yang dibangun menggunakan framework Laravel.

## Fitur Utama (Direncanakan)
- Manajemen Anggota
- Simpanan (Pokok, Wajib, Sukarela)
- Pengajuan dan Pengelolaan Pinjaman
- Pembayaran Angsuran
- Notifikasi
- Laporan Keuangan

---

## Panduan Instalasi dan Setup

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

**Prasyarat:**
- PHP >= 8.2
- Composer
- Database (MySQL)

**Langkah-langkah:**

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/altafnajillah/ppl-koperasi-project.git
    cd ppl-koperasi-project
    ```

2.  **Install Dependensi**
    Install semua dependensi PHP menggunakan Composer.
    ```bash
    composer install
    ```

3.  **Buat File Environment**
    Salin file `.env.example` menjadi `.env`. File ini akan berisi semua konfigurasi lingkungan Anda.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    Buat kunci enkripsi unik untuk aplikasi Anda.
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan database berikut dengan konfigurasi lokal Anda:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=password_anda
    ```
    Pastikan Anda sudah membuat database `nama_database_anda` di sistem manajemen database Anda.

6.  **Jalankan Migrasi dan Seeder**
    Perintah ini akan membuat semua tabel di database Anda dan mengisinya dengan data dummy yang relevan.
    ```bash
    php artisan migrate:fresh --seed
    ```
    * `migrate:fresh`: Menghapus semua tabel lama dan menjalankan migrasi dari awal.
    * `--seed`: Menjalankan seeder untuk mengisi data.

7.  **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

---

## Akun Default

Setelah menjalankan seeder, Anda dapat login menggunakan akun-akun berikut. Password default untuk semua akun adalah `password`.

-   **Admin:** `admin@koperasi.com`
-   **Petugas:** `petugas@koperasi.com`
-   **Anggota (Contoh):** `anggota@koperasi.com`

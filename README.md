# Sistem Manajemen Aset Laravel

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Status Build">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Unduhan">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Versi Stabil Terbaru">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="Lisensi">
    </a>
</p>

## Pengenalan

Selamat datang di Sistem Manajemen Aset Laravel! Proyek ini dirancang untuk membantu organisasi mengelola aset mereka dengan efisien. Dari melacak detail aset hingga menghasilkan laporan keuangan, sistem ini menyediakan solusi komprehensif untuk manajemen aset.

## Fitur

- **Manajemen Aset**: Tambah, edit, dan hapus aset dengan deskripsi dan gambar yang detail.
- **Pelacakan Lokasi**: Kelola dan tetapkan lokasi untuk aset.
- **Laporan Keuangan**: Hasilkan dan cetak laporan keuangan.
- **Generasi Kode QR**: Hasilkan kode QR untuk aset untuk pelacakan yang mudah.
- **Manajemen Pengguna**: Kontrol akses berbasis peran untuk berbagai jenis pengguna.
- **Notifikasi**: Notifikasi real-time untuk pembaruan status aset.

## Instalasi

1. **Klon repositori:**
    ```bash
    git clone https://github.com/yourusername/asset-management-system.git
    cd asset-management-system
    ```

2. **Instal dependensi:**
    ```bash
    composer install
    npm install
    ```

3. **Atur variabel lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Jalankan migrasi:**
    ```bash
    php artisan migrate
    ```

5. **Seed database (opsional):**
    ```bash
    php artisan db:seed
    ```

6. **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```

## Penggunaan

### Menambahkan Aset Baru

Untuk menambahkan aset baru, navigasikan ke halaman "Tambah Aset" dari dashboard. Isi detail yang diperlukan, termasuk nama aset, deskripsi, jumlah, dan lokasi. Anda juga dapat mengunggah gambar aset.

### Menghasilkan Laporan Keuangan

Untuk menghasilkan laporan keuangan, pergi ke bagian "Laporan Keuangan". Pilih rentang tanggal untuk laporan dan klik "Hasilkan". Anda dapat melihat laporan secara online atau mengunduhnya sebagai PDF.

### Generasi Kode QR

Setiap aset memiliki kode QR unik yang dapat dipindai untuk akses cepat ke detailnya. Kode QR dihasilkan secara otomatis saat Anda menambahkan aset baru.

## Struktur Kode

Proyek ini mengikuti struktur MVC standar Laravel. Berikut adalah beberapa file kunci dan tujuannya:

- **Controllers**: Menangani logika bisnis aplikasi.
    - `app/Http/Controllers/PengadaanController.php` (startLine: 41, endLine: 146)
    - `app/Http/Controllers/LaporanController.php` (startLine: 1, endLine: 113)

- **Views**: Template Blade untuk frontend.
    - `resources/views/pengadaan/create.blade.php` (startLine: 1, endLine: 92)
    - `resources/views/keuangan/index.blade.php` (startLine: 1, endLine: 66)

- **Migrations**: Definisi skema database.
    - `database/migrations/2023_03_24_214123_create_pengadaans_table.php` (startLine: 1, endLine: 34)
    - `database/migrations/2023_03_24_232021_create_statuspengadaans_table.php` (startLine: 1, endLine: 32)

## Kontribusi

Kami menyambut kontribusi dari komunitas! Jika Anda ingin berkontribusi, silakan fork repositori dan buat pull request dengan perubahan Anda. Pastikan untuk mengikuti standar pengkodean dan menyertakan tes untuk fitur baru.

## Lisensi

Proyek ini bersifat open-source dan dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.

## Penghargaan

- [Laravel](https://laravel.com) - Framework PHP untuk web artisan.
- [Bootstrap](https://getbootstrap.com) - Untuk komponen UI responsif.
- [SweetAlert](https://sweetalert2.github.io) - Untuk alert dan notifikasi yang indah.

---

Terima kasih telah menggunakan Sistem Manajemen Aset Laravel! Jika Anda memiliki pertanyaan atau masukan, jangan ragu untuk membuka issue di GitHub.
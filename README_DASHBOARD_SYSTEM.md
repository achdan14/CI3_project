# Sistem Dashboard User dan Admin

## Overview

Sistem ini membedakan antara dashboard user dan admin dengan fitur yang berbeda sesuai dengan peran masing-masing. Sistem menggunakan CodeIgniter 3 dengan arsitektur MVC yang terstruktur.

## Fitur Utama

### 🔐 Sistem Autentikasi
- Login/logout dengan validasi
- Middleware untuk kontrol akses
- Helper autentikasi yang dapat digunakan di seluruh aplikasi
- Sistem role (user/admin)

### 👤 Dashboard User
- **Dashboard Utama**: Statistik transaksi, produk terbaru, aktivitas user
- **Profil User**: Lihat dan edit informasi profil
- **Riwayat Transaksi**: Lihat transaksi yang telah dilakukan
- **Katalog Produk**: Lihat produk yang tersedia
- **Ganti Password**: Fitur keamanan dengan validasi password strength

### 👑 Dashboard Admin
- **Dashboard Admin**: Statistik sistem, transaksi terbaru, stok rendah
- **Manajemen User**: CRUD user, edit role, hapus user
- **Manajemen Produk**: CRUD produk, kategori, stok
- **Manajemen Transaksi**: Input transaksi, riwayat, laporan
- **Laporan**: Laporan penjualan harian/bulanan, export CSV

## Struktur File

### Controllers
```
application/controllers/
├── Dashboard.php          # Controller untuk user dashboard
├── Admin.php             # Controller untuk admin dashboard
├── Login.php             # Controller untuk autentikasi
└── Register.php          # Controller untuk registrasi
```

### Views
```
application/views/
├── user/                 # Views untuk user dashboard
│   ├── dashboard_view.php
│   ├── profile_view.php
│   ├── edit_profile_view.php
│   └── change_password_view.php
├── admin/                # Views untuk admin dashboard
│   ├── dashboard_view.php
│   ├── products_view.php
│   ├── users_view.php
│   └── transactions_view.php
└── auth/                 # Views untuk autentikasi
    ├── login_view.php
    └── register_view.php
```

### Models
```
application/models/
├── User_model.php        # Model untuk user management
├── Product_model.php     # Model untuk product management
└── Transaction_model.php # Model untuk transaction management
```

### Helpers
```
application/helpers/
└── auth_helper.php       # Helper untuk autentikasi dan kontrol akses
```

## Fitur Dashboard User

### 1. Dashboard Utama
- **Statistik Personal**: Total transaksi, transaksi bulan ini, total pengeluaran
- **Transaksi Terbaru**: Daftar 5 transaksi terakhir
- **Produk Terbaru**: Daftar 6 produk terbaru dengan stok
- **Navigasi Cepat**: Menu untuk akses cepat ke fitur lain

### 2. Profil User
- **Informasi Profil**: Username, email, nama lengkap, telepon, alamat
- **Status Akun**: Menampilkan status aktif dan tanggal bergabung
- **Aksi Profil**: Tombol untuk edit profil, ganti password, riwayat transaksi

### 3. Edit Profil
- **Form Edit**: Username, email, nama lengkap, telepon, alamat
- **Validasi**: Validasi form dengan pesan error yang jelas
- **Update Session**: Otomatis update session setelah edit profil

### 4. Ganti Password
- **Password Strength**: Indikator kekuatan password real-time
- **Toggle Password**: Tombol untuk show/hide password
- **Validasi**: Validasi password lama dan konfirmasi password baru
- **Persyaratan**: Panduan persyaratan password yang aman

## Fitur Dashboard Admin

### 1. Dashboard Admin
- **Statistik Sistem**: Total produk, transaksi, user, transaksi hari ini
- **Statistik Bulanan**: Total penjualan, transaksi, rata-rata transaksi
- **Transaksi Terbaru**: Daftar 5 transaksi terbaru
- **Stok Rendah**: Alert untuk produk dengan stok ≤ 5

### 2. Manajemen User
- **Daftar User**: Tabel dengan informasi lengkap user
- **Edit User**: Form untuk edit informasi dan role user
- **Hapus User**: Konfirmasi sebelum menghapus user
- **Role Management**: Ubah role user (user/admin)

### 3. Manajemen Produk
- **Daftar Produk**: Tabel dengan informasi produk lengkap
- **CRUD Produk**: Tambah, edit, hapus produk
- **Kategori**: Manajemen kategori produk
- **Stok Management**: Monitoring stok produk

### 4. Manajemen Transaksi
- **Input Transaksi**: Form untuk input transaksi baru
- **Riwayat Transaksi**: Daftar semua transaksi
- **Detail Transaksi**: View detail transaksi dengan items
- **Laporan**: Laporan penjualan dengan filter tanggal

## Helper Autentikasi

### Fungsi yang Tersedia
```php
// Cek status login
is_logged_in()

// Cek role admin
is_admin()

// Require login (redirect jika belum login)
require_login()

// Require admin (redirect jika bukan admin)
require_admin()

// Get user role
get_user_role()

// Get user data
get_user_data()
```

### Penggunaan di Controller
```php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('auth');
        
        // Cek login
        require_login();
        
        // Cek role (jika admin redirect ke admin dashboard)
        if (is_admin()) {
            redirect('admin');
        }
    }
}
```

## Sistem Role

### User (Role: 'user')
- Akses ke dashboard user
- Lihat profil dan edit
- Lihat riwayat transaksi sendiri
- Lihat katalog produk
- Ganti password

### Admin (Role: 'admin')
- Akses ke dashboard admin
- Manajemen user (CRUD)
- Manajemen produk (CRUD)
- Manajemen transaksi (CRUD)
- Laporan dan statistik
- Akses ke semua fitur sistem

## Keamanan

### 1. Middleware Autentikasi
- Setiap controller menggunakan helper auth
- Validasi session di setiap request
- Redirect otomatis untuk user yang belum login

### 2. Kontrol Akses
- Admin tidak bisa akses dashboard user
- User tidak bisa akses dashboard admin
- Validasi role di setiap halaman admin

### 3. Validasi Form
- Server-side validation dengan CodeIgniter
- Client-side validation dengan JavaScript
- Sanitasi input untuk mencegah XSS

### 4. Password Security
- Password hashing dengan bcrypt
- Password strength indicator
- Validasi password lama sebelum ganti

## Responsive Design

### Desktop
- Layout grid dengan sidebar
- Statistik cards yang informatif
- Tabel data yang lengkap

### Mobile
- Responsive navigation
- Stack layout untuk mobile
- Touch-friendly buttons

## Teknologi yang Digunakan

- **Backend**: CodeIgniter 3
- **Frontend**: HTML5, CSS3, JavaScript
- **Icons**: Font Awesome 6
- **Styling**: Custom CSS dengan gradient dan shadows
- **Database**: MySQL

## Cara Penggunaan

### 1. Setup Database
```sql
-- Pastikan tabel users memiliki kolom role
ALTER TABLE users ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user';
```

### 2. Load Helper
```php
// Di autoload.php atau di controller
$this->load->helper('auth');
```

### 3. Implementasi di Controller
```php
// Untuk user dashboard
require_login();
if (is_admin()) {
    redirect('admin');
}

// Untuk admin dashboard
require_admin();
```

### 4. Akses Dashboard
- **User Dashboard**: `http://localhost/project/dashboard`
- **Admin Dashboard**: `http://localhost/project/admin`

## Keunggulan Sistem

1. **Separation of Concerns**: Pemisahan yang jelas antara user dan admin
2. **Security First**: Middleware autentikasi di setiap level
3. **User Experience**: Interface yang modern dan intuitif
4. **Scalable**: Mudah untuk menambah fitur baru
5. **Maintainable**: Kode yang terstruktur dan dokumentasi lengkap
6. **Responsive**: Bekerja dengan baik di desktop dan mobile

## Maintenance

### Update Helper
Jika perlu menambah fungsi helper baru, edit file `application/helpers/auth_helper.php`

### Update Role
Untuk menambah role baru, update enum di database dan tambahkan validasi di helper

### Backup Data
Regular backup untuk data user, produk, dan transaksi

## Troubleshooting

### Common Issues
1. **Session Error**: Pastikan session library sudah di-load
2. **Database Error**: Cek koneksi database dan struktur tabel
3. **Permission Error**: Pastikan folder writable untuk session

### Debug Mode
Aktifkan debug mode di `application/config/config.php` untuk development

## Future Enhancement

1. **Multi-language Support**: Support untuk bahasa lain
2. **API Integration**: REST API untuk mobile app
3. **Advanced Reporting**: Chart dan grafik yang lebih detail
4. **Email Notifications**: Notifikasi email untuk user
5. **File Upload**: Upload gambar untuk produk
6. **Search & Filter**: Advanced search dan filter
7. **Export Features**: Export ke Excel, PDF
8. **Audit Trail**: Log aktivitas user dan admin 
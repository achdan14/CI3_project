# Setup Database untuk Sistem Registrasi

## Cara Setup Database

### Opsi 1: Menggunakan Script Otomatis (Direkomendasikan)

1. **Pastikan MySQL/XAMPP/Laragon sudah berjalan**
2. **Jalankan script setup:**
   ```bash
   php setup_database.php
   ```

### Opsi 2: Manual Setup

1. **Buka phpMyAdmin atau MySQL client**
2. **Buat database baru:**
   ```sql
   CREATE DATABASE ci3_registration;
   USE ci3_registration;
   ```

3. **Jalankan SQL dari file `database.sql`**

### Opsi 3: Menggunakan Command Line

```bash
mysql -u root -p < database.sql
```

## Struktur Database

### Tabel `users`
- `id` - Primary key auto increment
- `username` - Username unik (max 50 karakter)
- `email` - Email unik (max 100 karakter)
- `password` - Password terenkripsi (max 255 karakter)
- `created_at` - Timestamp pembuatan
- `updated_at` - Timestamp update

### Tabel `ci_sessions` (Opsional)
- Untuk menyimpan session di database
- Digunakan jika menggunakan database session

## Konfigurasi Database

File `application/config/database.php` sudah dikonfigurasi dengan:
- Host: localhost
- Username: root
- Password: (kosong)
- Database: ci3_registration

**Jika menggunakan kredensial berbeda, edit file tersebut.**

## Testing Database

Setelah setup selesai, Anda bisa test dengan:
1. Akses `http://localhost/ci3_project/register`
2. Isi form registrasi
3. Submit dan cek apakah data masuk ke database

## Troubleshooting

### Error: "Access denied for user"
- Pastikan username dan password MySQL benar
- Edit file `application/config/database.php`

### Error: "Database doesn't exist"
- Jalankan script `setup_database.php`
- Atau buat database manual

### Error: "Table doesn't exist"
- Pastikan tabel `users` sudah dibuat
- Jalankan ulang script setup

## Keamanan

- Ganti password default MySQL
- Gunakan user MySQL khusus untuk aplikasi
- Backup database secara berkala 
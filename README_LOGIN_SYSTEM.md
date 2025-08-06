# Sistem Login dan Registrasi CodeIgniter 3

## Fitur yang Tersedia

### ✅ Registrasi User
- Form registrasi dengan validasi
- Username dan email unik
- Password encryption dengan `password_hash()`
- Validasi form dengan CodeIgniter Form Validation

### ✅ Login System
- Form login dengan username dan password
- Session management
- Redirect ke dashboard setelah login berhasil
- Flash message untuk error login

### ✅ Dashboard
- Halaman dashboard setelah login
- Menampilkan informasi user
- Menu navigasi
- Logout functionality

### ✅ Database
- Tabel `users` untuk menyimpan data user
- Tabel `ci_sessions` untuk session management
- Data contoh untuk testing

## Cara Setup

### 1. Setup Database
```bash
php setup_database.php
```

### 2. Konfigurasi Database
File `application/config/database.php` sudah dikonfigurasi:
- Host: localhost
- Username: root
- Password: (kosong)
- Database: ci3_registration

### 3. Akses Aplikasi
- **Login:** `http://localhost/ci3_project/login`
- **Register:** `http://localhost/ci3_project/register`
- **Dashboard:** `http://localhost/ci3_project/dashboard`

## Data Login Contoh

Setelah menjalankan `setup_database.php`, Anda bisa login dengan:

| Username | Password |
|----------|----------|
| admin    | admin123 |
| user1    | user123  |
| test     | test123  |

## Struktur File

### Controllers
- `Register.php` - Controller untuk registrasi
- `Login.php` - Controller untuk login/logout
- `Dashboard.php` - Controller untuk dashboard

### Models
- `User_model.php` - Model untuk operasi database user

### Views
- `register_view.php` - Form registrasi
- `login_view.php` - Form login
- `dashboard_view.php` - Halaman dashboard

### Database
- `database.sql` - File SQL untuk setup database
- `setup_database.php` - Script otomatis setup database

## Fitur Keamanan

### ✅ Password Security
- Password di-hash menggunakan `password_hash()`
- Verifikasi password dengan `password_verify()`

### ✅ Session Management
- Session data tersimpan di database
- Auto logout jika session expired
- Session validation di setiap halaman

### ✅ Input Validation
- Form validation dengan CodeIgniter
- XSS protection dengan `htmlspecialchars()`
- SQL injection protection dengan Query Builder

### ✅ CSRF Protection
- CodeIgniter built-in CSRF protection
- Form token validation

## Alur Aplikasi

### 1. Registrasi
```
User → Register Form → Validation → Database → Success Message
```

### 2. Login
```
User → Login Form → Authentication → Session → Dashboard
```

### 3. Dashboard
```
Authenticated User → Dashboard → User Info → Navigation
```

## Troubleshooting

### Error: "Database connection failed"
- Pastikan MySQL server berjalan
- Cek konfigurasi database di `application/config/database.php`

### Error: "Table doesn't exist"
- Jalankan `php setup_database.php`
- Atau import manual dari `database.sql`

### Error: "Session not working"
- Pastikan tabel `ci_sessions` sudah dibuat
- Cek session configuration di `application/config/config.php`

### Error: "Login failed"
- Pastikan username dan password benar
- Cek apakah user sudah terdaftar di database

## Customization

### Menambah Field User
1. Edit tabel `users` di database
2. Update `User_model.php`
3. Update form registrasi di `register_view.php`
4. Update dashboard di `dashboard_view.php`

### Menambah Role/Admin
1. Tambah kolom `role` di tabel `users`
2. Update authentication logic di `Login.php`
3. Tambah role checking di `Dashboard.php`

### Styling
- Edit CSS di masing-masing view file
- Atau buat file CSS terpisah dan include

## Best Practices

### ✅ Security
- Selalu gunakan `password_hash()` untuk password
- Validasi input di server side
- Gunakan HTTPS di production
- Regular backup database

### ✅ Code Quality
- Gunakan PHPDoc untuk dokumentasi
- Follow CodeIgniter naming conventions
- Separate business logic dari presentation

### ✅ User Experience
- Clear error messages
- Responsive design
- Loading indicators
- Form validation feedback

## Testing

### Manual Testing
1. **Registrasi:** Coba register user baru
2. **Login:** Test login dengan user yang sudah ada
3. **Logout:** Test logout dan redirect
4. **Session:** Test session timeout

### Database Testing
```sql
-- Cek user yang terdaftar
SELECT * FROM users;

-- Cek session aktif
SELECT * FROM ci_sessions;
```

## Deployment

### Production Checklist
- [ ] Ganti password default MySQL
- [ ] Set `ENVIRONMENT = 'production'` di `index.php`
- [ ] Disable error reporting
- [ ] Setup HTTPS
- [ ] Configure backup strategy
- [ ] Set proper file permissions

### Performance
- Enable database query caching
- Optimize database indexes
- Use CDN for static assets
- Enable PHP OPcache 
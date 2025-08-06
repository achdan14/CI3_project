<?php
/**
 * Script untuk testing URL sistem login dan registrasi
 * Jalankan file ini untuk mengecek apakah URL bisa diakses
 */

echo "🔍 Testing URL Sistem Login dan Registrasi\n";
echo "==========================================\n\n";

// Base URL
$base_url = 'http://localhost/ci3_project/';

// Daftar URL yang akan di-test
$urls_to_test = [
    'Login Page' => $base_url . 'login',
    'Register Page' => $base_url . 'register',
    'Dashboard Page' => $base_url . 'dashboard',
    'Index (Default)' => $base_url . 'index.php',
    'Direct Controller' => $base_url . 'index.php/login',
    'Direct Register' => $base_url . 'index.php/register'
];

echo "📋 URL yang akan di-test:\n";
foreach ($urls_to_test as $name => $url) {
    echo "   $name: $url\n";
}

echo "\n🌐 Cara mengakses aplikasi:\n";
echo "1. Pastikan web server (Apache/Nginx) berjalan di Laragon\n";
echo "2. Akses salah satu URL berikut di browser:\n\n";

echo "   📝 REGISTRASI:\n";
echo "   http://localhost/ci3_project/register\n";
echo "   http://localhost/ci3_project/index.php/register\n\n";

echo "   🔐 LOGIN:\n";
echo "   http://localhost/ci3_project/login\n";
echo "   http://localhost/ci3_project/index.php/login\n\n";

echo "   🏠 DASHBOARD:\n";
echo "   http://localhost/ci3_project/dashboard\n";
echo "   http://localhost/ci3_project/index.php/dashboard\n\n";

echo "📋 Data Login Contoh:\n";
echo "   Username: admin, Password: admin123\n";
echo "   Username: user1, Password: user123\n";
echo "   Username: test, Password: test123\n\n";

echo "🔧 Jika masih error 'Not Found':\n";
echo "1. Coba akses dengan index.php: http://localhost/ci3_project/index.php/login\n";
echo "2. Pastikan Laragon Apache berjalan\n";
echo "3. Pastikan folder ci3_project ada di C:/laragon/www/\n";
echo "4. Restart Apache di Laragon\n";

?>
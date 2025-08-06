<?php
/**
 * Diagnostic Script untuk troubleshooting sistem
 * Jalankan file ini untuk mengecek konfigurasi dan memberikan solusi
 */

echo "🔍 DIAGNOSTIC SISTEM LOGIN DAN REGISTRASI\n";
echo "=========================================\n\n";

// Check 1: Web Server
echo "1. 🌐 Checking Web Server...\n";
if (isset($_SERVER['HTTP_HOST'])) {
    echo "   ✅ Web server aktif: " . $_SERVER['HTTP_HOST'] . "\n";
    echo "   ✅ Document root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
} else {
    echo "   ⚠️  Script dijalankan via CLI, bukan web server\n";
}

// Check 2: File Structure
echo "\n2. 📁 Checking File Structure...\n";
$required_files = [
    'index.php',
    'application/config/config.php',
    'application/config/routes.php',
    'application/config/database.php',
    'application/controllers/Login.php',
    'application/controllers/Register.php',
    'application/controllers/Dashboard.php',
    'application/models/User_model.php',
    'application/views/login_view.php',
    'application/views/register_view.php',
    'application/views/dashboard_view.php',
    '.htaccess'
];

$missing_files = [];
foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "   ✅ $file\n";
    } else {
        echo "   ❌ $file (MISSING)\n";
        $missing_files[] = $file;
    }
}

// Check 3: Configuration
echo "\n3. ⚙️  Checking Configuration...\n";

// Check base URL
$config_content = file_get_contents('application/config/config.php');
if (strpos($config_content, "base_url'] = 'http://localhost/ci3_project/'") !== false) {
    echo "   ✅ Base URL configured correctly\n";
} else {
    echo "   ❌ Base URL not configured properly\n";
}

// Check routes
$routes_content = file_get_contents('application/config/routes.php');
if (strpos($routes_content, "route['login']") !== false) {
    echo "   ✅ Custom routes configured\n";
} else {
    echo "   ❌ Custom routes not configured\n";
}

// Check 4: Database
echo "\n4. 🗄️  Checking Database...\n";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ci3_registration", "root", "");
    echo "   ✅ Database connection: SUCCESS\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    echo "   ✅ Users table exists with $count records\n";
    
} catch(PDOException $e) {
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
}

// Solutions
echo "\n🔧 SOLUSI UNTUK ERROR 'NOT FOUND':\n";
echo "==================================\n\n";

echo "📋 LANGKAH-LANGKAH TROUBLESHOOTING:\n\n";

echo "1. 🚀 START LARAGON:\n";
echo "   - Buka Laragon\n";
echo "   - Klik 'Start All'\n";
echo "   - Pastikan Apache dan MySQL berjalan (hijau)\n\n";

echo "2. 🌐 AKSES DENGAN URL LENGKAP:\n";
echo "   Jika error 'Not Found', coba URL ini:\n";
echo "   📝 Register: http://localhost/ci3_project/index.php/register\n";
echo "   🔐 Login:    http://localhost/ci3_project/index.php/login\n";
echo "   🏠 Dashboard: http://localhost/ci3_project/index.php/dashboard\n\n";

echo "3. 📁 LOKASI FILE:\n";
echo "   Pastikan folder ada di: C:/laragon/www/ci3_project/\n";
echo "   Current directory: " . __DIR__ . "\n\n";

echo "4. 🔄 RESTART SERVICES:\n";
echo "   - Di Laragon, klik 'Stop All'\n";
echo "   - Tunggu beberapa detik\n";
echo "   - Klik 'Start All' lagi\n\n";

echo "5. 🧹 CLEAR CACHE:\n";
echo "   - Refresh browser (Ctrl+F5)\n";
echo "   - Clear browser cache\n";
echo "   - Coba browser lain\n\n";

if (!empty($missing_files)) {
    echo "⚠️  MISSING FILES DETECTED:\n";
    foreach ($missing_files as $file) {
        echo "   - $file\n";
    }
    echo "   Jalankan ulang setup atau download file yang hilang.\n\n";
}

echo "📞 JIKA MASIH ERROR:\n";
echo "   1. Pastikan port 80 tidak digunakan aplikasi lain\n";
echo "   2. Coba ganti port di Laragon (klik menu -> Apache -> Port)\n";
echo "   3. Restart komputer jika perlu\n";
echo "   4. Coba akses: http://localhost:80/ci3_project/index.php/login\n\n";

echo "🎯 QUICK TEST:\n";
echo "   Akses: http://localhost/\n";
echo "   Jika muncul halaman Laragon, berarti web server berjalan.\n";
echo "   Lalu coba: http://localhost/ci3_project/index.php\n\n";

echo "✅ URL YANG HARUS DICOBA (URUT PRIORITAS):\n";
echo "   1. http://localhost/ci3_project/index.php/login\n";
echo "   2. http://localhost/ci3_project/login\n";
echo "   3. http://127.0.0.1/ci3_project/index.php/login\n";
echo "   4. http://localhost:80/ci3_project/index.php/login\n\n";

?>
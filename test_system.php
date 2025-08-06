<?php
/**
 * Test Script untuk Sistem Login dan Registrasi
 * Jalankan file ini untuk mengecek apakah semua komponen berfungsi
 */

echo "🔍 Testing Sistem Login dan Registrasi CodeIgniter 3\n";
echo "==================================================\n\n";

// Test 1: Cek koneksi database
echo "1. Testing Koneksi Database...\n";
try {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ci3_registration';
    
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Database connection: SUCCESS\n";
    
    // Test 2: Cek tabel users
    echo "2. Testing Tabel Users...\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Tabel users: EXISTS\n";
    } else {
        echo "❌ Tabel users: NOT FOUND\n";
    }
    
    // Test 3: Cek data user
    echo "3. Testing Data User...\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $user_count = $stmt->fetchColumn();
    echo "✅ Jumlah user: $user_count\n";
    
    // Test 4: Cek struktur tabel
    echo "4. Testing Struktur Tabel...\n";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $required_columns = ['id', 'username', 'email', 'password', 'created_at', 'updated_at'];
    
    $missing_columns = array_diff($required_columns, $columns);
    if (empty($missing_columns)) {
        echo "✅ Struktur tabel: COMPLETE\n";
    } else {
        echo "❌ Missing columns: " . implode(', ', $missing_columns) . "\n";
    }
    
    // Test 5: Cek file yang diperlukan
    echo "5. Testing File System...\n";
    $required_files = [
        'application/controllers/Register.php',
        'application/controllers/Login.php',
        'application/controllers/Dashboard.php',
        'application/models/User_model.php',
        'application/views/register_view.php',
        'application/views/login_view.php',
        'application/views/dashboard_view.php',
        'application/config/database.php',
        'application/config/autoload.php'
    ];
    
    $missing_files = [];
    foreach ($required_files as $file) {
        if (!file_exists($file)) {
            $missing_files[] = $file;
        }
    }
    
    if (empty($missing_files)) {
        echo "✅ Semua file: EXISTS\n";
    } else {
        echo "❌ Missing files:\n";
        foreach ($missing_files as $file) {
            echo "   - $file\n";
        }
    }
    
    // Test 6: Cek konfigurasi autoload
    echo "6. Testing Autoload Configuration...\n";
    $autoload_content = file_get_contents('application/config/autoload.php');
    $required_libraries = ['database', 'form_validation', 'session'];
    $required_helpers = ['url', 'form', 'security'];
    
    $missing_libraries = [];
    $missing_helpers = [];
    
    foreach ($required_libraries as $lib) {
        if (strpos($autoload_content, "'$lib'") === false) {
            $missing_libraries[] = $lib;
        }
    }
    
    foreach ($required_helpers as $helper) {
        if (strpos($autoload_content, "'$helper'") === false) {
            $missing_helpers[] = $helper;
        }
    }
    
    if (empty($missing_libraries) && empty($missing_helpers)) {
        echo "✅ Autoload configuration: CORRECT\n";
    } else {
        if (!empty($missing_libraries)) {
            echo "❌ Missing libraries: " . implode(', ', $missing_libraries) . "\n";
        }
        if (!empty($missing_helpers)) {
            echo "❌ Missing helpers: " . implode(', ', $missing_helpers) . "\n";
        }
    }
    
    echo "\n🎉 Testing selesai!\n";
    echo "\n📋 Langkah selanjutnya:\n";
    echo "1. Akses http://localhost/ci3_project/register untuk registrasi\n";
    echo "2. Akses http://localhost/ci3_project/login untuk login\n";
    echo "3. Gunakan data login contoh yang sudah dibuat\n";
    
} catch(PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "Pastikan MySQL server berjalan dan database sudah dibuat.\n";
    echo "Jalankan: php setup_database.php\n";
}
?> 
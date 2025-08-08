<?php
/**
 * Test Script untuk Sistem Role Admin/User
 * Jalankan file ini untuk mengecek apakah sistem role berfungsi dengan baik
 */

echo "🔍 Testing Sistem Role Admin/User\n";
echo "================================\n\n";

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
    
    // Test 2: Cek kolom role
    echo "2. Testing Kolom Role...\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Kolom role: EXISTS\n";
    } else {
        echo "❌ Kolom role: NOT FOUND\n";
    }
    
    // Test 3: Cek data user dengan role
    echo "3. Testing Data User dengan Role...\n";
    $stmt = $pdo->query("SELECT username, role FROM users ORDER BY id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        $role_icon = $user['role'] == 'admin' ? '👑' : '👤';
        echo "   $role_icon {$user['username']} - Role: {$user['role']}\n";
    }
    
    // Test 4: Cek jumlah admin dan user
    echo "4. Testing Distribusi Role...\n";
    $stmt = $pdo->query("SELECT role, COUNT(*) as count FROM users GROUP BY role");
    $role_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($role_stats as $stat) {
        echo "   Role {$stat['role']}: {$stat['count']} user\n";
    }
    
    // Test 5: Cek file yang diperlukan
    echo "5. Testing File System...\n";
    $required_files = [
        'application/controllers/Dashboard.php',
        'application/controllers/Admin.php',
        'application/views/dashboard_view.php',
        'application/views/admin/dashboard_view.php',
        'application/views/edit_profile_view.php',
        'application/views/change_password_view.php',
        'application/models/User_model.php'
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
    
    echo "\n🎉 Testing selesai!\n";
    echo "\n📋 Cara Testing Manual:\n";
    echo "1. Login sebagai admin (admin/admin123) → Redirect ke /admin\n";
    echo "2. Login sebagai user (user1/user123) → Redirect ke /dashboard\n";
    echo "3. Coba akses /admin dengan user biasa → Redirect ke /dashboard\n";
    echo "4. Coba akses /dashboard dengan admin → Redirect ke /admin\n";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 
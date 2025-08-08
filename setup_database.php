<?php
/**
 * Script untuk setup database secara otomatis
 * Jalankan file ini sekali untuk membuat database dan tabel
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ci3_registration';

try {
    // Koneksi ke MySQL tanpa memilih database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Berhasil terhubung ke MySQL\n";
    
    // Buat database jika belum ada
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    $pdo->exec($sql);
    echo "✅ Database '$database' berhasil dibuat\n";
    
    // Pilih database
    $pdo->exec("USE $database");
    
    // Buat tabel users dengan kolom role
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✅ Tabel 'users' berhasil dibuat\n";
    
    // Cek apakah kolom role sudah ada, jika tidak tambahkan
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    if ($stmt->rowCount() == 0) {
        $sql = "ALTER TABLE users ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user' AFTER password";
        $pdo->exec($sql);
        echo "✅ Kolom 'role' berhasil ditambahkan\n";
    }
    
    // Buat tabel sessions (opsional)
    $sql = "CREATE TABLE IF NOT EXISTS ci_sessions (
        id varchar(128) NOT NULL,
        ip_address varchar(45) NOT NULL,
        timestamp int(10) unsigned DEFAULT 0 NOT NULL,
        data blob NOT NULL,
        PRIMARY KEY (id),
        KEY ci_sessions_timestamp (timestamp)
    )";
    $pdo->exec($sql);
    echo "✅ Tabel 'ci_sessions' berhasil dibuat\n";
    
    // Insert data contoh untuk testing
    $sample_users = [
        [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ],
        [
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => password_hash('user123', PASSWORD_DEFAULT),
            'role' => 'user'
        ],
        [
            'username' => 'test',
            'email' => 'test@example.com',
            'password' => password_hash('test123', PASSWORD_DEFAULT),
            'role' => 'user'
        ]
    ];
    
    // Cek apakah data sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $inserted_count = 0;
    
    foreach ($sample_users as $user) {
        $stmt->execute([$user['username']]);
        if ($stmt->fetchColumn() == 0) {
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt_insert = $pdo->prepare($sql);
            $stmt_insert->execute([$user['username'], $user['email'], $user['password'], $user['role']]);
            $inserted_count++;
        } else {
            // Update role jika user sudah ada
            $sql = "UPDATE users SET role = ? WHERE username = ?";
            $stmt_update = $pdo->prepare($sql);
            $stmt_update->execute([$user['role'], $user['username']]);
        }
    }
    
    if ($inserted_count > 0) {
        echo "✅ $inserted_count user contoh berhasil ditambahkan\n";
    } else {
        echo "ℹ️  User contoh sudah ada (role diupdate)\n";
    }
    
    echo "\n🎉 Setup database selesai!\n";
    echo "Sekarang Anda bisa menjalankan aplikasi dengan sistem role admin/user.\n";
    echo "\n📋 Data Login Contoh:\n";
    echo "Admin - Username: admin, Password: admin123\n";
    echo "User - Username: user1, Password: user123\n";
    echo "User - Username: test, Password: test123\n";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Pastikan MySQL server berjalan dan kredensial benar.\n";
}
?> 
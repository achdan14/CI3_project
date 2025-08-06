<?php
/**
 * Script untuk setup fitur admin: CRUD, Transaksi, dan Laporan
 * Jalankan file ini untuk menambah tabel dan data yang diperlukan
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ci3_registration';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔧 Setup Fitur Admin: CRUD, Transaksi, dan Laporan\n";
    echo "================================================\n\n";
    
    // 1. Update tabel users untuk menambah role
    echo "1. Update Tabel Users (menambah role)...\n";
    try {
        $pdo->exec("ALTER TABLE users ADD COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
        echo "✅ Kolom role berhasil ditambahkan\n";
    } catch(PDOException $e) {
        if (strpos($e->getMessage(), "Duplicate column name") !== false) {
            echo "ℹ️  Kolom role sudah ada\n";
        } else {
            throw $e;
        }
    }
    
    // Update user admin
    $pdo->exec("UPDATE users SET role = 'admin' WHERE username = 'admin'");
    echo "✅ User admin berhasil diupdate\n";
    
    // 2. Buat tabel categories
    echo "\n2. Membuat Tabel Categories...\n";
    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✅ Tabel categories berhasil dibuat\n";
    
    // 3. Buat tabel products
    echo "\n3. Membuat Tabel Products...\n";
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        stock INT DEFAULT 0,
        category_id INT,
        image VARCHAR(255),
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    )";
    $pdo->exec($sql);
    echo "✅ Tabel products berhasil dibuat\n";
    
    // 4. Buat tabel transactions
    echo "\n4. Membuat Tabel Transactions...\n";
    $sql = "CREATE TABLE IF NOT EXISTS transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        transaction_code VARCHAR(50) UNIQUE NOT NULL,
        customer_name VARCHAR(100) NOT NULL,
        customer_phone VARCHAR(20),
        customer_email VARCHAR(100),
        total_amount DECIMAL(10,2) NOT NULL,
        payment_method ENUM('cash', 'transfer', 'card') NOT NULL,
        payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
        notes TEXT,
        transaction_date DATE NOT NULL,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
    )";
    $pdo->exec($sql);
    echo "✅ Tabel transactions berhasil dibuat\n";
    
    // 5. Buat tabel transaction_items
    echo "\n5. Membuat Tabel Transaction Items...\n";
    $sql = "CREATE TABLE IF NOT EXISTS transaction_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        transaction_id INT NOT NULL,
        product_id INT NOT NULL,
        product_name VARCHAR(200) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "✅ Tabel transaction_items berhasil dibuat\n";
    
    // 6. Insert sample data
    echo "\n6. Menambahkan Data Contoh...\n";
    
    // Categories
    $categories = [
        ['name' => 'Elektronik', 'description' => 'Produk elektronik dan gadget'],
        ['name' => 'Fashion', 'description' => 'Pakaian dan aksesoris'],
        ['name' => 'Makanan', 'description' => 'Makanan dan minuman'],
        ['name' => 'Buku', 'description' => 'Buku dan alat tulis']
    ];
    
    foreach ($categories as $category) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE name = ?");
        $stmt->execute([$category['name']]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            $stmt->execute([$category['name'], $category['description']]);
        }
    }
    echo "✅ Categories berhasil ditambahkan\n";
    
    // Products
    $products = [
        ['name' => 'Laptop Gaming', 'description' => 'Laptop gaming high-end', 'price' => 15000000, 'stock' => 5, 'category_id' => 1],
        ['name' => 'Smartphone', 'description' => 'Smartphone terbaru', 'price' => 5000000, 'stock' => 10, 'category_id' => 1],
        ['name' => 'Kaos Polo', 'description' => 'Kaos polo premium', 'price' => 150000, 'stock' => 20, 'category_id' => 2],
        ['name' => 'Celana Jeans', 'description' => 'Celana jeans berkualitas', 'price' => 300000, 'stock' => 15, 'category_id' => 2],
        ['name' => 'Kopi Arabica', 'description' => 'Kopi arabica premium 250g', 'price' => 75000, 'stock' => 50, 'category_id' => 3],
        ['name' => 'Buku Programming', 'description' => 'Buku belajar programming', 'price' => 125000, 'stock' => 25, 'category_id' => 4]
    ];
    
    foreach ($products as $product) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE name = ?");
        $stmt->execute([$product['name']]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$product['name'], $product['description'], $product['price'], $product['stock'], $product['category_id']]);
        }
    }
    echo "✅ Products berhasil ditambahkan\n";
    
    // Sample transactions
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    
    $transactions = [
        [
            'transaction_code' => 'TRX001' . date('Ymd'),
            'customer_name' => 'John Doe',
            'customer_phone' => '081234567890',
            'customer_email' => 'john@example.com',
            'total_amount' => 5150000,
            'payment_method' => 'transfer',
            'payment_status' => 'paid',
            'transaction_date' => $today,
            'created_by' => 1
        ],
        [
            'transaction_code' => 'TRX002' . date('Ymd'),
            'customer_name' => 'Jane Smith',
            'customer_phone' => '081234567891',
            'customer_email' => 'jane@example.com',
            'total_amount' => 450000,
            'payment_method' => 'cash',
            'payment_status' => 'paid',
            'transaction_date' => $yesterday,
            'created_by' => 1
        ]
    ];
    
    foreach ($transactions as $transaction) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM transactions WHERE transaction_code = ?");
        $stmt->execute([$transaction['transaction_code']]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO transactions (transaction_code, customer_name, customer_phone, customer_email, total_amount, payment_method, payment_status, transaction_date, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $transaction['transaction_code'],
                $transaction['customer_name'],
                $transaction['customer_phone'],
                $transaction['customer_email'],
                $transaction['total_amount'],
                $transaction['payment_method'],
                $transaction['payment_status'],
                $transaction['transaction_date'],
                $transaction['created_by']
            ]);
        }
    }
    echo "✅ Sample transactions berhasil ditambahkan\n";
    
    echo "\n🎉 Setup fitur admin selesai!\n";
    echo "\n📋 Fitur yang ditambahkan:\n";
    echo "✅ Role admin/user\n";
    echo "✅ CRUD Categories\n";
    echo "✅ CRUD Products\n";
    echo "✅ Input Transaksi\n";
    echo "✅ Riwayat Transaksi\n";
    echo "✅ Laporan Penjualan\n";
    echo "\n🔐 Login sebagai admin:\n";
    echo "Username: admin\n";
    echo "Password: admin123\n";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
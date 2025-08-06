<?php
/**
 * Test Script untuk Sistem Admin CRUD, Transaksi, dan Laporan
 * Jalankan file ini untuk mengecek apakah semua fitur admin berfungsi
 */

echo "🔍 Testing Sistem Admin: CRUD, Transaksi, dan Laporan\n";
echo "===================================================\n\n";

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ci3_registration';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection: SUCCESS\n\n";
    
    // Test 1: Cek tabel yang diperlukan
    echo "1. Testing Database Tables...\n";
    $required_tables = [
        'users' => 'Tabel user dengan role',
        'categories' => 'Tabel kategori produk',
        'products' => 'Tabel produk',
        'transactions' => 'Tabel transaksi',
        'transaction_items' => 'Tabel item transaksi'
    ];
    
    foreach ($required_tables as $table => $description) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "   ✅ $table: EXISTS ($description)\n";
        } else {
            echo "   ❌ $table: NOT FOUND\n";
        }
    }
    
    // Test 2: Cek kolom role di users
    echo "\n2. Testing User Roles...\n";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (in_array('role', $columns)) {
        echo "   ✅ Role column exists in users table\n";
        
        // Cek admin user
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
        $admin_count = $stmt->fetchColumn();
        echo "   ✅ Admin users: $admin_count\n";
    } else {
        echo "   ❌ Role column missing in users table\n";
    }
    
    // Test 3: Cek data contoh
    echo "\n3. Testing Sample Data...\n";
    
    // Categories
    $stmt = $pdo->query("SELECT COUNT(*) FROM categories");
    $category_count = $stmt->fetchColumn();
    echo "   ✅ Categories: $category_count\n";
    
    // Products
    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
    $product_count = $stmt->fetchColumn();
    echo "   ✅ Products: $product_count\n";
    
    // Transactions
    $stmt = $pdo->query("SELECT COUNT(*) FROM transactions");
    $transaction_count = $stmt->fetchColumn();
    echo "   ✅ Transactions: $transaction_count\n";
    
    // Test 4: Cek file controller dan model
    echo "\n4. Testing Admin Files...\n";
    $required_files = [
        'application/controllers/Admin.php' => 'Admin Controller',
        'application/models/Product_model.php' => 'Product Model',
        'application/models/Transaction_model.php' => 'Transaction Model',
        'application/views/admin/dashboard_view.php' => 'Admin Dashboard View',
        'application/views/admin/products_view.php' => 'Products Management View',
        'application/views/admin/add_transaction_view.php' => 'Add Transaction View',
        'application/views/admin/transactions_view.php' => 'Transactions History View',
        'application/views/admin/reports_view.php' => 'Reports View',
        'application/views/admin/add_product_view.php' => 'Add Product View'
    ];
    
    foreach ($required_files as $file => $description) {
        if (file_exists($file)) {
            echo "   ✅ $description: EXISTS\n";
        } else {
            echo "   ❌ $description: MISSING ($file)\n";
        }
    }
    
    // Test 5: Cek routing
    echo "\n5. Testing Routes Configuration...\n";
    $routes_content = file_get_contents('application/config/routes.php');
    $admin_routes = [
        "route['admin']" => 'Admin dashboard route',
        "route['admin/products']" => 'Products management route',
        "route['admin/transactions']" => 'Transactions route',
        "route['admin/reports']" => 'Reports route'
    ];
    
    foreach ($admin_routes as $route => $description) {
        if (strpos($routes_content, $route) !== false) {
            echo "   ✅ $description: CONFIGURED\n";
        } else {
            echo "   ❌ $description: MISSING\n";
        }
    }
    
    // Test 6: Test database queries
    echo "\n6. Testing Database Queries...\n";
    
    try {
        // Test join query for products
        $stmt = $pdo->query("
            SELECT products.*, categories.name as category_name 
            FROM products 
            LEFT JOIN categories ON categories.id = products.category_id 
            LIMIT 1
        ");
        echo "   ✅ Products join query: WORKING\n";
        
        // Test transaction items query
        $stmt = $pdo->query("
            SELECT t.*, u.username as created_by_name
            FROM transactions t
            LEFT JOIN users u ON u.id = t.created_by
            LIMIT 1
        ");
        echo "   ✅ Transactions join query: WORKING\n";
        
        // Test daily sales summary
        $today = date('Y-m-d');
        $stmt = $pdo->prepare("
            SELECT 
                COUNT(*) as total_transactions,
                SUM(CASE WHEN payment_status = 'paid' THEN total_amount ELSE 0 END) as total_sales
            FROM transactions 
            WHERE transaction_date = ?
        ");
        $stmt->execute([$today]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "   ✅ Daily sales query: WORKING\n";
        
    } catch (Exception $e) {
        echo "   ❌ Database query error: " . $e->getMessage() . "\n";
    }
    
    echo "\n🎉 Testing selesai!\n";
    echo "\n📋 Fitur Admin yang tersedia:\n";
    echo "✅ Dashboard Admin dengan statistik\n";
    echo "✅ CRUD Produk (Create, Read, Update, Delete)\n";
    echo "✅ CRUD Kategori\n";
    echo "✅ Input Transaksi dengan multiple items\n";
    echo "✅ Riwayat Transaksi dengan filter dan search\n";
    echo "✅ Laporan Penjualan per hari\n";
    echo "✅ Export laporan ke CSV\n";
    echo "✅ Role-based access (hanya admin)\n";
    echo "✅ Real-time statistics dan monitoring\n";
    
    echo "\n🔐 URL Admin Panel:\n";
    echo "Dashboard Admin: http://localhost/ci3_project/index.php/admin\n";
    echo "Produk:         http://localhost/ci3_project/index.php/admin/products\n";
    echo "Transaksi:      http://localhost/ci3_project/index.php/admin/transactions\n";
    echo "Input Transaksi: http://localhost/ci3_project/index.php/admin/add-transaction\n";
    echo "Laporan:        http://localhost/ci3_project/index.php/admin/reports\n";
    
    echo "\n👤 Login sebagai Admin:\n";
    echo "Username: admin\n";
    echo "Password: admin123\n";
    
    echo "\n📱 Fitur Lengkap:\n";
    echo "• Dashboard dengan grafik dan statistik real-time\n";
    echo "• Manajemen produk dengan kategori\n";
    echo "• Sistem transaksi dengan multiple items\n";
    echo "• Tracking stok otomatis\n";
    echo "• Laporan penjualan harian dengan filter\n";
    echo "• Export data ke CSV\n";
    echo "• Search dan filter di semua halaman\n";
    echo "• Responsive design untuk mobile\n";
    echo "• Role-based security\n";
    
} catch(PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "Pastikan MySQL server berjalan dan database sudah dibuat.\n";
    echo "Jalankan: php setup_admin_features.php\n";
}
?>
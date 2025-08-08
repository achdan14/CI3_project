<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - User Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        
        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        
        .navbar-nav a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .navbar-nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .welcome-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .welcome-section h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .welcome-section p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 40px;
            margin-bottom: 15px;
        }
        
        .stat-card.primary i { color: #007bff; }
        .stat-card.success i { color: #28a745; }
        .stat-card.warning i { color: #ffc107; }
        .stat-card.info i { color: #17a2b8; }
        
        .stat-card h3 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            color: #666;
            font-size: 14px;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .main-content {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .sidebar-content {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .transaction-item:last-child {
            border-bottom: none;
        }
        
        .transaction-info h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .transaction-info p {
            color: #666;
            font-size: 14px;
        }
        
        .transaction-amount {
            font-weight: bold;
            color: #28a745;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-3px);
        }
        
        .product-card h4 {
            margin-bottom: 10px;
            color: #333;
        }
        
        .product-card p {
            color: #666;
            font-size: 14px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
            color: white;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-success:hover {
            background: #218838;
            color: white;
        }
        
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-warning:hover {
            background: #e0a800;
            color: #212529;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .navbar-nav {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?php echo base_url('dashboard'); ?>" class="navbar-brand">
                <i class="fas fa-home"></i> User Dashboard
            </a>
            <ul class="navbar-nav">
                <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url('dashboard/products'); ?>"><i class="fas fa-box"></i> Produk</a></li>
                <li><a href="<?php echo base_url('dashboard/my_transactions'); ?>"><i class="fas fa-shopping-cart"></i> Transaksi</a></li>
                <li><a href="<?php echo base_url('dashboard/profile'); ?>"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="welcome-section">
            <h1>Selamat Datang, <?php echo htmlspecialchars($user['username']); ?>! 👋</h1>
            <p>Berikut adalah ringkasan aktivitas dan informasi terbaru untuk akun Anda.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card primary">
                <i class="fas fa-shopping-cart"></i>
                <h3><?php echo $user_stats['total_transactions']; ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-card success">
                <i class="fas fa-calendar-check"></i>
                <h3><?php echo $user_stats['this_month_transactions']; ?></h3>
                <p>Transaksi Bulan Ini</p>
            </div>
            <div class="stat-card warning">
                <i class="fas fa-coins"></i>
                <h3>Rp <?php echo number_format($user_stats['total_spent'], 0, ',', '.'); ?></h3>
                <p>Total Pengeluaran</p>
            </div>
            <div class="stat-card info">
                <i class="fas fa-box"></i>
                <h3><?php echo $total_products; ?></h3>
                <p>Produk Tersedia</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="main-content">
                <div class="section-title">
                    <i class="fas fa-history"></i>
                    Transaksi Terbaru
                </div>
                
                <?php if(!empty($user_transactions)): ?>
                    <?php foreach($user_transactions as $transaction): ?>
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <h4><?php echo htmlspecialchars($transaction['transaction_code']); ?></h4>
                                <p>
                                    <i class="fas fa-user"></i> <?php echo htmlspecialchars($transaction['customer_name']); ?> |
                                    <i class="fas fa-calendar"></i> <?php echo date('d/m/Y', strtotime($transaction['transaction_date'])); ?>
                                </p>
                            </div>
                            <div class="transaction-amount">
                                Rp <?php echo number_format($transaction['total_amount'], 0, ',', '.'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="<?php echo base_url('dashboard/my_transactions'); ?>" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Semua Transaksi
                        </a>
                    </div>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 20px;">
                        <i class="fas fa-info-circle"></i> Belum ada transaksi.
                    </p>
                <?php endif; ?>
            </div>

            <div class="sidebar-content">
                <div class="section-title">
                    <i class="fas fa-star"></i>
                    Produk Terbaru
                </div>
                
                <?php if(!empty($recent_products)): ?>
                    <div class="product-grid">
                        <?php foreach($recent_products as $product): ?>
                            <div class="product-card">
                                <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                <p>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                                <span class="badge <?php echo $product['stock'] <= 5 ? 'badge-danger' : 'badge-success'; ?>">
                                    Stok: <?php echo $product['stock']; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="<?php echo base_url('dashboard/products'); ?>" class="btn btn-success">
                            <i class="fas fa-eye"></i> Lihat Semua Produk
                        </a>
                    </div>
                <?php else: ?>
                    <p style="text-align: center; color: #666;">
                        <i class="fas fa-info-circle"></i> Belum ada produk.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html> 
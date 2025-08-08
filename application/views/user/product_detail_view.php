<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Sistem Manajemen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 2px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            height: 300px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            border-radius: 15px;
        }
        .stock-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .stock-high { background: #d4edda; color: #155724; }
        .stock-medium { background: #fff3cd; color: #856404; }
        .stock-low { background: #f8d7da; color: #721c24; }
        .price-tag {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-user-circle me-2"></i>
                            User Panel
                        </h4>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                        <a class="nav-link" href="<?= base_url('dashboard/my_transactions') ?>">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Transaksi
                        </a>
                        <a class="nav-link active" href="<?= base_url('dashboard/products') ?>">
                            <i class="fas fa-box me-2"></i>
                            Katalog Produk
                        </a>
                        <a class="nav-link" href="<?= base_url('dashboard/profile') ?>">
                            <i class="fas fa-user me-2"></i>
                            Profil Saya
                        </a>
                        <a class="nav-link" href="<?= base_url('dashboard/edit_profile') ?>">
                            <i class="fas fa-edit me-2"></i>
                            Edit Profil
                        </a>
                        <a class="nav-link" href="<?= base_url('dashboard/change_password') ?>">
                            <i class="fas fa-key me-2"></i>
                            Ganti Password
                        </a>
                        <hr class="text-white">
                        <a class="nav-link text-danger" href="<?= base_url('login/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content p-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-1">
                                <i class="fas fa-box text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Detail informasi produk</p>
                        </div>
                        <div>
                            <a href="<?= base_url('dashboard/products') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Katalog
                            </a>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-image mb-4">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    
                                    <div class="text-center mb-4">
                                        <h3 class="mb-2"><?= $product['name'] ?></h3>
                                        <p class="text-muted mb-3">
                                            <i class="fas fa-tag me-2"></i>
                                            <?= $product['category_name'] ?: 'Tanpa Kategori' ?>
                                        </p>
                                        
                                        <div class="price-tag mb-3">
                                            Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <?php if ($product['stock'] <= 5): ?>
                                                <span class="stock-badge stock-low">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                    Stok: <?= $product['stock'] ?> (Hampir Habis)
                                                </span>
                                            <?php elseif ($product['stock'] <= 20): ?>
                                                <span class="stock-badge stock-medium">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Stok: <?= $product['stock'] ?> (Terbatas)
                                                </span>
                                            <?php else: ?>
                                                <span class="stock-badge stock-high">
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    Stok: <?= $product['stock'] ?> (Tersedia)
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Informasi Produk
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Deskripsi Produk</h6>
                                        <p class="mb-0">
                                            <?= $product['description'] ?: 'Tidak ada deskripsi produk.' ?>
                                        </p>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Kategori</h6>
                                            <p class="mb-0"><?= $product['category_name'] ?: 'Tanpa Kategori' ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Status</h6>
                                            <span class="badge bg-<?= $product['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($product['status']) ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Harga</h6>
                                            <h5 class="text-primary mb-0">
                                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                            </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Stok Tersedia</h6>
                                            <h5 class="mb-0"><?= $product['stock'] ?> unit</h5>
                                        </div>
                                    </div>
                                    
                                    <?php if ($product['created_at']): ?>
                                        <div class="mb-4">
                                            <h6 class="text-muted mb-2">Tanggal Ditambahkan</h6>
                                            <p class="mb-0">
                                                <i class="fas fa-calendar me-2"></i>
                                                <?= date('d/m/Y H:i', strtotime($product['created_at'])) ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="text-center">
                                        <?php if ($product['status'] == 'active' && $product['stock'] > 0): ?>
                                            <button class="btn btn-primary btn-lg me-2" disabled>
                                                <i class="fas fa-shopping-cart me-2"></i>
                                                Hubungi Admin untuk Pembelian
                                            </button>
                                        <?php elseif ($product['status'] == 'inactive'): ?>
                                            <button class="btn btn-secondary btn-lg" disabled>
                                                <i class="fas fa-times-circle me-2"></i>
                                                Produk Tidak Tersedia
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-warning btn-lg" disabled>
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Stok Habis
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Products -->
                    <div class="card mt-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-th-large me-2"></i>
                                Produk Lainnya
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <a href="<?= base_url('dashboard/products') ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-box me-2"></i>
                                    Lihat Semua Produk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
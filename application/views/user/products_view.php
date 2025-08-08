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
        .product-card {
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }
        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .stock-high { background: #d4edda; color: #155724; }
        .stock-medium { background: #fff3cd; color: #856404; }
        .stock-low { background: #f8d7da; color: #721c24; }
        .category-filter {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
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
                            <p class="text-muted mb-0">Jelajahi katalog produk kami</p>
                        </div>
                        <div>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="category-filter">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h6 class="mb-2">
                                    <i class="fas fa-filter me-2"></i>
                                    Filter Kategori
                                </h6>
                                <select class="form-select" id="categoryFilter">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-2">
                                    <i class="fas fa-search me-2"></i>
                                    Cari Produk
                                </h6>
                                <input type="text" class="form-control" id="searchProduct" placeholder="Cari produk...">
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row" id="productsContainer">
                        <?php if (empty($products)): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada produk</h5>
                                        <p class="text-muted">Belum ada produk yang tersedia saat ini.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-6 col-lg-4 mb-4 product-item" 
                                     data-category="<?= $product['category_id'] ?>" 
                                     data-name="<?= strtolower($product['name']) ?>">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <i class="fas fa-box"></i>
                                            <?php if ($product['stock'] <= 5): ?>
                                                <span class="stock-badge stock-low">Stok: <?= $product['stock'] ?></span>
                                            <?php elseif ($product['stock'] <= 20): ?>
                                                <span class="stock-badge stock-medium">Stok: <?= $product['stock'] ?></span>
                                            <?php else: ?>
                                                <span class="stock-badge stock-high">Stok: <?= $product['stock'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title mb-2"><?= $product['name'] ?></h6>
                                            <p class="card-text text-muted small mb-2">
                                                <?= $product['category_name'] ?: 'Tanpa Kategori' ?>
                                            </p>
                                            <p class="card-text small mb-3">
                                                <?= strlen($product['description']) > 100 ? substr($product['description'], 0, 100) . '...' : $product['description'] ?>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-primary mb-0">
                                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                                </h5>
                                                <a href="<?= base_url('dashboard/product_detail/' . $product['id']) ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>
                                                    Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Category filter functionality
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            const products = document.querySelectorAll('.product-item');
            
            products.forEach(product => {
                if (selectedCategory === '' || product.dataset.category === selectedCategory) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        // Search functionality
        document.getElementById('searchProduct').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-item');
            
            products.forEach(product => {
                const productName = product.dataset.name;
                if (productName.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html> 
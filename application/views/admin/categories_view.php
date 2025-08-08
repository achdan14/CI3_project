<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Admin Panel</title>
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
        .category-item {
            border-left: 4px solid #667eea;
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .category-item:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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
                            <i class="fas fa-user-shield me-2"></i>
                            Admin Panel
                        </h4>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link" href="<?= base_url('admin') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">
                            <i class="fas fa-users me-2"></i>
                            Manajemen User
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/products') ?>">
                            <i class="fas fa-box me-2"></i>
                            Manajemen Produk
                        </a>
                        <a class="nav-link active" href="<?= base_url('admin/categories') ?>">
                            <i class="fas fa-tags me-2"></i>
                            Manajemen Kategori
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/transactions') ?>">
                            <i class="fas fa-receipt me-2"></i>
                            Manajemen Transaksi
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/reports') ?>">
                            <i class="fas fa-chart-bar me-2"></i>
                            Laporan
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
                                <i class="fas fa-tags text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Kelola kategori produk</p>
                        </div>
                        <div>
                            <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <!-- Add Category Form -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-plus me-2"></i>
                                        Tambah Kategori Baru
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?= base_url('admin/add_category') ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-tag me-2"></i>
                                                Nama Kategori
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">
                                                <i class="fas fa-align-left me-2"></i>
                                                Deskripsi
                                            </label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-plus me-2"></i>
                                            Tambah Kategori
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Categories List -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <i class="fas fa-list me-2"></i>
                                            Daftar Kategori
                                        </h5>
                                        <span class="badge bg-primary"><?= count($categories) ?> Kategori</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($categories)): ?>
                                        <div class="text-center py-5">
                                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada kategori</h5>
                                            <p class="text-muted">Belum ada kategori yang ditambahkan.</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($categories as $category): ?>
                                            <div class="category-item">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h6 class="mb-1">
                                                            <i class="fas fa-tag me-2 text-primary"></i>
                                                            <?= $category['name'] ?>
                                                        </h6>
                                                        <p class="mb-0 text-muted small">
                                                            <?= $category['description'] ?: 'Tidak ada deskripsi' ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <small class="text-muted">
                                                            <i class="fas fa-calendar me-1"></i>
                                                            <?= $category['created_at'] ? date('d/m/Y', strtotime($category['created_at'])) : '-' ?>
                                                        </small>
                                                    </div>
                                                    <div class="col-md-3 text-end">
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" disabled>
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <a href="<?= base_url('admin/delete_category/' . $category['id']) ?>" 
                                                               class="btn btn-sm btn-outline-danger"
                                                               onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                                <i class="fas fa-trash"></i>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
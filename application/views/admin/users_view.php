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
        .user-item {
            border-left: 4px solid #667eea;
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .user-item:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }
        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .role-admin { background: #d4edda; color: #155724; }
        .role-user { background: #cce5ff; color: #004085; }
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
                        <a class="nav-link active" href="<?= base_url('admin/users') ?>">
                            <i class="fas fa-users me-2"></i>
                            Manajemen User
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/products') ?>">
                            <i class="fas fa-box me-2"></i>
                            Manajemen Produk
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
                                <i class="fas fa-users text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Kelola data pengguna sistem</p>
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

                    <!-- Users List -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list me-2"></i>
                                    Daftar User
                                </h5>
                                <span class="badge bg-primary"><?= count($users) ?> User</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($users)): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada user</h5>
                                    <p class="text-muted">Belum ada user yang terdaftar dalam sistem.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <div class="user-item">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <h6 class="mb-1">
                                                    <i class="fas fa-user me-2 text-primary"></i>
                                                    <?= $user['username'] ?>
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-envelope me-1"></i>
                                                    <?= $user['email'] ?>
                                                </small>
                                            </div>
                                            <div class="col-md-3">
                                                <h6 class="mb-1">Nama Lengkap</h6>
                                                <p class="mb-0 text-muted"><?= $user['full_name'] ?: '-' ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-1">Role</h6>
                                                <span class="role-badge role-<?= $user['role'] ?>">
                                                    <?= ucfirst($user['role']) ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-1">Status</h6>
                                                <span class="badge bg-<?= $user['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                    <?= ucfirst($user['status']) ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('admin/edit_user/' . $user['id']) ?>" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if ($user['id'] != $this->session->userdata('user_id')): ?>
                                                        <a href="<?= base_url('admin/delete_user/' . $user['id']) ?>" 
                                                           class="btn btn-sm btn-outline-danger"
                                                           onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
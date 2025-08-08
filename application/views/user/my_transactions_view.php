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
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .status-paid { background: #d4edda; color: #155724; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .transaction-item {
            border-left: 4px solid #667eea;
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .transaction-item:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateX(5px);
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
                        <a class="nav-link active" href="<?= base_url('dashboard/my_transactions') ?>">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Transaksi
                        </a>
                        <a class="nav-link" href="<?= base_url('dashboard/products') ?>">
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
                                <i class="fas fa-history text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Kelola dan lihat riwayat transaksi Anda</p>
                        </div>
                        <div>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
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

                    <!-- Transactions List -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-list me-2"></i>
                                Daftar Transaksi
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($transactions)): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada transaksi</h5>
                                    <p class="text-muted">Anda belum memiliki riwayat transaksi.</p>
                                    <a href="<?= base_url('dashboard/products') ?>" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Lihat Produk
                                    </a>
                                </div>
                            <?php else: ?>
                                <?php foreach ($transactions as $transaction): ?>
                                    <div class="transaction-item">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <h6 class="mb-1">
                                                    <i class="fas fa-receipt me-2 text-primary"></i>
                                                    <?= $transaction['transaction_code'] ?>
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    <?= date('d/m/Y', strtotime($transaction['transaction_date'])) ?>
                                                </small>
                                            </div>
                                            <div class="col-md-3">
                                                <h6 class="mb-1">Customer</h6>
                                                <p class="mb-0 text-muted"><?= $transaction['customer_name'] ?></p>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-1">Total</h6>
                                                <p class="mb-0 fw-bold text-primary">
                                                    Rp <?= number_format($transaction['total_amount'], 0, ',', '.') ?>
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <h6 class="mb-1">Status</h6>
                                                <span class="status-badge status-<?= $transaction['payment_status'] ?>">
                                                    <?= ucfirst($transaction['payment_status']) ?>
                                                </span>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <a href="<?= base_url('dashboard/view_transaction/' . $transaction['id']) ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>
                                                    Detail
                                                </a>
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
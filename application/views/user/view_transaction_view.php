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
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .status-paid { background: #d4edda; color: #155724; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .transaction-detail {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid #667eea;
        }
        .item-row {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
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
                                <i class="fas fa-receipt text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Detail informasi transaksi</p>
                        </div>
                        <div>
                            <a href="<?= base_url('dashboard/my_transactions') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Riwayat
                            </a>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Informasi Transaksi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="transaction-detail">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-2">Kode Transaksi</h6>
                                                <h5 class="mb-3"><?= $transaction['transaction_code'] ?></h5>
                                                
                                                <h6 class="text-muted mb-2">Tanggal Transaksi</h6>
                                                <p class="mb-3"><?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></p>
                                                
                                                <h6 class="text-muted mb-2">Status Pembayaran</h6>
                                                <span class="status-badge status-<?= $transaction['payment_status'] ?>">
                                                    <?= ucfirst($transaction['payment_status']) ?>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-2">Metode Pembayaran</h6>
                                                <p class="mb-3"><?= ucfirst($transaction['payment_method']) ?></p>
                                                
                                                <h6 class="text-muted mb-2">Total Amount</h6>
                                                <h4 class="text-primary mb-3">Rp <?= number_format($transaction['total_amount'], 0, ',', '.') ?></h4>
                                                
                                                <?php if ($transaction['notes']): ?>
                                                    <h6 class="text-muted mb-2">Catatan</h6>
                                                    <p class="mb-0"><?= $transaction['notes'] ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information -->
                            <div class="card mt-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user me-2"></i>
                                        Informasi Customer
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Nama Customer</h6>
                                            <p class="mb-3"><?= $transaction['customer_name'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Email</h6>
                                            <p class="mb-3"><?= $transaction['customer_email'] ?: '-' ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-2">Nomor Telepon</h6>
                                            <p class="mb-0"><?= $transaction['customer_phone'] ?: '-' ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Transaction Items -->
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-shopping-cart me-2"></i>
                                        Item Transaksi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($transaction_items)): ?>
                                        <p class="text-muted text-center">Tidak ada item transaksi</p>
                                    <?php else: ?>
                                        <?php foreach ($transaction_items as $item): ?>
                                            <div class="item-row">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="mb-1"><?= $item['product_name'] ?></h6>
                                                    <span class="badge bg-primary"><?= $item['quantity'] ?>x</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        Rp <?= number_format($item['price'], 0, ',', '.') ?> per item
                                                    </small>
                                                    <strong class="text-primary">
                                                        Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Total</h6>
                                            <h5 class="mb-0 text-primary">
                                                Rp <?= number_format($transaction['total_amount'], 0, ',', '.') ?>
                                            </h5>
                                        </div>
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
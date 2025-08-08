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
                                <i class="fas fa-edit text-primary me-2"></i>
                                <?= $page_title ?>
                            </h2>
                            <p class="text-muted mb-0">Edit informasi user</p>
                        </div>
                        <div>
                            <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Daftar User
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

                    <!-- Edit User Form -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user-edit me-2"></i>
                                Edit User: <?= $user['username'] ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">
                                                <i class="fas fa-user me-2"></i>
                                                Username
                                            </label>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   value="<?= set_value('username', $user['username']) ?>" required>
                                            <?php if (form_error('username')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('username') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope me-2"></i>
                                                Email
                                            </label>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="<?= set_value('email', $user['email']) ?>" required>
                                            <?php if (form_error('email')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('email') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">
                                                <i class="fas fa-id-card me-2"></i>
                                                Nama Lengkap
                                            </label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" 
                                                   value="<?= set_value('full_name', $user['full_name']) ?>">
                                            <?php if (form_error('full_name')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('full_name') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">
                                                <i class="fas fa-phone me-2"></i>
                                                Nomor Telepon
                                            </label>
                                            <input type="text" class="form-control" id="phone" name="phone" 
                                                   value="<?= set_value('phone', $user['phone']) ?>">
                                            <?php if (form_error('phone')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('phone') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">
                                                <i class="fas fa-user-tag me-2"></i>
                                                Role
                                            </label>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="user" <?= set_select('role', 'user', $user['role'] == 'user') ?>>User</option>
                                                <option value="admin" <?= set_select('role', 'admin', $user['role'] == 'admin') ?>>Admin</option>
                                            </select>
                                            <?php if (form_error('role')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('role') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on me-2"></i>
                                                Status
                                            </label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="active" <?= set_select('status', 'active', $user['status'] == 'active') ?>>Active</option>
                                                <option value="inactive" <?= set_select('status', 'inactive', $user['status'] == 'inactive') ?>>Inactive</option>
                                            </select>
                                            <?php if (form_error('status')): ?>
                                                <div class="text-danger small mt-1"><?= form_error('status') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        Alamat
                                    </label>
                                    <textarea class="form-control" id="address" name="address" rows="3"><?= set_value('address', $user['address']) ?></textarea>
                                    <?php if (form_error('address')): ?>
                                        <div class="text-danger small mt-1"><?= form_error('address') ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>
                                        Update User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - User Profile</title>
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
        
        .profile-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            color: white;
        }
        
        .profile-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        
        .profile-role {
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .stat-item h3 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 5px;
        }
        
        .stat-item p {
            color: #666;
            font-size: 14px;
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .profile-details {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .profile-actions {
            background: white;
            border-radius: 15px;
            padding: 30px;
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
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #666;
        }
        
        .detail-value {
            color: #333;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
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
        
        @media (max-width: 768px) {
            .profile-content {
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
                <li><a href="<?php echo base_url('dashboard/profile'); ?>" class="active"><i class="fas fa-user"></i> Profil</a></li>
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

        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-name"><?php echo htmlspecialchars($user['full_name'] ?? $user['username']); ?></div>
            <div class="profile-role">
                <i class="fas fa-user-circle"></i> <?php echo ucfirst($user['role'] ?? 'user'); ?>
            </div>
            <p style="color: #666; margin-bottom: 0;">
                Member sejak <?php echo date('d F Y', strtotime($user['created_at'] ?? 'now')); ?>
            </p>
        </div>

        <div class="profile-content">
            <div class="profile-details">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Profil
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Username</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['username']); ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                
                <?php if(isset($user['full_name'])): ?>
                <div class="detail-item">
                    <span class="detail-label">Nama Lengkap</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['full_name']); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if(isset($user['phone']) && $user['phone']): ?>
                <div class="detail-item">
                    <span class="detail-label">Nomor Telepon</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['phone']); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if(isset($user['address']) && $user['address']): ?>
                <div class="detail-item">
                    <span class="detail-label">Alamat</span>
                    <span class="detail-value"><?php echo htmlspecialchars($user['address']); ?></span>
                </div>
                <?php endif; ?>
                
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">
                        <span style="color: #28a745; font-weight: bold;">
                            <i class="fas fa-check-circle"></i> Aktif
                        </span>
                    </span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Terakhir Login</span>
                    <span class="detail-value"><?php echo date('d/m/Y H:i', strtotime($user['updated_at'] ?? 'now')); ?></span>
                </div>
            </div>

            <div class="profile-actions">
                <div class="section-title">
                    <i class="fas fa-cog"></i>
                    Aksi Profil
                </div>
                
                <a href="<?php echo base_url('dashboard/edit_profile'); ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
                
                <a href="<?php echo base_url('dashboard/change_password'); ?>" class="btn btn-warning">
                    <i class="fas fa-key"></i> Ganti Password
                </a>
                
                <a href="<?php echo base_url('dashboard/my_transactions'); ?>" class="btn btn-success">
                    <i class="fas fa-history"></i> Riwayat Transaksi
                </a>
                
                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html> 
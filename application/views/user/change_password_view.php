<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - Change Password</title>
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
            max-width: 600px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #666;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        
        .password-toggle {
            position: relative;
        }
        
        .password-toggle input {
            padding-right: 50px;
        }
        
        .password-toggle-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 16px;
        }
        
        .password-toggle-btn:hover {
            color: #333;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
            color: white;
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
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
        
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .password-requirements {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border-left: 4px solid #007bff;
        }
        
        .password-requirements h4 {
            margin-bottom: 10px;
            color: #333;
            font-size: 16px;
        }
        
        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .password-requirements li {
            margin-bottom: 5px;
        }
        
        .strength-meter {
            margin-top: 10px;
        }
        
        .strength-bar {
            height: 5px;
            border-radius: 3px;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            transition: all 0.3s;
            border-radius: 3px;
        }
        
        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #ffc107; width: 50%; }
        .strength-good { background: #17a2b8; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }
        
        .strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
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

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-key"></i> <?php echo $page_title; ?></h1>
                <p>Ubah password akun Anda untuk keamanan yang lebih baik</p>
            </div>

            <?php echo form_open('dashboard/change_password'); ?>
                <div class="form-group">
                    <label for="current_password" class="form-label">
                        <i class="fas fa-lock"></i> Password Saat Ini
                    </label>
                    <div class="password-toggle">
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               class="form-input" 
                               required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('current_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php if(form_error('current_password')): ?>
                        <div class="error-message"><?php echo form_error('current_password'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="new_password" class="form-label">
                        <i class="fas fa-key"></i> Password Baru
                    </label>
                    <div class="password-toggle">
                        <input type="password" 
                               id="new_password" 
                               name="new_password" 
                               class="form-input" 
                               required 
                               onkeyup="checkPasswordStrength(this.value)">
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('new_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="strength-meter">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <div class="strength-text" id="strength-text">Masukkan password baru</div>
                    </div>
                    <?php if(form_error('new_password')): ?>
                        <div class="error-message"><?php echo form_error('new_password'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">
                        <i class="fas fa-check-circle"></i> Konfirmasi Password Baru
                    </label>
                    <div class="password-toggle">
                        <input type="password" 
                               id="confirm_password" 
                               name="confirm_password" 
                               class="form-input" 
                               required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php if(form_error('confirm_password')): ?>
                        <div class="error-message"><?php echo form_error('confirm_password'); ?></div>
                    <?php endif; ?>
                </div>

                <div class="password-requirements">
                    <h4><i class="fas fa-info-circle"></i> Persyaratan Password</h4>
                    <ul>
                        <li>Minimal 6 karakter</li>
                        <li>Mengandung huruf dan angka</li>
                        <li>Hindari password yang mudah ditebak</li>
                        <li>Jangan gunakan password yang sama dengan akun lain</li>
                    </ul>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Ubah Password
                    </button>
                    <a href="<?php echo base_url('dashboard/profile'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const btn = input.nextElementSibling;
            const icon = btn.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        function checkPasswordStrength(password) {
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');
            
            let strength = 0;
            let text = '';
            let className = '';
            
            if (password.length >= 6) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            
            if (strength === 0) {
                text = 'Masukkan password baru';
                className = '';
            } else if (strength <= 25) {
                text = 'Lemah';
                className = 'strength-weak';
            } else if (strength <= 50) {
                text = 'Cukup';
                className = 'strength-fair';
            } else if (strength <= 75) {
                text = 'Baik';
                className = 'strength-good';
            } else {
                text = 'Kuat';
                className = 'strength-strong';
            }
            
            strengthFill.className = 'strength-fill ' + className;
            strengthText.textContent = text;
        }
    </script>
</body>
</html> 
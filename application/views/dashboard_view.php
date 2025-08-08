<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .welcome-card h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .user-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .user-details p {
            margin: 10px 0;
            color: #555;
        }
        .user-details strong {
            color: #333;
        }
        .nav-menu {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .nav-btn {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }
        .nav-btn:hover {
            background-color: #0056b3;
        }
        .nav-btn.secondary {
            background-color: #6c757d;
        }
        .nav-btn.secondary:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard</h1>
        <div class="user-info">
            <span>Selamat datang, <?php echo $user['username']; ?>!</span>
            <a href="<?php echo base_url('login/logout'); ?>" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h2>Selamat Datang di Sistem Registrasi</h2>
            
            <div class="user-details">
                <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
                <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            </div>

            <div class="nav-menu">
                <a href="<?php echo base_url('dashboard/profile'); ?>" class="nav-btn">Profil Saya</a>
                <a href="<?php echo base_url('dashboard/edit_profile'); ?>" class="nav-btn secondary">Edit Profil</a>
                <a href="<?php echo base_url('dashboard/change_password'); ?>" class="nav-btn secondary">Ganti Password</a>
            </div>
        </div>
    </div>
</body>
</html> 
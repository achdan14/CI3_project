<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Same CSS as other admin pages */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            z-index: 1000;
        }
        
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            padding: 0 20px;
            font-size: 24px;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar ul li {
            margin: 5px 0;
        }
        
        .sidebar ul li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            color: #333;
            font-size: 28px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .btn-info {
            background: #17a2b8;
            color: white;
        }
        
        .btn-info:hover {
            background: #138496;
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h3 {
            margin: 0;
            color: #333;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
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
        
        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .badge-info {
            background-color: #17a2b8;
            color: white;
        }
        
        .text-center {
            text-align: center;
        }
        
        .search-box {
            margin-bottom: 20px;
        }
        
        .search-box input {
            width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-box h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .stat-box p {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="<?php echo base_url('admin'); ?>">📊 Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/products'); ?>">📦 Produk</a></li>
            <li><a href="<?php echo base_url('admin/categories'); ?>">🏷️ Kategori</a></li>
            <li><a href="<?php echo base_url('admin/transactions'); ?>" class="active">💳 Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/add-transaction'); ?>">➕ Input Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/reports'); ?>">📈 Laporan</a></li>
            <li><a href="<?php echo base_url('dashboard'); ?>">👤 User Dashboard</a></li>
            <li><a href="<?php echo base_url('logout'); ?>">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Riwayat Transaksi</h1>
            <div>
                <a href="<?php echo base_url('admin/add-transaction'); ?>" class="btn btn-success">
                    ➕ Input Transaksi
                </a>
                <a href="<?php echo base_url('admin/reports'); ?>" class="btn btn-primary">
                    📈 Lihat Laporan
                </a>
            </div>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="stats-row">
            <div class="stat-box">
                <h3><?php echo count($transactions); ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-box">
                <h3>
                    <?php 
                    $paid_transactions = array_filter($transactions, function($t) { return $t['payment_status'] == 'paid'; });
                    echo count($paid_transactions); 
                    ?>
                </h3>
                <p>Transaksi Lunas</p>
            </div>
            <div class="stat-box">
                <h3>
                    Rp <?php 
                    $total_sales = array_sum(array_column($paid_transactions, 'total_amount'));
                    echo number_format($total_sales, 0, ',', '.'); 
                    ?>
                </h3>
                <p>Total Penjualan</p>
            </div>
            <div class="stat-box">
                <h3>
                    <?php 
                    $today_transactions = array_filter($transactions, function($t) { 
                        return $t['transaction_date'] == date('Y-m-d'); 
                    });
                    echo count($today_transactions); 
                    ?>
                </h3>
                <p>Transaksi Hari Ini</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>📋 Daftar Transaksi</h3>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari transaksi..." onkeyup="searchTable()">
                </div>
            </div>
            <div class="card-body">
                <?php if(!empty($transactions)): ?>
                    <table class="table" id="transactionsTable">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($transactions as $transaction): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($transaction['transaction_code']); ?></strong>
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo htmlspecialchars($transaction['customer_name']); ?></strong>
                                        <?php if($transaction['customer_phone']): ?>
                                            <br><small style="color: #666;">📞 <?php echo htmlspecialchars($transaction['customer_phone']); ?></small>
                                        <?php endif; ?>
                                        <?php if($transaction['customer_email']): ?>
                                            <br><small style="color: #666;">📧 <?php echo htmlspecialchars($transaction['customer_email']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <strong>Rp <?php echo number_format($transaction['total_amount'], 0, ',', '.'); ?></strong>
                                </td>
                                <td>
                                    <?php
                                    $method_icons = [
                                        'cash' => '💵 Tunai',
                                        'transfer' => '🏦 Transfer',
                                        'card' => '💳 Kartu'
                                    ];
                                    echo $method_icons[$transaction['payment_method']] ?? ucfirst($transaction['payment_method']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $badge_class = 'badge-warning';
                                    $status_icons = [
                                        'paid' => '✅',
                                        'pending' => '⏳',
                                        'failed' => '❌'
                                    ];
                                    if($transaction['payment_status'] == 'paid') $badge_class = 'badge-success';
                                    if($transaction['payment_status'] == 'failed') $badge_class = 'badge-danger';
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php echo $status_icons[$transaction['payment_status']] ?? ''; ?>
                                        <?php echo ucfirst($transaction['payment_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($transaction['transaction_date'])); ?>
                                    <br><small style="color: #666;"><?php echo date('H:i', strtotime($transaction['created_at'])); ?></small>
                                </td>
                                <td>
                                    <small><?php echo htmlspecialchars($transaction['created_by_name'] ?? 'System'); ?></small>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('admin/view-transaction/' . $transaction['id']); ?>" 
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        👁️ Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="text-center">
                        <p>Belum ada transaksi.</p>
                        <a href="<?php echo base_url('admin/add-transaction'); ?>" class="btn btn-primary">
                            ➕ Input Transaksi Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Summary -->
        <?php if(!empty($transactions)): ?>
        <div class="card">
            <div class="card-header">
                <h3>📊 Ringkasan Status</h3>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <?php
                    $status_summary = [];
                    foreach($transactions as $transaction) {
                        $status = $transaction['payment_status'];
                        if (!isset($status_summary[$status])) {
                            $status_summary[$status] = ['count' => 0, 'amount' => 0];
                        }
                        $status_summary[$status]['count']++;
                        $status_summary[$status]['amount'] += $transaction['total_amount'];
                    }
                    
                    $status_colors = [
                        'paid' => '#28a745',
                        'pending' => '#ffc107', 
                        'failed' => '#dc3545'
                    ];
                    
                    foreach($status_summary as $status => $data):
                    ?>
                    <div style="text-align: center; padding: 20px; background: <?php echo $status_colors[$status] ?? '#6c757d'; ?>; color: white; border-radius: 10px;">
                        <h3><?php echo $data['count']; ?></h3>
                        <p><?php echo ucfirst($status); ?></p>
                        <small>Rp <?php echo number_format($data['amount'], 0, ',', '.'); ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("transactionsTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var found = false;
                var tds = tr[i].getElementsByTagName("td");
                
                for (var j = 0; j < tds.length; j++) {
                    td = tds[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Auto refresh every 2 minutes for real-time updates
        setTimeout(function() {
            location.reload();
        }, 120000);
    </script>
</body>
</html>
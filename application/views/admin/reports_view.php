<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?> - Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Same CSS as before for consistency */
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
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-card h3 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            font-size: 16px;
            opacity: 0.9;
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            align-items: end;
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
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .no-print {
            /* For hiding elements when printing */
        }
        
        @media print {
            .sidebar,
            .no-print {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar no-print">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="<?php echo base_url('admin'); ?>">📊 Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/products'); ?>">📦 Produk</a></li>
            <li><a href="<?php echo base_url('admin/categories'); ?>">🏷️ Kategori</a></li>
            <li><a href="<?php echo base_url('admin/transactions'); ?>">💳 Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/add-transaction'); ?>">➕ Input Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/reports'); ?>" class="active">📈 Laporan</a></li>
            <li><a href="<?php echo base_url('dashboard'); ?>">👤 User Dashboard</a></li>
            <li><a href="<?php echo base_url('logout'); ?>">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header no-print">
            <h1>Laporan Penjualan</h1>
            <div>
                <a href="<?php echo base_url('admin/export-report?date=' . $selected_date); ?>" 
                   class="btn btn-success">📊 Export CSV</a>
                <button onclick="window.print()" class="btn btn-info">🖨️ Print</button>
            </div>
        </div>

        <!-- Date Filter -->
        <div class="card no-print">
            <div class="card-header">
                <h3>📅 Filter Tanggal</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="<?php echo base_url('admin/reports'); ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Pilih Tanggal</label>
                            <input type="date" name="date" class="form-control" 
                                   value="<?php echo $selected_date; ?>" 
                                   onchange="this.form.submit()">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">🔍 Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Header -->
        <div class="text-center" style="margin-bottom: 30px;">
            <h2>Laporan Penjualan Harian</h2>
            <h3><?php echo date('d F Y', strtotime($selected_date)); ?></h3>
        </div>

        <!-- Summary Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3><?php echo $daily_summary['total_transactions'] ?? 0; ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="stat-card">
                <h3>Rp <?php echo number_format($daily_summary['total_sales'] ?? 0, 0, ',', '.'); ?></h3>
                <p>Total Penjualan</p>
            </div>
            <div class="stat-card">
                <h3>Rp <?php echo number_format($daily_summary['pending_amount'] ?? 0, 0, ',', '.'); ?></h3>
                <p>Pending Payment</p>
            </div>
            <div class="stat-card">
                <h3>Rp <?php echo number_format(($daily_summary['total_sales'] ?? 0) / max(1, $daily_summary['total_transactions'] ?? 1), 0, ',', '.'); ?></h3>
                <p>Rata-rata per Transaksi</p>
            </div>
        </div>

        <!-- Payment Method Statistics -->
        <?php if(!empty($payment_stats)): ?>
        <div class="card">
            <div class="card-header">
                <h3>💳 Statistik Metode Pembayaran</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Amount</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_amount = array_sum(array_column($payment_stats, 'total_amount'));
                        foreach($payment_stats as $stat): 
                        ?>
                        <tr>
                            <td>
                                <?php
                                $method_icons = [
                                    'cash' => '💵 Tunai',
                                    'transfer' => '🏦 Transfer',
                                    'card' => '💳 Kartu'
                                ];
                                echo $method_icons[$stat['payment_method']] ?? ucfirst($stat['payment_method']);
                                ?>
                            </td>
                            <td><?php echo $stat['transaction_count']; ?></td>
                            <td>Rp <?php echo number_format($stat['total_amount'], 0, ',', '.'); ?></td>
                            <td>
                                <?php 
                                $percentage = $total_amount > 0 ? ($stat['total_amount'] / $total_amount * 100) : 0;
                                echo number_format($percentage, 1); 
                                ?>%
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <!-- Top Selling Products -->
        <?php if(!empty($top_products)): ?>
        <div class="card">
            <div class="card-header">
                <h3>🏆 Produk Terlaris</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Terjual</th>
                            <th>Total Revenue</th>
                            <th>Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($top_products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td>
                                <span class="badge badge-success">
                                    <?php echo $product['total_quantity']; ?> pcs
                                </span>
                            </td>
                            <td>Rp <?php echo number_format($product['total_revenue'], 0, ',', '.'); ?></td>
                            <td><?php echo $product['transaction_count']; ?>x</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <!-- Daily Transactions -->
        <div class="card">
            <div class="card-header">
                <h3>📋 Detail Transaksi Harian</h3>
            </div>
            <div class="card-body">
                <?php if(!empty($daily_transactions)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Waktu</th>
                                <th class="no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($daily_transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['transaction_code']); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($transaction['customer_name']); ?></strong>
                                    <?php if($transaction['customer_phone']): ?>
                                        <br><small><?php echo htmlspecialchars($transaction['customer_phone']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?php echo number_format($transaction['total_amount'], 0, ',', '.'); ?></td>
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
                                    if($transaction['payment_status'] == 'paid') $badge_class = 'badge-success';
                                    if($transaction['payment_status'] == 'failed') $badge_class = 'badge-danger';
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php echo ucfirst($transaction['payment_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('H:i', strtotime($transaction['created_at'])); ?></td>
                                <td class="no-print">
                                    <a href="<?php echo base_url('admin/view-transaction/' . $transaction['id']); ?>" 
                                       class="btn btn-info btn-sm">👁️ Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #f8f9fa; font-weight: bold;">
                                <td colspan="2">Total</td>
                                <td>Rp <?php echo number_format(array_sum(array_column($daily_transactions, 'total_amount')), 0, ',', '.'); ?></td>
                                <td colspan="4"><?php echo count($daily_transactions); ?> transaksi</td>
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <div class="text-center">
                        <p>Tidak ada transaksi pada tanggal <?php echo date('d F Y', strtotime($selected_date)); ?>.</p>
                        <a href="<?php echo base_url('admin/add-transaction'); ?>" class="btn btn-primary">
                            ➕ Input Transaksi Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Report Footer -->
        <div class="text-center" style="margin-top: 50px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p><small>Laporan dibuat pada: <?php echo date('d F Y H:i:s'); ?></small></p>
            <p><small>Sistem Admin Panel - <?php echo $this->session->userdata('username'); ?></small></p>
        </div>
    </div>

    <script>
        // Auto refresh every 5 minutes for real-time updates
        setTimeout(function() {
            if (window.location.search.indexOf('date=') === -1 || 
                window.location.search.indexOf('date=' + new Date().toISOString().split('T')[0]) !== -1) {
                location.reload();
            }
        }, 300000); // 5 minutes

        // Quick date navigation
        document.addEventListener('keydown', function(e) {
            if (e.altKey) {
                const currentDate = new Date('<?php echo $selected_date; ?>');
                let newDate;
                
                if (e.key === 'ArrowLeft') {
                    // Previous day
                    newDate = new Date(currentDate.getTime() - 24 * 60 * 60 * 1000);
                } else if (e.key === 'ArrowRight') {
                    // Next day
                    newDate = new Date(currentDate.getTime() + 24 * 60 * 60 * 1000);
                } else if (e.key === 'ArrowUp') {
                    // Today
                    newDate = new Date();
                }
                
                if (newDate) {
                    const dateString = newDate.toISOString().split('T')[0];
                    window.location.href = '<?php echo base_url('admin/reports'); ?>?date=' + dateString;
                }
            }
        });
    </script>
</body>
</html>
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
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
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
        }
        
        .card-header h3 {
            margin: 0;
            color: #333;
        }
        
        .card-body {
            padding: 20px;
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
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
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
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .total-display {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .total-display h3 {
            margin: 0;
            color: #007bff;
            font-size: 24px;
        }
        
        #itemsTable tbody tr {
            background: #f8f9fa;
        }
        
        .product-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
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
            <li><a href="<?php echo base_url('admin/transactions'); ?>">💳 Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/add-transaction'); ?>" class="active">➕ Input Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/reports'); ?>">📈 Laporan</a></li>
            <li><a href="<?php echo base_url('dashboard'); ?>">👤 User Dashboard</a></li>
            <li><a href="<?php echo base_url('logout'); ?>">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Input Transaksi</h1>
            <a href="<?php echo base_url('admin/transactions'); ?>" class="btn btn-secondary">
                ← Kembali ke Daftar Transaksi
            </a>
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

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?php echo form_open('admin/add-transaction', 'id="transactionForm"'); ?>
        
        <div class="card">
            <div class="card-header">
                <h3>📋 Informasi Transaksi</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label>Kode Transaksi *</label>
                        <input type="text" name="transaction_code" class="form-control" 
                               value="<?php echo set_value('transaction_code', $transaction_code); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>👤 Informasi Customer</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Customer *</label>
                        <input type="text" name="customer_name" class="form-control" 
                               value="<?php echo set_value('customer_name'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" name="customer_phone" class="form-control" 
                               value="<?php echo set_value('customer_phone'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="customer_email" class="form-control" 
                           value="<?php echo set_value('customer_email'); ?>">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>🛒 Produk</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Pilih Produk</label>
                    <select id="productSelect" class="form-control">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach($products as $product): ?>
                            <option value="<?php echo $product['id']; ?>" 
                                    data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                    data-price="<?php echo $product['price']; ?>"
                                    data-stock="<?php echo $product['stock']; ?>">
                                <?php echo htmlspecialchars($product['name']); ?> 
                                - Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                                (Stok: <?php echo $product['stock']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="selectedItems">
                    <h4>Item yang Dipilih:</h4>
                    <table class="table" id="itemsTable">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic content -->
                        </tbody>
                    </table>
                </div>

                <div class="total-display">
                    <div class="text-right">
                        <h3>Total: Rp <span id="totalAmount">0</span></h3>
                        <input type="hidden" name="total_amount" id="totalInput" value="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>💳 Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="form-row-3">
                    <div class="form-group">
                        <label>Metode Pembayaran *</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="cash" <?php echo set_select('payment_method', 'cash'); ?>>Tunai</option>
                            <option value="transfer" <?php echo set_select('payment_method', 'transfer'); ?>>Transfer</option>
                            <option value="card" <?php echo set_select('payment_method', 'card'); ?>>Kartu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran *</label>
                        <select name="payment_status" class="form-control" required>
                            <option value="paid" <?php echo set_select('payment_status', 'paid'); ?>>Lunas</option>
                            <option value="pending" <?php echo set_select('payment_status', 'pending'); ?>>Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="notes" class="form-control" rows="3"><?php echo set_value('notes'); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                💾 Simpan Transaksi
            </button>
            <a href="<?php echo base_url('admin/transactions'); ?>" class="btn btn-secondary">
                ❌ Batal
            </a>
        </div>

        <?php echo form_close(); ?>
    </div>

    <script>
        let selectedItems = [];
        let itemCounter = 0;

        document.getElementById('productSelect').addEventListener('change', function() {
            const select = this;
            const option = select.options[select.selectedIndex];
            
            if (option.value) {
                const product = {
                    id: option.value,
                    name: option.dataset.name,
                    price: parseInt(option.dataset.price),
                    stock: parseInt(option.dataset.stock),
                    quantity: 1
                };
                
                addItemToTable(product);
                select.value = '';
            }
        });

        function addItemToTable(product) {
            const tbody = document.querySelector('#itemsTable tbody');
            const row = document.createElement('tr');
            const itemId = 'item_' + itemCounter++;
            
            row.innerHTML = `
                <td>
                    ${product.name}
                    <input type="hidden" name="products[]" value="${product.id}">
                </td>
                <td>
                    Rp ${formatNumber(product.price)}
                    <input type="hidden" name="prices[]" value="${product.price}">
                </td>
                <td>
                    <input type="number" name="quantities[]" value="${product.quantity}" 
                           min="1" max="${product.stock}" class="form-control" style="width: 80px;"
                           onchange="updateSubtotal(this, ${product.price})">
                </td>
                <td class="subtotal">
                    Rp ${formatNumber(product.price * product.quantity)}
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">
                        🗑️ Hapus
                    </button>
                </td>
            `;
            
            tbody.appendChild(row);
            updateTotal();
            updateSubmitButton();
        }

        function updateSubtotal(input, price) {
            const row = input.closest('tr');
            const quantity = parseInt(input.value) || 0;
            const subtotal = price * quantity;
            
            row.querySelector('.subtotal').textContent = 'Rp ' + formatNumber(subtotal);
            updateTotal();
        }

        function removeItem(button) {
            button.closest('tr').remove();
            updateTotal();
            updateSubmitButton();
        }

        function updateTotal() {
            const subtotals = document.querySelectorAll('.subtotal');
            let total = 0;
            
            subtotals.forEach(function(subtotal) {
                const value = subtotal.textContent.replace(/[^\d]/g, '');
                total += parseInt(value) || 0;
            });
            
            document.getElementById('totalAmount').textContent = formatNumber(total);
            document.getElementById('totalInput').value = total;
        }

        function updateSubmitButton() {
            const hasItems = document.querySelectorAll('#itemsTable tbody tr').length > 0;
            document.getElementById('submitBtn').disabled = !hasItems;
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Form validation
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            const hasItems = document.querySelectorAll('#itemsTable tbody tr').length > 0;
            if (!hasItems) {
                e.preventDefault();
                alert('Silakan pilih minimal satu produk!');
            }
        });
    </script>
</body>
</html>
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
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
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
        
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="<?php echo base_url('admin'); ?>">📊 Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/products'); ?>" class="active">📦 Produk</a></li>
            <li><a href="<?php echo base_url('admin/categories'); ?>">🏷️ Kategori</a></li>
            <li><a href="<?php echo base_url('admin/transactions'); ?>">💳 Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/add-transaction'); ?>">➕ Input Transaksi</a></li>
            <li><a href="<?php echo base_url('admin/reports'); ?>">📈 Laporan</a></li>
            <li><a href="<?php echo base_url('dashboard'); ?>">👤 User Dashboard</a></li>
            <li><a href="<?php echo base_url('logout'); ?>">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Tambah Produk</h1>
            <a href="<?php echo base_url('admin/products'); ?>" class="btn btn-secondary">
                ← Kembali ke Daftar Produk
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

        <?php echo form_open('admin/add-product'); ?>
        
        <div class="card">
            <div class="card-header">
                <h3>📝 Informasi Produk</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Produk <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" 
                           value="<?php echo set_value('name'); ?>" 
                           placeholder="Masukkan nama produk" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea name="description" class="form-control" rows="4" 
                              placeholder="Masukkan deskripsi produk"><?php echo set_value('description'); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga <span class="required">*</span></label>
                        <input type="number" name="price" class="form-control" 
                               value="<?php echo set_value('price'); ?>" 
                               placeholder="0" min="0" step="1000" required>
                    </div>
                    <div class="form-group">
                        <label>Stok <span class="required">*</span></label>
                        <input type="number" name="stock" class="form-control" 
                               value="<?php echo set_value('stock'); ?>" 
                               placeholder="0" min="0" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="required">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" 
                                        <?php echo set_select('category_id', $category['id']); ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" <?php echo set_select('status', 'active', TRUE); ?>>Aktif</option>
                            <option value="inactive" <?php echo set_select('status', 'inactive'); ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">
                💾 Simpan Produk
            </button>
            <a href="<?php echo base_url('admin/products'); ?>" class="btn btn-secondary">
                ❌ Batal
            </a>
        </div>

        <?php echo form_close(); ?>
    </div>

    <script>
        // Format price input
        document.querySelector('input[name="price"]').addEventListener('input', function(e) {
            let value = e.target.value;
            if (value && !isNaN(value)) {
                // Auto format to thousands
                if (value.length > 3 && value % 1000 !== 0) {
                    let rounded = Math.round(value / 1000) * 1000;
                    if (confirm('Pembulatan harga ke Rp ' + rounded.toLocaleString('id-ID') + '?')) {
                        e.target.value = rounded;
                    }
                }
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.querySelector('input[name="name"]').value.trim();
            const price = document.querySelector('input[name="price"]').value;
            const stock = document.querySelector('input[name="stock"]').value;
            const category = document.querySelector('select[name="category_id"]').value;
            
            if (!name || !price || !stock || !category) {
                e.preventDefault();
                alert('Semua field yang wajib diisi harus dilengkapi!');
                return false;
            }
            
            if (parseInt(price) < 0 || parseInt(stock) < 0) {
                e.preventDefault();
                alert('Harga dan stok tidak boleh negatif!');
                return false;
            }
        });
    </script>
</body>
</html>
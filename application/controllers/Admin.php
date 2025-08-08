<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller
 * 
 * @property CI_Session $session
 * @property User_model $User_model
 * @property Product_model $Product_model
 * @property Transaction_model $Transaction_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $this->load->model('Transaction_model');
        $this->load->helper('security');
        $this->load->helper('auth');
        
        // Cek apakah user sudah login dan adalah admin
        require_admin();
    }

    public function index() {
        $data['page_title'] = 'Admin Dashboard';
        
        // Get dashboard statistics
        $data['total_products'] = $this->Product_model->count_active_products();
        $data['total_transactions'] = $this->Transaction_model->count_transactions();
        $data['today_transactions'] = $this->Transaction_model->count_transactions_by_date(date('Y-m-d'));
        $data['total_users'] = $this->User_model->count_users();
        
        // Get today's sales summary
        $data['today_summary'] = $this->Transaction_model->get_daily_summary(date('Y-m-d'));
        
        // Get low stock products
        $data['low_stock_products'] = $this->Product_model->get_low_stock_products(5);
        
        // Get recent transactions
        $data['recent_transactions'] = $this->Transaction_model->get_all_transactions(5, 0);
        
        // Get monthly statistics
        $current_year = date('Y');
        $current_month = date('m');
        $data['monthly_stats'] = array(
            'total_sales' => $this->Transaction_model->get_monthly_sales($current_year, $current_month),
            'total_transactions' => $this->Transaction_model->count_transactions_by_month($current_year, $current_month),
            'avg_transaction' => $this->Transaction_model->get_average_transaction_amount($current_year, $current_month)
        );
        
        $this->load->view('admin/dashboard_view', $data);
    }

    // ========== USER MANAGEMENT ==========
    
    public function users() {
        $data['page_title'] = 'Manajemen User';
        $data['users'] = $this->User_model->get_all_users();
        
        $this->load->view('admin/users_view', $data);
    }

    public function edit_user($id) {
        $data['page_title'] = 'Edit User';
        $data['user'] = $this->User_model->get_user_by_id($id);
        
        if (!$data['user']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[user,admin]');
            
            if ($this->form_validation->run()) {
                $update_data = array(
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'full_name' => $this->input->post('full_name', TRUE),
                    'phone' => $this->input->post('phone', TRUE),
                    'role' => $this->input->post('role', TRUE),
                    'status' => $this->input->post('status', TRUE)
                );
                
                if ($this->User_model->update_user($id, $update_data)) {
                    $this->session->set_flashdata('success', 'User berhasil diupdate!');
                    redirect('admin/users');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate user!');
                }
            }
        }
        
        $this->load->view('admin/edit_user_view', $data);
    }

    public function delete_user($id) {
        // Prevent admin from deleting themselves
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun sendiri!');
            redirect('admin/users');
        }
        
        $user = $this->User_model->get_user_by_id($id);
        if (!$user) {
            show_404();
        }
        
        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user!');
        }
        
        redirect('admin/users');
    }

    // ========== PRODUCTS MANAGEMENT ==========
    
    public function products() {
        $data['page_title'] = 'Manajemen Produk';
        $data['products'] = $this->Product_model->get_all_products();
        $data['categories'] = $this->Product_model->get_all_categories();
        
        $this->load->view('admin/products_view', $data);
    }

    public function add_product() {
        $data['page_title'] = 'Tambah Produk';
        $data['categories'] = $this->Product_model->get_all_categories();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama Produk', 'required|max_length[200]');
            $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
            $this->form_validation->set_rules('stock', 'Stok', 'required|integer');
            $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
            
            if ($this->form_validation->run()) {
                $product_data = array(
                    'name' => $this->input->post('name', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'price' => $this->input->post('price', TRUE),
                    'stock' => $this->input->post('stock', TRUE),
                    'category_id' => $this->input->post('category_id', TRUE),
                    'status' => $this->input->post('status', TRUE)
                );
                
                if ($this->Product_model->insert_product($product_data)) {
                    $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
                    redirect('admin/products');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan produk!');
                }
            }
        }
        
        $this->load->view('admin/add_product_view', $data);
    }

    public function edit_product($id) {
        $data['page_title'] = 'Edit Produk';
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $data['categories'] = $this->Product_model->get_all_categories();
        
        if (!$data['product']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama Produk', 'required|max_length[200]');
            $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
            $this->form_validation->set_rules('stock', 'Stok', 'required|integer');
            $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
            
            if ($this->form_validation->run()) {
                $product_data = array(
                    'name' => $this->input->post('name', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'price' => $this->input->post('price', TRUE),
                    'stock' => $this->input->post('stock', TRUE),
                    'category_id' => $this->input->post('category_id', TRUE),
                    'status' => $this->input->post('status', TRUE)
                );
                
                if ($this->Product_model->update_product($id, $product_data)) {
                    $this->session->set_flashdata('success', 'Produk berhasil diupdate!');
                    redirect('admin/products');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate produk!');
                }
            }
        }
        
        $this->load->view('admin/edit_product_view', $data);
    }

    public function delete_product($id) {
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) {
            show_404();
        }
        
        if ($this->Product_model->delete_product($id)) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk!');
        }
        
        redirect('admin/products');
    }

    // ========== CATEGORIES MANAGEMENT ==========
    
    public function categories() {
        $data['page_title'] = 'Manajemen Kategori';
        $data['categories'] = $this->Product_model->get_all_categories();
        
        $this->load->view('admin/categories_view', $data);
    }

    public function add_category() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama Kategori', 'required|max_length[100]');
            
            if ($this->form_validation->run()) {
                $category_data = array(
                    'name' => $this->input->post('name', TRUE),
                    'description' => $this->input->post('description', TRUE)
                );
                
                if ($this->Product_model->insert_category($category_data)) {
                    $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan kategori!');
                }
            }
        }
        
        redirect('admin/categories');
    }

    // ========== TRANSACTIONS MANAGEMENT ==========
    
    public function transactions() {
        $data['page_title'] = 'Riwayat Transaksi';
        $data['transactions'] = $this->Transaction_model->get_all_transactions();
        
        $this->load->view('admin/transactions_view', $data);
    }

    public function add_transaction() {
        $data['page_title'] = 'Input Transaksi';
        $data['products'] = $this->Product_model->get_active_products();
        $data['transaction_code'] = $this->Transaction_model->generate_transaction_code();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('customer_name', 'Nama Customer', 'required|max_length[100]');
            $this->form_validation->set_rules('payment_method', 'Metode Pembayaran', 'required');
            
            if ($this->form_validation->run()) {
                $this->db->trans_start();
                
                // Insert transaction
                $transaction_data = array(
                    'transaction_code' => $this->input->post('transaction_code', TRUE),
                    'customer_name' => $this->input->post('customer_name', TRUE),
                    'customer_phone' => $this->input->post('customer_phone', TRUE),
                    'customer_email' => $this->input->post('customer_email', TRUE),
                    'total_amount' => $this->input->post('total_amount', TRUE),
                    'payment_method' => $this->input->post('payment_method', TRUE),
                    'payment_status' => $this->input->post('payment_status', TRUE),
                    'notes' => $this->input->post('notes', TRUE),
                    'transaction_date' => date('Y-m-d'),
                    'created_by' => $this->session->userdata('user_id')
                );
                
                $transaction_id = $this->Transaction_model->insert_transaction($transaction_data);
                
                if ($transaction_id) {
                    // Insert transaction items
                    $products = $this->input->post('products');
                    $quantities = $this->input->post('quantities');
                    $prices = $this->input->post('prices');
                    
                    if ($products && $quantities && $prices) {
                        for ($i = 0; $i < count($products); $i++) {
                            if ($products[$i] && $quantities[$i] && $prices[$i]) {
                                $product = $this->Product_model->get_product_by_id($products[$i]);
                                
                                $item_data = array(
                                    'transaction_id' => $transaction_id,
                                    'product_id' => $products[$i],
                                    'product_name' => $product['name'],
                                    'price' => $prices[$i],
                                    'quantity' => $quantities[$i],
                                    'subtotal' => $prices[$i] * $quantities[$i]
                                );
                                
                                $this->Transaction_model->insert_transaction_item($item_data);
                                
                                // Update stock
                                $this->Product_model->update_stock($products[$i], $quantities[$i]);
                            }
                        }
                    }
                    
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        $this->session->set_flashdata('error', 'Gagal menyimpan transaksi!');
                    } else {
                        $this->session->set_flashdata('success', 'Transaksi berhasil disimpan!');
                        redirect('admin/transactions');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal menyimpan transaksi!');
                }
            }
        }
        
        $this->load->view('admin/add_transaction_view', $data);
    }

    public function view_transaction($id) {
        $data['page_title'] = 'Detail Transaksi';
        $data['transaction'] = $this->Transaction_model->get_transaction_by_id($id);
        $data['transaction_items'] = $this->Transaction_model->get_transaction_items($id);
        
        if (!$data['transaction']) {
            show_404();
        }
        
        $this->load->view('admin/view_transaction_view', $data);
    }

    // ========== REPORTS ==========
    
    public function reports() {
        $data['page_title'] = 'Laporan Penjualan';
        
        $date = $this->input->get('date') ? $this->input->get('date') : date('Y-m-d');
        $data['selected_date'] = $date;
        
        // Daily summary
        $data['daily_summary'] = $this->Transaction_model->get_daily_summary($date);
        
        // Daily transactions
        $data['daily_transactions'] = $this->Transaction_model->get_transactions_by_date($date);
        
        // Payment method stats
        $data['payment_stats'] = $this->Transaction_model->get_payment_method_stats($date, $date);
        
        // Top selling products
        $data['top_products'] = $this->Transaction_model->get_top_selling_products($date, $date, 5);
        
        $this->load->view('admin/reports_view', $data);
    }

    public function export_report() {
        $date = $this->input->get('date') ? $this->input->get('date') : date('Y-m-d');
        
        $transactions = $this->Transaction_model->get_transactions_by_date($date);
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="laporan_penjualan_' . $date . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // CSV headers
        fputcsv($output, array(
            'Kode Transaksi',
            'Nama Customer',
            'Total Amount',
            'Metode Pembayaran',
            'Status',
            'Tanggal'
        ));
        
        // CSV data
        foreach ($transactions as $transaction) {
            fputcsv($output, array(
                $transaction['transaction_code'],
                $transaction['customer_name'],
                'Rp ' . number_format($transaction['total_amount'], 0, ',', '.'),
                ucfirst($transaction['payment_method']),
                ucfirst($transaction['payment_status']),
                $transaction['transaction_date']
            ));
        }
        
        fclose($output);
    }
}
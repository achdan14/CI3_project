<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 * 
 * @property CI_Session $session
 * @property User_model $User_model
 * @property Product_model $Product_model
 * @property Transaction_model $Transaction_model
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $this->load->model('Transaction_model');
        $this->load->helper('auth');
        
        // Cek apakah user sudah login
        require_login();
        
        // Cek apakah user adalah admin, jika ya redirect ke admin dashboard
        if (is_admin()) {
            redirect('admin');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        
        $data['user'] = get_user_data();
        $data['page_title'] = 'Dashboard User';
        
        // Get user statistics
        $data['total_products'] = $this->Product_model->count_active_products();
        $data['user_transactions'] = $this->Transaction_model->get_transactions_by_user($user_id, 5);
        $data['recent_products'] = $this->Product_model->get_recent_products(6);
        
        // Get user activity summary
        $data['user_stats'] = array(
            'total_transactions' => $this->Transaction_model->count_transactions_by_user($user_id),
            'this_month_transactions' => $this->Transaction_model->count_transactions_by_user_date($user_id, date('Y-m')),
            'total_spent' => $this->Transaction_model->get_total_spent_by_user($user_id)
        );
        
        $this->load->view('user/dashboard_view', $data);
    }

    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['page_title'] = 'Profil Saya';
        
        $this->load->view('user/profile_view', $data);
    }

    public function edit_profile() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['page_title'] = 'Edit Profil';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|max_length[100]');
            $this->form_validation->set_rules('phone', 'Nomor Telepon', 'max_length[15]');
            
            if ($this->form_validation->run()) {
                $update_data = array(
                    'username' => $this->input->post('username', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'full_name' => $this->input->post('full_name', TRUE),
                    'phone' => $this->input->post('phone', TRUE),
                    'address' => $this->input->post('address', TRUE)
                );
                
                if ($this->User_model->update_user($user_id, $update_data)) {
                    // Update session data
                    $this->session->set_userdata('username', $update_data['username']);
                    $this->session->set_userdata('email', $update_data['email']);
                    
                    $this->session->set_flashdata('success', 'Profil berhasil diupdate!');
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate profil!');
                }
            }
        }
        
        $this->load->view('user/edit_profile_view', $data);
    }

    public function change_password() {
        $data['page_title'] = 'Ganti Password';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');
            
            if ($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                $user = $this->User_model->get_user_by_id($user_id);
                
                if (password_verify($this->input->post('current_password'), $user['password'])) {
                    $update_data = array(
                        'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT)
                    );
                    
                    if ($this->User_model->update_user($user_id, $update_data)) {
                        $this->session->set_flashdata('success', 'Password berhasil diubah!');
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengubah password!');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password saat ini salah!');
                }
            }
        }
        
        $this->load->view('user/change_password_view', $data);
    }

    public function my_transactions() {
        $user_id = $this->session->userdata('user_id');
        $data['page_title'] = 'Riwayat Transaksi Saya';
        $data['transactions'] = $this->Transaction_model->get_transactions_by_user($user_id);
        
        $this->load->view('user/my_transactions_view', $data);
    }

    public function view_transaction($id) {
        $user_id = $this->session->userdata('user_id');
        $data['page_title'] = 'Detail Transaksi';
        $data['transaction'] = $this->Transaction_model->get_transaction_by_id($id);
        $data['transaction_items'] = $this->Transaction_model->get_transaction_items($id);
        
        // Cek apakah transaksi milik user ini
        if (!$data['transaction'] || $data['transaction']['created_by'] != $user_id) {
            show_404();
        }
        
        $this->load->view('user/view_transaction_view', $data);
    }

    public function products() {
        $data['page_title'] = 'Katalog Produk';
        $data['products'] = $this->Product_model->get_active_products();
        $data['categories'] = $this->Product_model->get_all_categories();
        
        $this->load->view('user/products_view', $data);
    }

    public function product_detail($id) {
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $data['page_title'] = $data['product'] ? $data['product']['name'] : 'Detail Produk';
        
        if (!$data['product'] || $data['product']['status'] != 'active') {
            show_404();
        }
        
        $this->load->view('user/product_detail_view', $data);
    }
} 
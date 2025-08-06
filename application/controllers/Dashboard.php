<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 * 
 * @property CI_Session $session
 * @property User_model $User_model
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index() {
        $data['user'] = array(
            'id' => $this->session->userdata('user_id'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email')
        );
        
        $this->load->view('dashboard_view', $data);
    }

    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        $this->load->view('profile_view', $data);
    }

    public function users() {
        // Hanya untuk admin (contoh sederhana)
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users_view', $data);
    }
} 
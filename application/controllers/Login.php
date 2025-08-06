<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller
 * 
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property User_model $User_model
 * @property CI_Session $session
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('security');
    }

    public function index() {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('login_view');
    }

    public function authenticate() {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            // Cek user di database
            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil
                $session_data = array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                
                redirect('dashboard');
            } else {
                // Login gagal
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
} 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication Helper
 * Helper untuk menangani autentikasi dan kontrol akses
 */

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $CI =& get_instance();
        return $CI->session->userdata('logged_in') === TRUE;
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        $CI =& get_instance();
        if (!is_logged_in()) {
            return FALSE;
        }
        
        $user_id = $CI->session->userdata('user_id');
        $CI->load->model('User_model');
        return $CI->User_model->is_admin($user_id);
    }
}

if (!function_exists('require_login')) {
    function require_login() {
        if (!is_logged_in()) {
            redirect('login');
        }
    }
}

if (!function_exists('require_admin')) {
    function require_admin() {
        require_login();
        if (!is_admin()) {
            $CI =& get_instance();
            $CI->session->set_flashdata('error', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('dashboard');
        }
    }
}

if (!function_exists('get_user_role')) {
    function get_user_role() {
        $CI =& get_instance();
        if (!is_logged_in()) {
            return 'guest';
        }
        
        $user_id = $CI->session->userdata('user_id');
        $CI->load->model('User_model');
        return $CI->User_model->get_user_role($user_id);
    }
}

if (!function_exists('get_user_data')) {
    function get_user_data() {
        $CI =& get_instance();
        if (!is_logged_in()) {
            return NULL;
        }
        
        $user_id = $CI->session->userdata('user_id');
        $CI->load->model('User_model');
        return $CI->User_model->get_user_by_id($user_id);
    }
} 
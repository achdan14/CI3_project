<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function is_admin($user_id) {
        $this->db->where('id', $user_id);
        $this->db->where('role', 'admin');
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function get_user_role($user_id) {
        $this->db->select('role');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        $result = $query->row_array();
        return $result ? $result['role'] : 'user';
    }

    public function update_user_role($user_id, $role) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', array('role' => $role));
    }
}

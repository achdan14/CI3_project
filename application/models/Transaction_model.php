<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    public function get_all_transactions($limit = null, $offset = null) {
        $this->db->select('transactions.*, users.username as created_by_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.created_by', 'left');
        $this->db->order_by('transactions.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaction_by_id($id) {
        $this->db->select('transactions.*, users.username as created_by_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.created_by', 'left');
        $this->db->where('transactions.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_transaction_by_code($code) {
        $this->db->where('transaction_code', $code);
        $query = $this->db->get('transactions');
        return $query->row_array();
    }

    public function get_transactions_by_date($date) {
        $this->db->select('transactions.*, users.username as created_by_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.created_by', 'left');
        $this->db->where('transactions.transaction_date', $date);
        $this->db->order_by('transactions.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transactions_by_date_range($start_date, $end_date) {
        $this->db->select('transactions.*, users.username as created_by_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.created_by', 'left');
        $this->db->where('transactions.transaction_date >=', $start_date);
        $this->db->where('transactions.transaction_date <=', $end_date);
        $this->db->order_by('transactions.transaction_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_transaction($data) {
        $this->db->trans_start();
        
        $result = $this->db->insert('transactions', $data);
        $transaction_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        
        return $transaction_id;
    }

    public function update_transaction($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('transactions', $data);
    }

    public function delete_transaction($id) {
        $this->db->trans_start();
        
        // Delete transaction items first
        $this->db->where('transaction_id', $id);
        $this->db->delete('transaction_items');
        
        // Delete transaction
        $this->db->where('id', $id);
        $this->db->delete('transactions');
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    public function count_transactions() {
        return $this->db->count_all('transactions');
    }

    public function count_transactions_by_date($date) {
        $this->db->where('transaction_date', $date);
        return $this->db->count_all_results('transactions');
    }

    // Transaction Items
    public function get_transaction_items($transaction_id) {
        $this->db->where('transaction_id', $transaction_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('transaction_items');
        return $query->result_array();
    }

    public function insert_transaction_item($data) {
        return $this->db->insert('transaction_items', $data);
    }

    public function delete_transaction_items($transaction_id) {
        $this->db->where('transaction_id', $transaction_id);
        return $this->db->delete('transaction_items');
    }

    // Generate transaction code
    public function generate_transaction_code() {
        $today = date('Ymd');
        $this->db->like('transaction_code', 'TRX' . $today, 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('transactions');
        
        if ($query->num_rows() > 0) {
            $last_transaction = $query->row_array();
            $last_code = $last_transaction['transaction_code'];
            $last_number = (int)substr($last_code, -3);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        
        return 'TRX' . $today . sprintf('%03d', $new_number);
    }

    // Reports
    public function get_daily_sales_report($date) {
        $this->db->select('
            COUNT(*) as total_transactions,
            SUM(total_amount) as total_sales,
            AVG(total_amount) as average_sales,
            payment_method,
            payment_status
        ');
        $this->db->where('transaction_date', $date);
        $this->db->group_by('payment_method, payment_status');
        $query = $this->db->get('transactions');
        return $query->result_array();
    }

    public function get_daily_summary($date) {
        $this->db->select('
            COUNT(*) as total_transactions,
            SUM(CASE WHEN payment_status = "paid" THEN total_amount ELSE 0 END) as total_sales,
            SUM(CASE WHEN payment_status = "pending" THEN total_amount ELSE 0 END) as pending_amount,
            SUM(CASE WHEN payment_status = "failed" THEN total_amount ELSE 0 END) as failed_amount
        ');
        $this->db->where('transaction_date', $date);
        $query = $this->db->get('transactions');
        return $query->row_array();
    }

    public function get_top_selling_products($start_date, $end_date, $limit = 10) {
        $this->db->select('
            transaction_items.product_name,
            SUM(transaction_items.quantity) as total_quantity,
            SUM(transaction_items.subtotal) as total_revenue,
            COUNT(DISTINCT transaction_items.transaction_id) as transaction_count
        ');
        $this->db->from('transaction_items');
        $this->db->join('transactions', 'transactions.id = transaction_items.transaction_id');
        $this->db->where('transactions.transaction_date >=', $start_date);
        $this->db->where('transactions.transaction_date <=', $end_date);
        $this->db->where('transactions.payment_status', 'paid');
        $this->db->group_by('transaction_items.product_name');
        $this->db->order_by('total_quantity', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_payment_method_stats($start_date, $end_date) {
        $this->db->select('
            payment_method,
            COUNT(*) as transaction_count,
            SUM(CASE WHEN payment_status = "paid" THEN total_amount ELSE 0 END) as total_amount
        ');
        $this->db->where('transaction_date >=', $start_date);
        $this->db->where('transaction_date <=', $end_date);
        $this->db->group_by('payment_method');
        $this->db->order_by('total_amount', 'DESC');
        $query = $this->db->get('transactions');
        return $query->result_array();
    }

    // User-specific transaction methods
    public function get_transactions_by_user($user_id, $limit = null, $offset = null) {
        $this->db->select('transactions.*, users.username as created_by_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.created_by', 'left');
        $this->db->where('transactions.created_by', $user_id);
        $this->db->order_by('transactions.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_transactions_by_user($user_id) {
        $this->db->where('created_by', $user_id);
        return $this->db->count_all_results('transactions');
    }

    public function count_transactions_by_user_date($user_id, $date) {
        $this->db->where('created_by', $user_id);
        $this->db->where('transaction_date', $date);
        return $this->db->count_all_results('transactions');
    }

    public function get_total_spent_by_user($user_id) {
        $this->db->select('SUM(total_amount) as total_spent');
        $this->db->where('created_by', $user_id);
        $this->db->where('payment_status', 'paid');
        $query = $this->db->get('transactions');
        $result = $query->row_array();
        return $result ? $result['total_spent'] : 0;
    }

    public function count_transactions_by_month($year, $month) {
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('MONTH(transaction_date)', $month);
        return $this->db->count_all_results('transactions');
    }

    public function get_average_transaction_amount($year = null, $month = null) {
        $this->db->select('AVG(total_amount) as average_amount');
        
        if ($year && $month) {
            $this->db->where('YEAR(transaction_date)', $year);
            $this->db->where('MONTH(transaction_date)', $month);
        }
        
        $query = $this->db->get('transactions');
        $result = $query->row_array();
        return $result ? $result['average_amount'] : 0;
    }

    // Updated get_monthly_sales method to accept year and month parameters
    public function get_monthly_sales($year, $month) {
        $this->db->select('
            DATE(transaction_date) as date,
            COUNT(*) as total_transactions,
            SUM(CASE WHEN payment_status = "paid" THEN total_amount ELSE 0 END) as total_sales
        ');
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('MONTH(transaction_date)', $month);
        $this->db->group_by('DATE(transaction_date)');
        $this->db->order_by('DATE(transaction_date)', 'ASC');
        $query = $this->db->get('transactions');
        return $query->result_array();
    }
}
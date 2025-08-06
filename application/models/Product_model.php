<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_all_products($limit = null, $offset = null) {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->order_by('products.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_product_by_id($id) {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_products_by_category($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->where('status', 'active');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function get_active_products() {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.status', 'active');
        $this->db->where('products.stock >', 0);
        $this->db->order_by('products.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    public function update_product($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function count_products() {
        return $this->db->count_all('products');
    }

    public function count_active_products() {
        $this->db->where('status', 'active');
        return $this->db->count_all_results('products');
    }

    public function update_stock($product_id, $quantity) {
        $this->db->set('stock', 'stock - ' . (int)$quantity, FALSE);
        $this->db->where('id', $product_id);
        return $this->db->update('products');
    }

    public function search_products($keyword) {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->like('products.name', $keyword);
        $this->db->or_like('products.description', $keyword);
        $this->db->order_by('products.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Category methods
    public function get_all_categories() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_category_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->row_array();
    }

    public function insert_category($data) {
        return $this->db->insert('categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function delete_category($id) {
        // Set products to no category before deleting
        $this->db->set('category_id', NULL);
        $this->db->where('category_id', $id);
        $this->db->update('products');
        
        // Delete category
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }

    public function get_low_stock_products($threshold = 5) {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.stock <=', $threshold);
        $this->db->where('products.status', 'active');
        $this->db->order_by('products.stock', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
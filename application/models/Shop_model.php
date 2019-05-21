<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends CI_Model {

	
    public function getProductsByCategory($category)
    {
		$this->db->select('*');
        $this->db->from('category_products');
		$this->db->join('categories', 'category_products.id_category = categories.id', 'left');
		$this->db->join('products', 'category_products.id_product = products.id', 'left');
		
        $query = $this->db->get()->result(); 

        return $query; 
	}

	public function getCategories()
	{
		$query = $this->db->get('categories')->result();
		return $query;	
	}
		
}

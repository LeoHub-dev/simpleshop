<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends CI_Model {

	public function getCategories()
	{
		$query = $this->db->get('categories')->result();
		return $query;	
	}

	public function endShopping()
	{
		$shopping_cart = $this->Cart_model->getShoppingCart();
		$total = 0;
		foreach ($shopping_cart as $item) {
			$total+= $item->price * $item->qty;
		}
		$order = array('content' => json_encode($shopping_cart), 'total' => $total);
		$query = $this->db->insert('orders', $order); 
		if($query){
			$this->db->empty_table('cart');
		}
		return $query;
	}
		
	public function createProduct()
    {
        $query = $this->db->insert('products', $this); 

        return $query;   
	}
}

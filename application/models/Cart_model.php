<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function getShoppingCart()
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->join('products', 'cart.id_product = products.id', 'left');

		$query = $this->db->get()->result();

		$total = 0;

		foreach ($query as $item) {
			$total+= $item->price * $item->qty;
		}

		return array('items' => $query, 'total' => $total);
	}

	public function productIsAdded($id)
	{
		$this->db->where('id_product', $id);
		$query = $this->db->get('cart')->result();
		return $query;
	}

	public function addProductToCart($id, $qty)
	{
		if ($query = $this->productIsAdded($id)) {
			var_dump($query);
			$this->db->set('qty', $query[0]->qty + $qty);
			$this->db->where('id', $query[0]->id);
			$this->db->update('cart');
			return;
		} else {

			$product = $this->Product_model->getProduct($id);
			if (!$product) {
				return null;
			}

			$this->db->insert('cart', ['id_product' => $id, 'qty' => $qty]);

			return $product;
		}
	}
}

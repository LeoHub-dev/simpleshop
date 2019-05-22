<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('shop/index');
	}

	public function getProducts($category = null)
	{
		if($category != null)
		{
			echo json_encode($this->Product_model->getProductsByCategory($category));
		}
		else
		{
			echo json_encode($this->Product_model->getProducts());
		}
	}

	public function getCategories()
	{
		echo json_encode($this->Shop_model->getCategories());
	}

	public function getShoppingCart()
	{
		echo json_encode($this->Cart_model->getShoppingCart());
	}

	public function addToCart($id,$qty)
	{
		echo json_encode($this->Cart_model->addProductToCart($id, $qty));
	}

	public function endShopping()
	{
		$this->Shop_model->endShopping();
	}
}

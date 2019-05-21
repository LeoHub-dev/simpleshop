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

	public function getProducts()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			echo json_encode($this->Product_model->getProductsByCategory($this->input->post('category')));
		}
		else
		{
			echo json_encode($this->Product_model->getProducts());
		}
	}
}

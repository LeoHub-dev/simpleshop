<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	public $name;
	public $image;
    public $description;
    public $price;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}
	
	/**
	 * Get the value of name
	 */ 
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */ 
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of image
	 */ 
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Set the value of image
	 *
	 * @return  self
	 */ 
	public function setImage($image)
	{
		$this->image = $image;

		return $this;
	}

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function createProduct()
    {
        $query = $this->db->insert('products',$this); 

        return $query;   
	}
	
	public function getProducts()
	{
        $query = $this->db->get('auth_users')->get()->result();
        
		return $query;   
	}
	
	public function getProductsByCategory($category)
    {
		$this->db->select('*');
		$this->db->where('id_category',$category);
        $this->db->from('category_products');
		$this->db->join('categories', 'category_products.id_category = categories.id', 'left');
		$this->db->join('products', 'category_products.id_product = products.id', 'left');
		
        $query = $this->db->get()->result(); 

        return $query; 
	}
	
	public function getProduct($id)
	{
        $query = $this->db->get('auth_users', $id)->get()->result();
        
		return $query;   
    }
    
    public function updateProduct($data)
    {
		$update = $this->db->update('auth_users', $data, $data['id']);
		
		if($update){
			return TRUE;
		}
		else{
			return FALSE;
		}
    }

	public function isLoggedIn(){
		
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $is_logged_in = $this->session->userdata('logged_in');

        if(!isset($is_logged_in) || $is_logged_in!==TRUE)
        {
            return FALSE;
        }

        return TRUE;
    }






	
}

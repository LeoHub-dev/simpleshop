<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends CI_Model {

	public function getCategories()
	{
		$query = $this->db->get('categories')->result();
		return $query;	
	}
		
}

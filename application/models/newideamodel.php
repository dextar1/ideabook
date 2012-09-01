<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newideamodel extends CI_Model  {

	public function getCategories()
	{
		$result = $this->db->query('SELECT * FROM category');
		if ($result->num_rows() > 0)
		{
			return $result->result();
		} else {
			return false;
		}
	}
}

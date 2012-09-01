<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class newideamodel extends CI_Model  {

	public function getCategories()
	{
		$result = $this->db->query('SELECT * FROM category');
		if ($result->num_rows() > 0)
		{
			return $result->result('array');
		} else {
			return false;
		}
	}
	public function addIdea($data){
		$query = $this->db->insert_string('ideas',$data);
		return $this->db->query($query);
	}
}

<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewideasmodel extends CI_Model  {

	public function getIdeas()
	{
		$result = $this->db->query('SELECT * FROM ideas');
		if ($result->num_rows() > 0)
		{
			return $result->result('array');
		} else {
			return false;
		}
	}
}

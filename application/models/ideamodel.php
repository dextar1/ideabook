<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ideamodel extends CI_Model  {

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
	
	public function getSearchResult($query, $limit, $start) {

		$query = '%'.$query.'%';
		$sql = "SELECT * FROM ideas WHERE tag LIKE ? OR title LIKE ? OR keywords LIKE ? LIMIT ?, ?"; 
		$result = $this->db->query($sql, array($query,$query,$query,$start,$limit));
		
		if ($result->num_rows() > 0) {
			return $result->result_array();
		} else {
			return false;
		}
	}
	
	public function countSearchResult($query) {
 		$query = '%'.$query.'%';
		$sql = "SELECT * FROM ideas WHERE tag LIKE ? OR title LIKE ? OR keywords LIKE ?"; 
		$result = $this->db->query($sql, array($query,$query,$query));
		if ($result->num_rows() > 0) {
			return $result->num_rows();
		} else {
			return 0;
		} 
	}
	
}

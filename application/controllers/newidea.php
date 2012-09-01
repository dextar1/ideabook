<?php 

class Newidea extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	//
	//
	
	public function index()
	{
		$data = array();
		$data['categories'] = '';
		$this->load->model('newideamodel');
		$categories = $this->newideamodel->getCategories();
		echo '<pre>';
		var_dump($categories);
		echo '</pre>';
		foreach($categories as $category){
			$data['categories'][] = array(
				'title' => $category->title,
				'id' => $category->id
			);
		}
		$data['working'] = 'it works :)';
		$this->load->view('newidea',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
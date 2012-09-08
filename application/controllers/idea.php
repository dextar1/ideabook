<?php 

class Idea extends CI_Controller {

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
		redirect('idea/search');
	}
	public function search() {
		$data = $this->authentication->giveMeHeaderData();
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = false;
		$this->load->view('layout/header',$data);
		$this->load->view('home');
		$this->load->view('layout/footer',$data);
	}
	public function addIdea(){
		$this->load->model('ideamodel');
		$data = array();
		//print_r($this->input->post());
		if($this->input->post('submit')){
			$formdata['title'] = $this->input->post('newidea_title');
			$formdata['description'] = $this->input->post('newidea_idea');
			$formdata['category_id'] = $this->input->post('newidea_category');
			$formdata['keywords'] = $this->input->post('newidea_keywords');
			$formdata['tags'] = $this->input->post('newidea_tags');
			
			if($this->ideamodel->addIdea($formdata)){
				$data['inserted'] = 'idea inserted';
			} else {
				$data['error'] = 'idea NOT inserted';
			}
			$data['categories'] = $this->ideamodel->getCategories();
			$this->load->view('idea',$data);
		}
	}
	public function viewIdeas(){
		$data = array();
		$this->load->model('ideamodel');
		$data['ideas'] = $this->ideamodel->getideas();

		$this->load->view('viewideas',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
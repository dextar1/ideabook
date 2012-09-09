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

   public function __construct()
   {
		parent::__construct();
		$this->load->model('ideamodel');
   }
	public function index()
	{
		redirect('idea/search');
	}

	public function search($q = '') {
	if($q == '') {
		$data = $this->authentication->giveMeHeaderData();
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = false;
		$data['actionURL'] = site_url('idea/search');
		$this->load->view('layout/header',$data);
		$this->load->view('home');
		$this->load->view('layout/footer',$data);
	} else {
		$this->load->model('ideamodel');
		$data = $this->authentication->giveMeHeaderData();
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = true;
		$query = $q;
		$config['base_url'] = site_url('idea/search').'/'.$query;
		$config['total_rows'] = $this->ideamodel->countSearchResult($query);
		$config['per_page'] = 3;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['queryResult'] = $this->ideamodel->getSearchResult($query,$config['per_page'],intval($page));
		$data["links"] = $this->pagination->create_links();
		$data["value"] = $query;
		$this->load->view('layout/header',$data);
		$this->load->view('search_result',$data);
		$this->load->view('layout/footer',$data);
	}
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
	public function show() {
		$data = $this->authentication->giveMeHeaderData();
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = false;
		$this->load->view('layout/header',$data);
		$data['searchQuery'] = $this->input->post('q');
		$this->load->view('result',$data);
		$this->load->view('layout/footer',$data);
	
	public function searchResult() {
		$this->load->model('ideamodel');
		$data = $this->authentication->giveMeHeaderData();
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = true;
		$query = trim($this->input->get('q'));
		$config['base_url'] = site_url().'/'.$this->router->fetch_class().'/'.$this->router->fetch_method();
		$config['total_rows'] = $this->ideamodel->countSearchResult($query);
		$config['per_page'] = 3;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void();">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
		$data['queryResult'] = $this->ideamodel->getSearchResult($query,$config['per_page'],$page);
		$data["links"] = $this->pagination->create_links();
		$this->load->view('layout/header',$data);
		$this->load->view('search_result',$data);
		$this->load->view('layout/footer',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
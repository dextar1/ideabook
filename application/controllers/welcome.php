<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	
	private $isLoggedIn = 'no';
	public function index()
	{
		
		// Login or logout url will be needed depending on current user state.
		if ($this->authentication->is_logged_in()) {
			$params = array( 'next' => 'http://localhost/ideabook/index.php/welcome/killsession' );
			$prof = $this->facebook->api('/me');  
			$data['url'] = '<a href="'.$this->facebook->getLogoutUrl($params).'">Logout</a>';
			$user_prof = $this->facebook->api('/me');
			$data['user_name'] = '<li><a>'.$prof['name'].'</a></li>';
		} else {
		  $data['url'] = '<a href="'.$this->facebook->getLoginUrl().'">Login</a>';
		$data['user_name'] = '';
		}
		$data['appID'] = $this->facebook->getAppID();
		$data['search'] = false;
		$this->load->view('layout/header',$data);
		$this->load->view('home');
		$data['appId'] = $this->facebook->getAppId();
		$this->load->view('layout/footer',$data);
	}
	public function killsession() {
		$this->facebook->destroySession();
		redirect('welcome');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
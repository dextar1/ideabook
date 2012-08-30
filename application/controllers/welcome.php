<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('FACEBOOK_APP_ID', '311371812294772');
define('FACEBOOK_SECRET', '22e9fdb7a5005ac0c7c07c332cf741d4');
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
	
	//
	//

	function parse_signed_request($signed_request, $secret) {
	  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

	  // decode the data
	  $sig = $this->base64_url_decode($encoded_sig);
	  $data = json_decode($this->base64_url_decode($payload), true);

	  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
	    error_log('Unknown algorithm. Expected HMAC-SHA256');
	    return null;
	  }

	  // check sig
	  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	  if ($sig !== $expected_sig) {
	    error_log('Bad Signed JSON signature!');
	    return null;
	  }

	  return $data;
	}

	function base64_url_decode($input) {
	    return base64_decode(strtr($input, '-_', '+/'));
	}
	
	public function index()
	{
		$data['baseUrl'] = base_url();
		$this->load->view('layout/header',$data);
		$this->load->view('welcome_message');
		$this->load->view('layout/footer');
	}
	
	public function action($action = '') {
		if($action == "receivefb") {
			$data['baseUrl'] = base_url();
			$this->load->view('layout/header',$data);
			if ($_REQUEST) {
			  echo '<p>signed_request contents:</p>';
			  $response = $this->parse_signed_request($_REQUEST['signed_request'], 
			                                   FACEBOOK_SECRET);
			  echo '<pre>';
			  $sdata['resp'] = $response;
				$this->load->view($action,$sdata);
			  echo '</pre>';
			} else {
			  echo '$_REQUEST is empty';
			}
		} else {
		$data['baseUrl'] = base_url();
		$this->load->view('layout/header',$data);
		$this->load->view($action);
		$this->load->view('layout/footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
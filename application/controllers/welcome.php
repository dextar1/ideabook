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
	function __construct()
	    {
	        parent::__construct();
	    }
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
		$fb_config = array(
		            'appId'  => FACEBOOK_APP_ID,
		            'secret' => FACEBOOK_SECRET
		        );

		        $this->load->library('facebook', $fb_config);
		$user = $this->facebook->getUser();
		$data['baseUrl'] = base_url();
		
		if($this->authentication->is_logged_in()) {
			redirect('dashboard');
		}
		$this->load->view('layout/header');
		

		        if ($user) {
		            try {
		                $data['user_profile'] = $this->facebook->api('/me');
										if(!$this->authentication->is_logged_in()) {
											
											$this->session->set_userdata('fb_id',$user);
											
										}
										redirect('dashboard');
		            } catch (FacebookApiException $e) {
		                $user = null;
		            }
		        }

		        if ($user) {
		            $data['logout_url'] = $this->facebook->getLogoutUrl();
		        } else {
		            $data['login_url'] = $this->facebook->getLoginUrl();
		        }
		$data['completeURL'] = site_url("welcome/action/register");
		$this->load->view('welcome_message',$data);
		$this->load->view('layout/footer');
	}
	
	public function action($action = '') {
		if($action == "logout") {
			$fb_config = array(
			            'appId'  => FACEBOOK_APP_ID,
			            'secret' => FACEBOOK_SECRET
			        );

			        $this->load->library('facebook', $fb_config);
			$this->facebook->destroySession();
			$this->session->unset_userdata('fb_id');
			redirect('welcome');
		} 
		elseif($action == "receivefb") {
			$data['baseUrl'] = base_url();
			$this->load->view('layout/header');
			if ($_REQUEST) {
			  //echo '<p>signed_request contents:</p>';
			
			  $response = $this->parse_signed_request($_REQUEST['signed_request'], 
			                                   FACEBOOK_SECRET);
			$query = $this->db->get_where('users', array('fb_uid' => $response['user_id']));
			if($query->num_rows() > 0) {
				//echo 'you are already registered.';
				redirect('welcome');
			}
				$dataToInsert = array('name'=>$response['registration']['name'],
															'email'=>$response['registration']['email'],
															'gender'=>$response['registration']['gender'],
															'birthday'=>$response['registration']['birthday'],
															'location'=>$response['registration']['location']['name'],
															'fb_uid'=>$response['user_id']);
				//echo "<pre>";
				//print_r($response);
				//echo "</pre>";
				$this->db->insert('users',$dataToInsert);
				if($this->db->affected_rows() > 0) {
					redirect('welcome');
				}
				$this->load->view($action,$data);
			} else {
			  echo '$_REQUEST is empty';
			}
		} else {
		$data['baseUrl'] = base_url();
		$this->load->view('layout/header');
		$sData['completeURL'] = site_url('welcome/action/receivefb');
		$this->load->view($action,$sData);
		$this->load->view('layout/footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
    
	 public function __construct() {

        parent::__construct();

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('category');
		$this->load->model('crudoperations');
		$this->load->model('user');
        $this->load->model('adminer');
        
		// $this->load->library('datatables');
        // $this->load->library('Auth');
        // $this->load->library('pagination');
        // $this->load->library('breadcrumb');

        // $this->status = $this->auth->checkStatus();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

	public function f_pwd() {
			if ($this->input->post('sub'))
	 	 	{
				$this->form_validation->set_rules('c_email', 'Email', "required|valid_email");
        		if ($this->form_validation->run() == FALSE)
				  {
					$this->session->set_flashdata('msg1', 'Please enter a valid email address.');               
					redirect('home/f_pwd');
				  }
				  else
				  {
					
					$this->user->f_pwd();
				  }

			}
				$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//$data['allcountry']=$this->category->getallcountry();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Forgot Password";
                $this->pagedata['content'] = $this->load->view('pages/fgetpwd', $data, TRUE);
                $this->load->view('main', $this->pagedata);
    }
	
	public function fbloginn(){
		 $fb_config = array(
            'appId'  => '626928330717700',
            'secret' => '095ee7fe5b73bfe689a7fa69cbda030e'
        );

        $this->load->library('facebook', $fb_config);

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $loginUrl=$data['login_url'] = $this->facebook
                ->getLoginUrl();
        }
		redirect("$loginUrl", 'location');
		echo "<pre>=11=";print_r($data); print_r($data['user_profile']);die;
	}
	public function fblogin(){
		$config = array(
						'appId'  => '626928330717700',//'1460029467567971',
						'secret' => '095ee7fe5b73bfe689a7fa69cbda030e',//'43f60f08441a64f6b2ea59dd5431bdd1',
						
						);
		
		$this->load->library('Facebook', $config);
		
		$user = $this->facebook->getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$profile = null;
		if($user)
		{
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$profile = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
			    $user = null;
			}		
		}
		
		$fb_data = array(
						'me' => $profile,
						'uid' => $user,
						'loginUrl' => $this->facebook->getLoginUrl(
							array(
								'scope' => 'email,user_birthday,publish_stream', // app permissions
								'redirect_uri' => base_url().'' // URL where you want to redirect your users after a successful login
							)
						),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
					);
					
			if($user){
				$this->fbloginsess($fb_data);
				}
				if(!$this->session->userdata('user_id')){
					$loginUrl=$fb_data['loginUrl'];
					redirect("$loginUrl", 'location');
				}
			//return $fb_data;
			//$this->session->set_userdata('fb_data', $fb_data);
		}
		public function twitterlogin() {
			//$this->load->library('twitteroauth.php');
			$path=getcwd().'/twitteroauth/twitteroauth.php';
			require_once("$path");
			$CONSUMER_KEY='G9dR5YaiZo5ZZoJ4jqVsSLIdV';
			$CONSUMER_SECRET='VSyYY1Sr8XUbXx5lJvXnh0pPx8uhzKtPZIARDsDUH1RHVRgYdM';
			$OAUTH_CALLBACK='http://69webspiders.com/zefaf/';
			$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
				$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token
				 //echo "<pre>";print_r($request_token);die;
				if( $request_token)
				{
					$token = $request_token['oauth_token'];
					$loged_data['request_token'] = $token ;
					$loged_data['request_token_secret'] = $request_token['oauth_token_secret'];
				  

                    $this->session->set_userdata($loged_data);
					//echo "<pre>";print_r($this->session->userdata);die;
					switch ($connection->http_code)
					{
						case 200:
							$url = $connection->getAuthorizeURL($token);
							//redirect to Twitter .
							header('Location: ' . $url);
							break;
						default:
							echo "Coonection with twitter Failed";
							break;
					}
				 
				}
				else //error receiving request token
				{
					echo "Error Receiving Request Token";
				}
		}
		
		public function fbloginsess($data){
			$this->user->add_socialuser($data['me']['email'],$data['me']['name']);
		$loged_data = array(

                        'status' => 1,

                        'user_id' => $data['uid'],

                        'email' => $data['me']['email'],
						
						'name' => $data['me']['name'],
						
						'authlevel' => FALSE,
						
						'prl' => '',
						
					);

                    $this->session->set_userdata($loged_data);
					redirect("/home", 'location');
		
		}
		
		private function twittersession(){
		
				 $path=getcwd().'/twitteroauth/twitteroauth.php';
				require_once("$path");
				$CONSUMER_KEY='G9dR5YaiZo5ZZoJ4jqVsSLIdV';
				$CONSUMER_SECRET='VSyYY1Sr8XUbXx5lJvXnh0pPx8uhzKtPZIARDsDUH1RHVRgYdM';
				$OAUTH_CALLBACK='http://69webspiders.com/zefaf/';
					$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
					$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
					//echo "<pre>";print_r($this->session->userdata);die;
					if($access_token)
					{
						$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
						
						$params =array();
						$params['include_entities']='false';
						$content = $connection->get('account/verify_credentials',$params);
				 //echo "<pre>";print_r($content);die;
						if($content && isset($content->screen_name) && isset($content->name))
						{
							$this->user->add_socialuser($content->screen_name,$content->name);
							$loged_data = array(

                        'status' => 1,

                        'user_id' => $content->id,

                        'email' => $content->screen_name,
						
						'name' => $content->name,
						
						'authlevel' => FALSE,
						
						'prl' => '',
						 
                    );

                    $this->session->set_userdata($loged_data);
					redirect("/home", 'location');
							
							/*$_SESSION['name']=$content->name;
							$_SESSION['image']=$content->profile_image_url;
							$_SESSION['twitter_id']=$content->screen_name;
				 
							//redirect to main page. Your own
							header('Location: login.php');*/
				 
						}
						else
						{
							   echo "<h4> Login Error </h4>";
						}
					}
				 
				else
				{
				 
					echo "<h4> Login Error </h4>";
				}
				
		
		}
		
		private function googlesession($data){
				 			$this->user->add_socialuser($data['email'],$data['name']);
							$loged_data = array(

											'status' => 1,
					
											'user_id' => $data['id'],
					
											'email' => $data['email'],
											
											'name' => $data['name'],
											
											'authlevel' => FALSE,
											
											'prl' => '',
											 
										);

                    $this->session->set_userdata($loged_data);
					redirect("/home", 'location');
					
				}
			
		public function glogin(){
			$path=getcwd().'/g_plus/';
			require_once $path.'src/Google_Client.php'; // include the required calss files for google login
			require_once $path.'src/contrib/Google_PlusService.php';
			require_once $path.'src/contrib/Google_Oauth2Service.php';
			session_start();
			$client = new Google_Client();
			$client->setApplicationName("Asig 18 Sign in with GPlus"); // Set your applicatio name
			$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me')); // set scope during user login
			$client->setClientId('1093672146658-0315o5ep4d993ojndinigfkdk3hqa80u.apps.googleusercontent.com'); // paste the client id which you get from google API Console
			$client->setClientSecret('9HVg1uq9CpD34vE7-AhhjtjT'); // set the client secret
			$reurl=base_url().'home/glogin';
			$client->setRedirectUri("$reurl"); // paste the redirect URI where you given in APi Console. You will get the Access Token here during login success
			$client->setDeveloperKey('XXXXXXXXXXXXXXXX'); // Developer key
			$plus 		= new Google_PlusService($client);
			$oauth2 	= new Google_Oauth2Service($client); // Call the OAuth2 class for get email address
			if(isset($_GET['code'])) {
				$client->authenticate(); // Authenticate
				$_SESSION['access_token'] = $client->getAccessToken(); // get the access token here
				header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
			}
			
			if(isset($_SESSION['access_token'])) {
				$client->setAccessToken($_SESSION['access_token']);
			}
			
			if ($client->getAccessToken()) {
			  unset($_SESSION['access_token']);
			  unset($_SESSION['gplusuer']);
			  session_destroy();
			  $user 		= $oauth2->userinfo->get();
			  $me 			= $plus->people->get('me');
			  $optParams 	= array('maxResults' => 100);
			  $activities 	= $plus->activities->listActivities('me', 'public',$optParams);
			  // The access token may have been updated lazily.
			  $_SESSION['access_token'] 		= $client->getAccessToken();
			  $email 							= filter_var($user['email'], FILTER_SANITIZE_EMAIL); // get the USER EMAIL ADDRESS using OAuth2
			} else {
				$authUrl = $client->createAuthUrl();
				header("Location: $authUrl");
			}
			
				if(isset($me)){ 
					$this->googlesession($user);
				}
			
			}	
			
     public function index() {
			
				if(isset($_GET['oauth_token']))
					{
						$this->twittersession();
					}
				/********************************************/
		  		$data['data']=array();
				if($this->session->userdata('user_id')){
					//$data['cat_detail']=$this->category->getusercatdetail();
					$data['cat_detail']=$this->category->getallstore();
				}else{
					$data['cat_detail']=$this->category->getallstore();
				}
				$type='';
				if($this->input->post('store_type',true)){
						$type=$this->input->post('store_type',true);
					}
				$data['type']=$type;
				if(isset($_REQUEST['code'])){
					//echo "<pre>=11=";print_r($_REQUEST); die;
					$data['fb_data']=$this->fblogin();
				}
				
				$this->pagedata['all_cat']=$this->category->getallcat();
				
			    $this->pagedata['pagetitle'] = "ZEFAF | Welcome";
                $this->pagedata['content'] = $this->load->view('pages/home', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function contact() {
		
		  		$data['data']=array();
				$data['pagecontant']=$this->adminer->getpages(1);
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Contact Us";
                $this->pagedata['content'] = $this->load->view('pages/contact_us', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function about() {
				
		  		$data['data']=array();
				$data['pagecontant']=$this->adminer->getpages(2);
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Contact Us";
                $this->pagedata['content'] = $this->load->view('pages/about_us', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function taskspane() {
				 if(!$this->session->userdata('user_id')) {
					redirect('/signup', 'location');
				 }
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Contact Us";
                $this->pagedata['content'] = $this->load->view('pages/tasks_pane', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function login() {
				 if($this->session->userdata('user_id')) {
					redirect('/home', 'location');
				 }
				$this->pagedata['errors']='';
				if(isset($_POST['submit'])){
									if ($this->_login_validate()) {
				
									redirect('/home', 'location');
					} else {
								
							if (trim(validation_errors()) != "")
				
								$this->pagedata['errors'] = validation_errors();
				
							elseif ($this->input->post('submit'))
				
								$this->pagedata['errors'] = "Invalid username or password!";
				
							if(trim($this->pagedata['errors'])!="")
				
							$this->pagedata['errors'];
									
								}
					}
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Welcome";
                $this->pagedata['content'] = $this->load->view('pages/login', $this->pagedata, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	
	
	private function _login_validate() {

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('email', '<b>E-mail</b>', 'required|valid_email');

            $this->form_validation->set_message('valid_email', 'Invalid %s adress');

            $this->form_validation->set_rules('password', '<b>Password</b>', 'required');

            if ($this->form_validation->run()) {

                $where = " s_email = " . $this->db->escape($this->input->post('email', TRUE)) . " and s_password = " . $this->db->escape(md5($this->input->post('password', TRUE)));

                $result = $this->crudoperations->read('wed_users', $where);

                if ($result->num_rows() > 0) {

                    $row = $result->row();
				 	 if($row->i_status!=1){
						$this->session->set_flashdata('result', 'User Not Active');
						redirect('/login', 'location');
						} 
                    $loged_data = array(

                        'status' => 1,

                        'user_id' => $row->id,

                        'email' => $row->s_email,
						
						'name' => $row->s_name,
						
						'authlevel' => TRUE,
						
						'prl' => $row->s_password

                    );

                    $this->session->set_userdata($loged_data);

                    return TRUE;

                }

                else

                    return FALSE;

            }

            else

                return FALSE;

        }

        else

            return FALSE;

    }
	
	public function logout() {
		if($this->session->userdata('user_id')) {
			/*session_start();
			session_unset();
			session_destroy();
			session_write_close();
			setcookie(session_name(),"",0,'/');
			session_regenerate_id(true);*/
			unset($_SESSION['access_token']);
		    unset($_SESSION['gplusuer']);
			$config = array(
						'appId'  => '626928330717700',//'1460029467567971',
						'secret' => '095ee7fe5b73bfe689a7fa69cbda030e',//'43f60f08441a64f6b2ea59dd5431bdd1',
						
						);
		
			$this->load->library('Facebook', $config);
			$this->facebook->destroySession();
			$this->session->sess_destroy();
			$array_items = array( 'user_id' => '' , 's_email' => '', 'name' => '');
        	$this->session->unset_userdata($array_items);
	
			$this->status = 0;
			}
			redirect('/login', 'location');
    }
	 public function signup() {
				 if($this->session->userdata('user_id')) {
					redirect('/home', 'location');
				}
				 
				if($this->input->post('submit',true)){
					if($this->input->post('username',true) && 
					    $this->input->post('email',true) &&
						$this->input->post('full_name',true) && 
						$this->input->post('password',true) && 
						$this->input->post('countryID',true) && 
						$this->input->post('stateID',true) && 
						$this->input->post('cityID',true)){
					 /*$this->form_validation->set_rules('email', '<b>E-mail</b>', 'required|valid_email');
					$this->form_validation->set_message('valid_email', 'Invalid %s adress');
					$this->form_validation->set_rules('password', '<b>Password</b>', 'required');
					 $this->form_validation->set_rules('full_name', '<b>Full Name</b>', 'required');
					$this->form_validation->set_rules('username', '<b>User Name</b>', 'required');
					
					echo "<pre>";print_r($_POST);die;
					echo $this->form_validation->run();die;
					if ($this->form_validation->run()) {
					if($_POST['username']==''  || $_POST['email']=='' || $_POST['full_name']=='' || $_POST['password']=='' || $_POST['countryID']=='' || $_POST['stateID']=='' || $_POST['cityID']==''){*/
						$this->user->add_user();
						}
						else
						{
						$this->session->set_flashdata('result', 'All Fields are required');
						redirect('/signup', 'location');
						}
					
					 
					 
				}
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				$data['allcountry']=$this->category->getallcountry();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Welcome";
                $this->pagedata['content'] = $this->load->view('pages/register', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	public function verify_account() {
				$id=$this->uri->segment(3);
				if(!$id){
					redirect('/home', 'location');
					}
				$this->user->verify_account($id);
				redirect('/login', 'location');
		}
		
		
	public function updateinfo() {
		
				 if($this->session->userdata('authlevel')===FALSE) {
					redirect('/home', 'location');
				 }
				$user_id=$this->session->userdata('user_id');
				if($this->input->post('submit',true)){
					 if($this->input->post('username',true) && 
					    $this->input->post('email',true) &&
						$this->input->post('full_name',true) && 
						$this->input->post('countryID',true) && 
						$this->input->post('stateID',true) && 
						$this->input->post('cityID',true)){
					/*if($_POST['username']==''  || $_POST['email']=='' || $_POST['full_name']=='' || $_POST['countryID']=='' || $_POST['stateID']=='' || $_POST['cityID']==''){*/
					}else{$this->session->set_flashdata('result', 'All Fields are required');
						redirect('/home/updateinfo', 'location');
						}
					$this->user->updateinfo($user_id);
					  
					 
				}
		  		$data['data']=array();
				$data['user_info']=(array)$this->user->getallusers($user_id);
				//echo "<pre>";print_r($data);die;
				$this->pagedata['all_cat']=$this->category->getallcat();
				$data['allcountry']=$this->category->getallcountry();
				$data['states']    =$this->category->getallstates($data['user_info']['s_country']);
				$data['cities']    =$this->category->getallcities($data['user_info']['s_state']);
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Welcome";
                $this->pagedata['content'] = $this->load->view('pages/updateuser', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
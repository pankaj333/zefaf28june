<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
      //  $this->load->library('datatables');

        // $this->load->library('Auth');
        // $this->load->library('pagination');
        // $this->load->library('breadcrumb');

       // $this->status = $this->auth->checkStatus();

    }



    public function index() {
				
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
				 
		  		 
				$data['reg_users']=$this->user->getallusers();
				
				$data['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $data['pagetitle'] = "ZEFAF | Welcome Admin";
                
                $this->load->view('pages/admin/index', $data);
	}
	public function getpagecontent() {
				$pid=$this->input->post('pageid',true);
				$pagecontant=$this->adminer->getpages($pid);
				header('Content-Type: application/x-json; charset=utf-8');
      	 		echo(json_encode($pagecontant));
		}
	public function editinfo() {
				

				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
				 
				 if($this->input->post('sub',true)){
					 //echo "<pre>111";print_r($_POST);die;
 						$this->adminer->edit_page($this->input->post('pagename',true));
						redirect('/admin/editinfo', 'location');
					}
				$data['allpages']=$this->adminer->getpages();
		  		 //echo "<pre>";print_r($data);die;
				 
				$data['reg_users']=$this->user->getallusers();
				
				$data['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $data['pagetitle'] = "ZEFAF | Welcome Manage Pages";
                
                $this->load->view('pages/admin/edit_pages', $data);
	}
	
	public function login() {
				 if($this->session->userdata('admin_id')) {
					redirect('/admin', 'location');
				 }
				$this->pagedata['errors']='';
				if(isset($_POST['submit'])){
									if ($this->_login_validate()) {
				
									redirect('/admin', 'location');
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
				//$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Admin Login";
                $this->load->view('pages/admin/login', $this->pagedata);
	}
	
	
	
	 public function contact() {
				
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Contact Us";
                $this->pagedata['content'] = $this->load->view('pages/contact_us', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function about() {
		
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Contact Us";
                $this->pagedata['content'] = $this->load->view('pages/about_us', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
	
	 public function managecate() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				//echo "<pre>";print_r($this->session->userdata);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Manage Category";
                $this->load->view('pages/admin/manage_cat', $this->pagedata);
	} 
	
	public function manageadds() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				$this->pagedata['alladds']=$this->adminer->getalladds();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Manage Adds";
                $this->load->view('pages/admin/manage_adds', $this->pagedata);
	}
	
	public function manage_stores() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				//$this->pagedata['all_cat']=$this->category->getallcat();
				$allstore=$this->pagedata['allstore']=$this->adminer->getallstore();//echo "<pre>";print_r($allstore);die;
				foreach($allstore as $k=> $store){
					$citydetail =$this->category->getcountrybycityid($store['i_city']);
//					echo "<pre>";print_r($citydetail);
					$this->pagedata['allstore'][$k]['i_city']=@$citydetail->cityName.' ( '.@$citydetail->countryName.' )';
					//
				} 
                $this->pagedata['pagetitle'] = "ZEFAF | Manage Stores";
                $this->load->view('pages/admin/manage_stores', $this->pagedata);
	}
	
	public function verifystore() {
	 			$storeid=$this->input->post('id',true);
				$status=$this->input->post('status',true);
				$pagecontant=$this->adminer->updatestore($storeid,$status);
				//header('Content-Type: application/x-json; charset=utf-8');
      	 		echo(json_encode($pagecontant));
	 }
	
	public function editadd() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$id=$this->uri->segment(3);
				if($id){
					
					if(isset($_POST['update'])){
					 //echo "<pre>";print_r($_POST);die;
						$status=$this->adminer->updateadd($id);
						redirect('/admin/manageadds', 'location');
					}
						$data['add']=$this->adminer->getaddsbyid($id);
						$data['chk']='';
						$data['pagetitle'] = "ZEFAF | Edit Adds";
						$this->load->view('pages/admin/manage_add', $data);
				}else{
					redirect('/admin/manageadds', 'location');
				}
	}
	public function viewadd() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$id=$this->uri->segment(3);
				if($id){
					    $data['add']=$this->adminer->getaddsbyid($id);
						$data['chk']='disabled="disabled"';
						$data['pagetitle'] = "ZEFAF | View Adds";
						$this->load->view('pages/admin/manage_add', $data);
				}else{
					redirect('/admin/manageadds', 'location');
				}
	}
	
	public function insertadd() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
					
					if(isset($_POST['submit'])){
					 //echo "<pre>";print_r($_POST);die;
						$status=$this->adminer->insertadd();
						redirect('/admin/manageadds', 'location');
					}
						//$data['add']=$this->adminer->getaddsbyid($id);
						$data['chk']='';
						$data['pagetitle'] = "ZEFAF | Add Adds";
						$this->load->view('pages/admin/create_add', $data);
				 
	}
	
	 public function viewuser() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$id=$this->uri->segment(3);
				if($id){
						$data['user']=$this->user->getuser($id);
						$data['chk']=' disabled="disabled"';
						$data['pagetitle'] = "ZEFAF | Manage Category";
						$this->load->view('pages/admin/manage_user', $data);
				}else{
					redirect('/admin', 'location');
				}
	}
	
	public function edituser() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$id=$this->uri->segment(3);
				if($id){
					
					if(isset($_POST['update'])){
					 
						$status=$this->user->updateuser($id);
						redirect('/admin', 'location');
					}
						$data['user']=$this->user->getuser($id);
						$data['chk']='';
						$data['pagetitle'] = "ZEFAF | Manage Category";
						$this->load->view('pages/admin/manage_user', $data);
				}else{
					redirect('/admin', 'location');
				}
	}
	
	public function deluser() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
				 }
		  		$data['data']=array();
				$id=$this->input->post('id',true);
				if($id){
					  $this->user->deluser($id);
				}else{
					redirect('/admin', 'location');
				}
	}
	
	public function deladd() {
				if(!$this->session->userdata('admin_id')) {
					redirect('/admin/login', 'location');
					return false;
				 }
		  		$data['data']=array();
				$id=$this->input->post('id',true);
				if($id){
					  $this->adminer->deladd($id);
				}else{
					redirect('/admin', 'location');
				}
	}
	
	 
	private function _login_validate() {

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('email', '<b>E-mail</b>', 'required|valid_email');

            $this->form_validation->set_message('valid_email', 'Invalid %s adress');

            $this->form_validation->set_rules('password', '<b>Password</b>', 'required');

            if ($this->form_validation->run()) {

                $where = " email = " . $this->db->escape($this->input->post('email', TRUE)) . " and password = " . $this->db->escape(md5($this->input->post('password', TRUE)));

                $result = $this->crudoperations->read('admin_user', $where);

                if ($result->num_rows() > 0) {

                    $row = $result->row();
				 
                    $loged_data = array(

                        'status' => 1,

                        'admin_id' => $row->id,

                        'admin_email' => $row->email,
						
						'fname' => $row->full_name,
						
						'prls' => $row->password

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
			if($this->session->userdata('admin_id')) {
					
		$array_items = array( 'admin_id' => '' , 'admin_email' => '', 'fname' => '');
        $this->session->unset_userdata($array_items);
		
				$this->status = 0;
		
				
			}
			redirect('/admin/login', 'location');
    }
	
	 public function signup() {
				 if($this->session->userdata('user_id')) {
					redirect('/home', 'location');
				}
				 
				if($this->input->post('submit',true)){
					 /*$this->form_validation->set_rules('email', '<b>E-mail</b>', 'required|valid_email');
					$this->form_validation->set_message('valid_email', 'Invalid %s adress');
					$this->form_validation->set_rules('password', '<b>Password</b>', 'required');
					 $this->form_validation->set_rules('full_name', '<b>Full Name</b>', 'required');
					$this->form_validation->set_rules('username', '<b>User Name</b>', 'required');
					
					echo "<pre>";print_r($_POST);die;
					echo $this->form_validation->run();die;
					if ($this->form_validation->run()) {*/
					if($_POST['username']==''  || $_POST['email']=='' || $_POST['full_name']=='' || $_POST['password']=='' || $_POST['city']==''){
						$this->session->set_flashdata('result', 'All Fields are required');
						redirect('/signup', 'location');
						}
					$data['s_username']	= $this->input->post('username', TRUE);//errors;
					$data['s_email']	= $this->input->post('email', TRUE);//$_POST['email'];
					$data['s_name']		= $this->input->post('full_name', TRUE);//$_POST['full_name'];
					$data['s_password']	= $this->input->post('password', TRUE);//$_POST['password'];
					$data['s_country']	= $this->input->post('countryID', TRUE);
					$data['s_state']	= $this->input->post('stateID', TRUE);
					$data['s_city']		= $this->input->post('cityID', TRUE);//$_POST['city'];
					 
					 //echo "<pre>";print_r($data);die;
						$this->crudoperations->create('wed_users', $data);
						$this->session->set_flashdata('result', 'Registred Successfully Please Login here');
						redirect('/login', 'location');
					 
					 
				}
		  		$data['data']=array();
				$this->pagedata['all_cat']=$this->category->getallcat();
				$data['allcountry']=$this->category->getallcountry();
				//echo "<pre>";print_r($data);die;
                $this->pagedata['pagetitle'] = "ZEFAF | Welcome";
                $this->pagedata['content'] = $this->load->view('pages/register', $data, TRUE);
                $this->load->view('main', $this->pagedata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
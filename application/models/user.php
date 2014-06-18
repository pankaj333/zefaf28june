<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class User extends CI_Model {

    function __construct() {

    	    parent::__construct();
	
    	    $this->load->database();

	    }

 
		function getallcat(){
			
					$sql='select * FROM wed_store_category';
					$query = $this->db->query($sql);
					return $query->result_array();	
			}
		function getallusers($id=''){
					$sql='select * FROM wed_users ';
					if($id){
						$sql.=' where id='.$id;
					}
					
					$query = $this->db->query($sql);
					if($id){
					return $query->row();	
					}
					return $query->result_array();	
			}
			
		function getuser($id=''){
			
				$this->db->select('*');
				$query = $this->db->get_where('wed_users', array('id' =>$id));
				return $row = $query->row();
			}
		
		function f_pwd() {
					
					 
				
				$record = $this->db->where('s_email', $this->input-> post('c_email', TRUE))->get('wed_users')->row();
			
				   if ( empty( $record ) )
				     {
						$this->session->set_flashdata('msg1', 'User Email not Exists');               
						redirect('home/f_pwd');
			 	     }
				   else
				    {
						
					$newpwd=time();
					$this->db->where('s_email', $this->input-> post('c_email', TRUE))->update('wed_users', array( 's_password' => md5($newpwd) ) );
					$this->load->library('email');  
					$this->email->clear();
					$config['mailtype'] = 'html';
					$img=base_url()."/img/logo.png";
					$this->email->initialize($config);
					$this->email->from($this->category->getmail(),'Wedding Zefaf');  
					$this->email->to($this->input-> post('c_email', TRUE));  
					$this->email->subject('Your Forgot Password');  
					$this->email->message("<html><img src='".$img."'><br><br> Your new password is $newpwd </html>");  
					//$this->email->message(" Your new password is $newpwd");  
					 
					if ($this->email->send()) {
							$this->session->set_flashdata('result', 'Please check your Email, Password sent successfully.');
						} else {
							$this->session->set_flashdata('result', 'Error on sending Email.');
						//show_error($this->email->print_debugger());
						//die;
						} 
						redirect('login');	
					}
			
			

    }
	
				
					
		function updateuser($id=''){
					 
						$data['s_name']	= $this->input->post('s_name', TRUE);
						$data['s_username']	= $this->input->post('s_username', TRUE);
						$data['s_email']	= $this->input->post('s_email', TRUE);
						$data['i_status']	= $this->input->post('i_status', TRUE);
						$this->db->where('id', $id);
						$this->db->update('wed_users', $data);
			}
			
		function deluser($id=''){
				$sql="DELETE FROM wed_users WHERE id=".$id;
				$query = $this->db->query($sql);
				
			}
		function permission_usertype($permission){
				$this->db->select('*');
				$query = $this->db->get_where('permission', array('permission' =>$permission));
				$row = $query->row();
				$val=$this->session->userdata('UserType');
				return $row->$val;
			}
		
		function add_socialuser($email,$name){
					$this->db->select('*');
					$query = $this->db->get_where('wed_users', array('s_email' =>$email));
					$row = $query->row();
					if(empty($row)){
						$data['s_email']	= $email;//$_POST['email'];
						$data['s_name']		= $name;//$_POST['full_name'];
						$this->crudoperations->create('wed_users', $data);
						return true;
					}
			}
		
		function add_user(){
					$this->db->select('*');
					$query = $this->db->get_where('wed_users', array('s_email' =>$this->input->post('email', TRUE)));
					$row = $query->row();
					if(!empty($row)){
						$this->session->set_flashdata('result', 'Email already Exist');
						redirect('/signup', 'location');
						}
					
					$data['s_username']	= $this->input->post('username', TRUE);//errors;
					$email=$data['s_email']	= $this->input->post('email', TRUE);//$_POST['email'];
					$data['s_name']		= $this->input->post('full_name', TRUE);//$_POST['full_name'];
					$data['s_password']	= md5($this->input->post('password', TRUE));//$_POST['password'];
					$data['s_country']	= $this->input->post('countryID', TRUE);
					$data['s_state']	= $this->input->post('stateID', TRUE);
					$data['s_city']		= $this->input->post('cityID', TRUE);//$_POST['city'];
					 
					 //echo "<pre>";print_r($data);die;
						$this->crudoperations->create('wed_users', $data);
						$lastid=$this->db->insert_id();
						$this->sendconfirmation_mail($lastid,$email);
						$this->session->set_flashdata('result', 'Registred Successfully Check Your Mail');
						redirect('/login', 'location');
			}
			
		function sendconfirmation_mail($id,$email) {
					
					$this->load->library('email');
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$link=base_url()."/home/verify_account/$id";
					$img=base_url()."/img/logo.png";
					$this->email->from($this->category->getmail(),'Wedding Zefaf');  
					$this->email->to($email);  
					$this->email->subject('Your Account Activation Link');  
					$this->email->message("<html><img src='".$img."'><br><br> Welcome to Zefaf <a href='".$link."'>Click Here</a> to verify your account </html>");  
					$this->email->send(); 
					$this->session->set_flashdata('result', 'Please check your Email, To Verify Your Account.');               
					redirect('login');	
						
		 }
		 
		 function sendstoreconfirmation_mail($id,$email) {
					$this->load->library('email');
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$link=base_url()."/store/viewstore/$id";
					$img=base_url()."/img/logo.png";
					$this->email->from($this->category->getmail(),'Wedding Zefaf');  
					$this->email->to($email);  
					$this->email->subject('Your Store Added Successfully ');  
					$this->email->message("<html><img src='".$img."'> <br><br> Your Store Added Successfully 
					<a href='".$link."'>Click Here</a> to view Store</html>");  
					$this->email->send(); 
					$this->session->set_flashdata('result', 'Please check your Email, To Verify Your Account.');              
					redirect('login');	
		 }
		 
		 function sendstoreconfirmation_mailtoadmin($id,$email) {
					$this->load->library('email');
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$link=base_url()."/store/viewstore/$id";
					$img=base_url()."/img/logo.png";
					$this->email->from($this->category->getmail(),'Wedding Zefaf');  
					$this->email->to($email);  
					$this->email->subject('New Store Added');
					$this->email->message("<html><img src='".$img."'> <br><br> New Store Added 
					<a href='".$link."'>Click Here</a> to view Store</html>");  
					$this->email->send(); 
					$this->session->set_flashdata('result', 'Please check your Email, To Verify Your Account.');              
					redirect('login');	
		 }
		 
		function verify_account($id=''){
			
						$data['i_status']	= 1;
						$data['i_is_verified']	= 1;
						$this->db->where('id', $id);
						$this->db->update('wed_users', $data);
						$this->session->set_flashdata('result', 'Your Account Verify successfully Please login here.');
						redirect('/login');	

			}
		
		function updateinfo($id){
					$data['s_username']	= $this->input->post('username', TRUE);//errors;
					$data['s_email']	= $this->input->post('email', TRUE);//$_POST['email'];
					$data['s_name']		= $this->input->post('full_name', TRUE);//$_POST['full_name'];
					if($this->input->post('password', TRUE)){
						$data['s_password']	= md5($this->input->post('password', TRUE));//$_POST['password'];
					}
					$data['s_country']	= $this->input->post('countryID', TRUE);
					$data['s_state']	= $this->input->post('stateID', TRUE);
					$data['s_city']		= $this->input->post('cityID', TRUE);//$_POST['city'];
					 
					 //echo "<pre>";print_r($data);die;
					 	$this->db->where('id', $id);
						$this->db->update('wed_users', $data);
						$loged_data['name'] = $this->input->post('full_name', TRUE);

                    	$this->session->set_userdata($loged_data);
						// echo "<pre>ddd";print_r($data);die;
						$this->session->set_flashdata('result', 'Update Successfully ');
						redirect('/home/updateinfo', 'location');
			}
}

				


/* End of file  */
 
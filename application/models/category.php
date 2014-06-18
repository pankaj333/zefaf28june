<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Category extends CI_Model {

    function __construct() {

    	    parent::__construct();
	
    	    $this->load->database();

	    }
		
		
 		function getmail(){
			
					$sql='select * FROM admin_user';
					$query = $this->db->query($sql);
					return $query->row()->email;	
			}
 
		function getallcat(){
			
					$sql='SELECT * FROM wed_store_category';
					$query = $this->db->query($sql);
					return $query->result_array();	
			}
		
		function getallstore(){
					$sql='SELECT * FROM wed_store where i_is_active=1';
					if($this->input->post('store_type',true)){
						$type=$this->input->post('store_type',true);
						if($type=='Y'){$type=1;}elseif($type=='N'){$type=0;}
						$sql.=" and i_status= $type";
						}
					$query = $this->db->query($sql);
					return $query->result_array();	
					}
			
		function getcatdetail($id='',$type=''){
				$this->db->select('*');
				if($type){
				if($type=='Y'){$type=1;}elseif($type=='N'){$type=0;}
			$query = $this->db->get_where('wed_store', array('i_category_id' =>$id,'i_is_active' =>1,'i_status' =>$type));
				}else{
			$query = $this->db->get_where('wed_store', array('i_category_id' =>$id,'i_is_active' =>1));		
					}
				$rows = $query->result_array();
				return $rows;
			}
			
			
		function getusercatdetail($id=''){
				$uid=$this->session->userdata('user_id');
				if($id){
					$sdata=array('i_category_id' =>$id,'i_user_id' =>$uid);
				}else{
					$sdata=array('i_user_id' =>$uid);
				}
				$this->db->select('*');
				$query = $this->db->get_where('wed_store', $sdata);
				$rows = $query->result_array();
				return $rows;
			}
			
		function getstorebyid($id=''){
				$this->db->select('*');
				$query = $this->db->get_where('wed_store', array('id' =>$id));
				$rows = $query->row();
				if(empty($rows))
				{
					redirect('/home', 'location');
				}
				return $rows;
			}
		
		function getaddstoreimg($id=''){
				$this->db->select('*');
				$query = $this->db->get_where('additional_store_img', array('store_id' =>$id));
				$rows = $query->result_array();
				return $rows;
			}
		
		function getcountrybycityid($id=''){
				$this->db->select('*');
				$this->db->from('cities');
				$this->db->join('states', 'cities.stateID = states.stateID');
				$this->db->join('countries', 'cities.countryID = countries.countryID');
				
				$this->db->where('cities.cityID', $id, 'left outer');
				$query = $this->db->get();
				$rows = $query->row();
				return $rows;
			}
			
		function getallcountry($id=''){
				
				if($id){
					$this->db->select('*');
					$query = $this->db->get_where('countries', array('countryID' =>$id));
					$rows  = $query->row();
				}else{
					$query = $this->db->select('*')->from('countries')->get();
					$rows  = $query->result_array();
				}
				return $rows;
			}
		
		function getallstates($id=''){
				
				if($id){
					$this->db->select('*');
					$query = $this->db->get_where('states', array('countryID' =>$id));
					return $query->result_array();
				}
				  
			}
		
		function getallcities($id=''){
				
				if($id){
					$this->db->select('*');
					$query = $this->db->get_where('cities', array('stateID' =>$id));
					return  $query->result_array();
				}
				  
			}
			
		function searchstore($name=''){
				
				if($name){
					$this->db->select('*');
					$this->db->from('wed_store');
					$this->db->like('s_store_name', $name); 
					/*if($this->session->userdata('user_id')){
						$this->db->where('i_user_id' ,$this->session->userdata('user_id'));  
					}*/
					$this->db->where('i_is_active' ,'1');
					return  $this->db->get()->result_array();
				}
				  
			}
			
			function getalladds(){
				
				 	return	$this->db->select('*')->from('web_adds')->where('active' ,'Y')->order_by("add_order", "asc")->get()->result_array();
						   
				}
			
		function addstore(){
				
				$data['i_user_id']			=$this->session->userdata('user_id');
				$data['s_store_name']		=$this->input->post('storename',true);
				$data['s_storet_desc']		=$this->input->post('store_des',true);
				$data['i_category_id']		=$this->input->post('cat_id',true);
				$data['i_country']			=$this->input->post('countryID',true);
				$data['i_state']			=$this->input->post('stateID',true);
				$data['i_city']				=$this->input->post('cityID',true);
				$data['i_store_phone_no']	=$this->input->post('store_phone',true);
				$data['s_store_email']		=$this->input->post('store_email',true);
				$data['s_store_website']	=$this->input->post('store_website',true);
				$data['i_is_active']		= 1;
				$folder = "./img/upload/";
				move_uploaded_file($_FILES["store_logo"]["tmp_name"] , $folder.$_FILES["store_logo"]["name"]);
				$data['s_store_logo'] = $_FILES["store_logo"]["name"];
				$this->db->insert('wed_store', $data);
				$store_id = $this->db->insert_id();
				
				$num_img=count($_FILES["image"]["name"]);
					if($num_img > 0)
					{
						for($a=0; $a < $num_img; $a++)
						{
							if($_FILES["image"]["name"][$a]!='')
							{
								$folder = "./img/addimgupload/";
								move_uploaded_file($_FILES["image"]["tmp_name"][$a] , $folder.$_FILES["image"]["name"][$a]);
								$img['img_name'] 		= $_FILES["image"]["name"][$a];
								$img['store_id'] 		= $store_id;
								$this->db->insert('additional_store_img', $img);
							}
						}
					}
					return $store_id;
				 
			}
			
		function updatestore($id){
				if($this->session->userdata('user_id')){
				$data['i_user_id']			=$this->session->userdata('user_id');}
				$data['s_store_name']		=$this->input->post('storename',true);
				$data['s_storet_desc']		=$this->input->post('store_des',true);
				$data['i_category_id']		=$this->input->post('cat_id',true);
				$data['i_country']			=$this->input->post('countryID',true);
				$data['i_state']			=$this->input->post('stateID',true);
				$data['i_city']				=$this->input->post('cityID',true);
				$data['i_store_phone_no']	=$this->input->post('store_phone',true);
				$data['s_store_email']		=$this->input->post('store_email',true);
				$data['s_store_website']	=$this->input->post('store_website',true);
				$data['i_is_active']		= 1;
				$folder = "./img/upload/";
				if($_FILES["store_logo"]["name"]!=''){
				move_uploaded_file($_FILES["store_logo"]["tmp_name"] , $folder.$_FILES["store_logo"]["name"]);
					$data['s_store_logo'] = $_FILES["store_logo"]["name"];
				}
				$this->db->where('id', $id);
				$this->db->update('wed_store', $data);
				 
				
				$num_img=count($_FILES["image"]["name"]);
					if($num_img > 0)
					{
						for($a=0; $a < $num_img; $a++)
						{
							if($_FILES["image"]["name"][$a]!='')
							{
								$folder = "./img/addimgupload/";
								move_uploaded_file($_FILES["image"]["tmp_name"][$a] , $folder.$_FILES["image"]["name"][$a]);
								$img['img_name'] 		= $_FILES["image"]["name"][$a];
								$img['store_id'] 		= $id;
								$this->db->insert('additional_store_img', $img);
							}
						}
					}
					 
				 
			}
}

				


/* End of file  */
 
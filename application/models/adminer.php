<?php if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Adminer extends CI_Model {

    function __construct() {

    	    parent::__construct();
	
    	    $this->load->database();

	    }

 
		function getpages($id=''){
					$where="";
					if($id){
						$where=" where pageid=".$id;
						}
					$sql='select * FROM admin_pages '.$where;
					$query = $this->db->query($sql);
					if($id){
						return $query->row();	
					}else{
						return $query->result_array();	
					}
			}
		
		function getallstore(){
			
					$sql='SELECT * FROM wed_store';
					$query = $this->db->query($sql);
					return $query->result_array();	
			}
		
		function edit_page($id=''){
						$data['page_content']	= $this->input->post('page_content', TRUE);
						$this->db->where('pageid', $id);
						$this->db->update('admin_pages', $data);
			}
			
		function updatestore($id='',$status){
			 
						if($status=='0'){ $status=1; }else{$status=0;}
						$data['i_status']	= $status;
						$this->db->where('id', $id);
						$this->db->update('wed_store', $data);
						return true;	
			}
		
		function getaddsbyid($id=''){
				
				 		return $this->db->select('*')->from('web_adds')->where('id' ,$id)->get()->row();
				}
		
		function deladd($id=''){
				$sql="DELETE FROM web_adds WHERE id=".$id;
				$query = $this->db->query($sql);
				
			}
		
		function updateadd($id=''){
			
						$data['add_name']	= $this->input->post('add_name', TRUE);
						$data['add_link']	= $this->input->post('add_link', TRUE);
						$data['add_des']	= $this->input->post('add_des', TRUE);
						$data['add_order']	= $this->input->post('add_order', TRUE);
						$data['active']		= $this->input->post('active', TRUE);
						$folder = "./img/adds/";
						if($_FILES["add_image"]["name"]!=''){
							move_uploaded_file($_FILES["add_image"]["tmp_name"] , $folder.$_FILES["add_image"]["name"]);
							$data['add_image'] = $_FILES["add_image"]["name"];
						}
						if($id){
							$this->db->where('id', $id);
							$this->db->update('web_adds', $data);
						}else{
							
							}
			}
			
			function insertadd(){
			
						$data['add_name']	= $this->input->post('add_name', TRUE);
						$data['add_link']	= $this->input->post('add_link', TRUE);
						$data['add_des']	= $this->input->post('add_des', TRUE);
						$data['add_order']	= $this->input->post('add_order', TRUE);
						$data['active']		= $this->input->post('active', TRUE);
						$folder = "./img/adds/";
						if($_FILES["add_image"]["name"]!=''){
							move_uploaded_file($_FILES["add_image"]["tmp_name"] , $folder.$_FILES["add_image"]["name"]);
							$data['add_image'] = $_FILES["add_image"]["name"];
						}
						 
							$this->db->insert('web_adds', $data);
						 
			}
			
		 
		 function getalladds(){
				
				 	return	$this->db->select('*')->from('web_adds')->get()->result_array();
						   
				}
}

				


/* End of file  */
 
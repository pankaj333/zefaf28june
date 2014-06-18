<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  Secures user access
 */
class Auth {

    private $loggedStatus = 0;
    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('crudoperations');
       // $this->checkStatus();
    }

    public function checkStatus($redirect=TRUE) {
        if ($this->CI->session->userdata('status') == 1) {
            $where = " s_email = " . $this->CI->db->escape($this->CI->session->userdata('email')) . " and s_password = " . $this->CI->db->escape($this->CI->session->userdata('prl'));
            $result = $this->CI->crudoperations->read('wed_users',$where);
            if ($result->num_rows() > 0) {
                $this->loggedStatus = 1;
            }
        } 
        if ($this->loggedStatus === 0 && $redirect) {
            redirect('login', 'location');
        }
        return $this->loggedStatus;
    }

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
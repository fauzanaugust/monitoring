<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            
            $data['template']       = 'dashboard.php';
            
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}

    public function authLogin() {
        $USERNAME = CLEAN_TEXT($this->input->post('USERNAME'));
        $PASSWORD = CLEAN_TEXT($this->input->post('PASSWORD'));
        
        $CHECK = $this->db->get_where('simoka_userlogin', array('username' => $USERNAME));
        if ($CHECK->num_rows() > 0) { 
              
            $DECODE_PASS = $this->encryption->decrypt($CHECK->row()->password);
            if($DECODE_PASS == $PASSWORD) {
                
                $this->session->set_userdata('monitoring_session', 'VALID');
                $this->session->set_userdata('monitoring_session_id', $CHECK->row()->userlogin_uid);
                $this->session->set_userdata('monitoring_session_aliasname', $CHECK->row()->username);
                $this->session->set_userdata('monitoring_session_avatar', $CHECK->row()->avatar);
                $this->session->set_userdata('monitoring_session_role', $CHECK->row()->role);
                $this->session->set_userdata('monitoring_session_uid', $CHECK->row()->id_data);
                
                $this->db->update('simoka_userlogin', array('last_login' => GET_TIMESTAMP()), array('userlogin_uid' => $CHECK->row()->userlogin_uid) );
                $this->session->set_userdata('monitoring_session_lastlogin', $CHECK->row()->last_login);
                
                echo "success";
            } else {
                echo "failed";
            }    
        }
        else {
            echo "failed";
        }
    }
    
    public function doLogout() {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }
}
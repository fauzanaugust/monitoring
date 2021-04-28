<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        $this->load->model('m_kwt');
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/profile/data.php';
            
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }   
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komoditas extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'errors/html/error_404.php';            
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}    
 
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class frontend extends CI_Controller {

	public function index()
	{
        $data['ftemplate']       = 'frontend/frontend.php';
        $this->load->view('welcome_message', $data);
	}
    
    
    public function fproduct()
	{
        $data['ftemplate']       = 'frontend/fproduct.php';
        $this->load->view('welcome_message', $data);
	}
    
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/user/data.php';            
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    public function add()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/user/add.php';
            $data['jsFile']         = 'userSave.js';
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    
    public function _uploadImage() {
        $path=FCPATH.'assets/img/avatar/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']			= true;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('avatar')) {
            return $this->upload->data("file_name");
        }
        else{
            return "user.png";
        }
    }
    
    public function doSave()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $password = $this->encryption->encrypt(trim(strip_tags($this->input->post("password"))));
            $insert = array(
                'username'      => trim(strip_tags($this->input->post("username"))),
                'password'      => $password,
                'avatar'        => $this->_uploadImage(),
                'role'          => trim(strip_tags($this->input->post("role"))),
                'id_data'       => trim(strip_tags($this->input->post("id_data")))
                 );
            $this->db->insert('simoka_userlogin', $insert);
            echo 'success';
        } 
        
        else
        {
            $this->load->view('backend');
        }
        
	}    
    
    public function doUpdate()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $password = $this->encryption->encrypt(trim(strip_tags($this->input->post("password"))));
            
            if (!empty($_FILES["avatar"]["name"])) {
                $insert = array(
                    'username'      => trim(strip_tags($this->input->post("username"))),
                    'password'      => $password,
                    'avatar'        => $this->_uploadImage(),
                    'role'          => trim(strip_tags($this->input->post("role"))),
                    'id_data'       => trim(strip_tags($this->input->post("id_data")))
                    
                 );
            } else {
                $insert = array(
                    'username'      => trim(strip_tags($this->input->post("username"))),
                    'password'      => $password,
                    'avatar'        => trim(strip_tags($this->input->post("avatar_old"))),
                    'role'          => trim(strip_tags($this->input->post("role"))),
                    'id_data'       => trim(strip_tags($this->input->post("id_data")))
                 );
            }

            $this->db->where('userlogin_uid', $this->session->userdata('sess_lockid'));
            $this->db->update('simoka_userlogin', $insert);
            echo 'success';
//            var_dump($insert);
//            die;
        } 
        
        else
        {
            $this->load->view('backend');
        }
        
	}
    
    public function doLockCode() {
        
        if ($this->session->userdata('sess_moka') == TRUE) {
            
            $LOCK_CODE = CLEAN_TEXT($this->input->post('LOCK_CODE'));
            $this->session->set_userdata('sess_lockid', $LOCK_CODE);
            echo 'success';
            
        } else {
            echo 'failed';
        }
        
    }
    
    
    public function edit()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       ="master/user/edit.php";
            $data['jsFile']         = 'userEdit.js';
            
            $data['GET_SELECTED']   = $this->db->query("SELECT * FROM simoka_userlogin WHERE userlogin_uid = '".$this->session->userdata('sess_lockid')."'");
            
            if($data['GET_SELECTED']->num_rows() > 0) {
                $data['template']       ="master/user/edit.php";
            
                $this->load->view('index', $data);
            } else {
                redirect(base_url('backend/doLogout'));
            }
        }
        else
        {
            $this->load->view('backend');
        }
        
	}
    
    public function doTrash() {
        
        if ($this->session->userdata('sess_moka') == TRUE) {
            
            $LOCK_CODE = CLEAN_TEXT($this->input->post('LOCK_CODE'));
            $this->db->delete('simoka_userlogin', array('userlogin_uid' => $LOCK_CODE));
//            if ($product->image != "user.png") {
//                $filename = explode(".", $product->image)[0];
//            return array_map('unlink', glob(FCPATH."upload/product/$filename.*"));
//            }
            echo 'success';            
        } else {
            echo 'failed';
        }
        
    }
    
 
}
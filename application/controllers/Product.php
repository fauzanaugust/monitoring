<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/product/data.php';            
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
            
            $data['template']       = 'master/product/add.php';
            $data['jsFile']         = 'productSave.js';
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    
    public function _uploadImage() {
        $path=FCPATH.'assets/img/product/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']			= true;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('productimg')) {
            return $this->upload->data("file_name");
        }
        else{
            return "noimage.png";
        }
    }
    
    public function doSave()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $insert = array(
                'product'       => trim(strip_tags($this->input->post("product"))),
                'deskripsi'     => trim(strip_tags($this->input->post("deskripsi"))),
                'harga'         => trim(strip_tags($this->input->post("harga"))),
                'id_data'       => trim(strip_tags($this->input->post("id_data"))),
                'productimg'    => $this->_uploadImage()
                 );
            $this->db->insert('mst_produk', $insert);
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
                        
            if (!empty($_FILES["productimg"]["name"])) {
                $insert = array(
                    'product'       => trim(strip_tags($this->input->post("product"))),
                    'deskripsi'     => trim(strip_tags($this->input->post("deskripsi"))),
                    'harga'         => trim(strip_tags($this->input->post("harga"))),
                    'id_data'       => trim(strip_tags($this->input->post("id_data"))),
                    'productimg'    => $this->_uploadImage()    
                 );
            } else {
                $insert = array(
                    'product'       => trim(strip_tags($this->input->post("product"))),
                    'deskripsi'     => trim(strip_tags($this->input->post("deskripsi"))),
                    'harga'         => trim(strip_tags($this->input->post("harga"))),
                    'id_data'       => trim(strip_tags($this->input->post("id_data"))),
                    'productimg'    => trim(strip_tags($this->input->post("productimg_old"))),
                 );
            }

            $this->db->where('id_product', $this->session->userdata('sess_lockid'));
            $this->db->update('mst_produk', $insert);
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
            
            $data['template']       ="master/product/edit.php";
            $data['jsFile']         ='productEdit.js';
            
            $data['GET_SELECTED']   = $this->db->query("SELECT * FROM mst_produk WHERE id_product = '".$this->session->userdata('sess_lockid')."'");
            
            if($data['GET_SELECTED']->num_rows() > 0) {
                $data['template']       ="master/product/edit.php";
            
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
            $this->db->delete('mst_produk', array('id_product' => $LOCK_CODE));
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
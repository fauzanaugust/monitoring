<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pju extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            $data['template']       = 'master/pju/data.php';
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    public function add()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            $data['template']       = 'master/pju/add.php';            
            $data['jsFile']         = 'pjuSave.js';
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    public function _uploadImage() {
        $path=FCPATH.'assets/img/legalitas/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
        $config['overwrite']			= true;
        $config['max_size']             = 10240; // 10MB
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('legalitas')) {
            return $this->upload->data("file_name");
        }
        else{
            return "Belum Ada";
        }
        $this->upload->display_errors();
    }
    
    public function doSave()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            $insert = array(
                'kode_pju'      => trim(strip_tags($this->input->post("kode_pju"))),
                'rt'            => trim(strip_tags($this->input->post("rt"))),
                'rw'            => trim(strip_tags($this->input->post("rw"))),
                'longitude'     => trim(strip_tags($this->input->post("longitude"))),
                'latitude'      => trim(strip_tags($this->input->post("latitude"))),
                'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                'id_kecamatan'  => '53010',
                'id_kelurahan'  => '53016',
                'tipe'          => 'PJU',
                'created_by'    => $this->session->userdata('monitoring_session_aliasname')
                 ); 
            $this->db->insert('mst_data', $insert);
            echo 'success';
        } 
        
        else
        {
            $this->load->view('backend');
        }
        
	}
    
    public function doUpdate()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            $insert = array(
                'kode_pju'      => trim(strip_tags($this->input->post("kode_pju"))),
                'rt'            => trim(strip_tags($this->input->post("rt"))),
                'rw'            => trim(strip_tags($this->input->post("rw"))),
                'longitude'     => trim(strip_tags($this->input->post("longitude"))),
                'latitude'      => trim(strip_tags($this->input->post("latitude"))),
                'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                'id_kecamatan'  => '53010',
                'id_kelurahan'  => '53016',
                'tipe'          => 'PJU',
                'updated_by'    => $this->session->userdata('monitoring_session_aliasname'),
                'updated_time'  => now()
            );           

            $this->db->where('id_data', $this->session->userdata('sess_lockid'));
            $this->db->update('mst_data', $insert);
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
        
        if ($this->session->userdata('monitoring_session') == TRUE) {
            $LOCK_CODE = CLEAN_TEXT($this->input->post('LOCK_CODE'));
            $this->session->set_userdata('sess_lockid', $LOCK_CODE);
            echo 'success';
        } else {
            echo 'failed';
        }
    }
    
    
    public function edit()
	{
		if ($this->session->userdata('monitoring_session') == TRUE) {
            $data['template']       ="master/pju/edit.php";                        
            $data['jsFile']         = 'pjuEdit.js';
            
            $data['GET_SELECTED']   = $this->db->query("SELECT * FROM mst_data 
                                                        WHERE id_data = '".$this->session->userdata('sess_lockid')."'" );
            
            if($data['GET_SELECTED']->num_rows() > 0) {
                $data['template']       ="master/pju/edit.php";
            
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
        
        if ($this->session->userdata('monitoring_session') == TRUE) {
            
            $LOCK_CODE = CLEAN_TEXT($this->input->post('LOCK_CODE'));
            $this->db->delete('mst_data', array('id_data' => $LOCK_CODE));
            echo 'success';            
        } else {
            echo 'failed';
        }
        
    }
    
    public function getKelurahan() {
        
        $DATA	        = trim($this->input->post('DATA'));
        $content	    = "";
			
        //Get Data
        $content 	   .= "<option value=''>Pilih Kelurahan</option>";
        $dataSelected   = $this->db->query("SELECT id_kelurahan, nama_kelurahan FROM `kelurahan` WHERE id_kecamatan = '".$DATA."' ORDER BY nama_kelurahan ASC");
        foreach($dataSelected->result() as $rsData):
            $content 	.= "<option value='".trim($rsData->id_kelurahan)."'>".trim($rsData->nama_kelurahan)."</option>";
        endforeach;
        
        echo $content;
    }   
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwt extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/kwt/data.php';
            
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
            
            $data['template']       = 'master/kwt/add.php';            
            $data['jsFile']         = 'kwtSave.js';
            
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
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $insert = array(
                'nama_alias'    => trim(strip_tags($this->input->post("nama_alias"))),
                'ketua'         => trim(strip_tags($this->input->post("ketua"))),
                'latitude'      => trim(strip_tags($this->input->post("latitude"))),
                'longitude'     => trim(strip_tags($this->input->post("longitude"))),
                'cp'            => trim(strip_tags($this->input->post("cp"))),
                'luaslahan'     => trim(strip_tags($this->input->post("luaslahan"))),
                'legalitas'     => $this->_uploadImage(),
                'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                'tipe'          => 'KWT',
                'created_by'    => $this->session->userdata('sess_moka_aliasname')
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
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            if (!empty($_FILES["legalitas"]["name"])) {
                $insert = array(
                    'nama_alias'    => trim(strip_tags($this->input->post("nama_alias"))),
                    'ketua'         => trim(strip_tags($this->input->post("ketua"))),
                    'latitude'      => trim(strip_tags($this->input->post("latitude"))),
                    'longitude'     => trim(strip_tags($this->input->post("longitude"))),
                    'cp'            => trim(strip_tags($this->input->post("cp"))),
                    'luaslahan'     => trim(strip_tags($this->input->post("luaslahan"))),
                    'legalitas'     => $this->_uploadImage(),
                    'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                    'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                    'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                    'updated_by'    => $this->session->userdata('sess_moka_aliasname'),
                    'updated_time'  => now()
                 );
            } else {
                $insert = array(
                    'nama_alias'    => trim(strip_tags($this->input->post("nama_alias"))),
                    'ketua'         => trim(strip_tags($this->input->post("ketua"))),
                    'latitude'      => trim(strip_tags($this->input->post("latitude"))),
                    'longitude'     => trim(strip_tags($this->input->post("longitude"))),
                    'cp'            => trim(strip_tags($this->input->post("cp"))),
                    'luaslahan'     => trim(strip_tags($this->input->post("luaslahan"))),
                    'legalitas'     => trim(strip_tags($this->input->post("legalitas_old"))),
                    'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                    'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                    'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                    'updated_by'    => $this->session->userdata('sess_moka_aliasname'),
                    'updated_time'  => now()
                 );
            }

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
            
            $data['template']       ="master/kwt/edit.php";                        
            $data['jsFile']         = 'kwtEdit.js';
            
            $data['GET_SELECTED']   = $this->db->query("SELECT * FROM mst_data 
                                                        WHERE id_data = '".$this->session->userdata('sess_lockid')."'" );
            
            if($data['GET_SELECTED']->num_rows() > 0) {
                $data['template']       ="master/kwt/edit.php";
            
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
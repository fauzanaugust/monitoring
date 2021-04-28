<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kwt_anggota extends CI_Controller {
    
        function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $data['template']       = 'master/kwt_anggota/data.php';            
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
            
            $data['template']       = 'master/kwt_anggota/add.php';
            $data['jsFile']         = 'kwtAnggotaSave.js';
            $this->load->view('index', $data);
        }
        else
        {
            $this->load->view('login');
        }
        
	}
    
    
    public function _uploadImage() {
        $path=FCPATH.'assets/img/ktp/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']			= true;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('ktp')) {
            return $this->upload->data("file_name");
        }
        else{
            return "Belum Ada";
        }
    }
    
    public function doSave()
	{
		if ($this->session->userdata('sess_moka') == TRUE) {
            
            $insert = array(
                'nama_anggota'  => trim(strip_tags($this->input->post("nama_anggota"))),
                'nik'           => trim(strip_tags($this->input->post("nik"))),
                'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                'jk'            => trim(strip_tags($this->input->post("jk"))),
                'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                'id_data'       => trim(strip_tags($this->input->post("dataname"))),
                'ktp'           => $this->_uploadImage(),
                'created_by'    => $this->session->userdata('sess_moka_aliasname')
                 );
            $this->db->insert('mst_anggota', $insert);
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
                        
            if (!empty($_FILES["ktp"]["name"])) {
                $insert = array(
                    'nama_anggota'  => trim(strip_tags($this->input->post("nama_anggota"))),
                    'nik'           => trim(strip_tags($this->input->post("nik"))),
                    'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                    'jk'            => trim(strip_tags($this->input->post("jk"))),
                    'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                    'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                    'id_data'       => trim(strip_tags($this->input->post("dataname"))),
                    'ktp'           => $this->_uploadImage(),
                    'updated_by'    => $this->session->userdata('sess_moka_aliasname'),
                    'updated_time'  => now()
                 );
            } else {
                $insert = array(
                    'nama_anggota'  => trim(strip_tags($this->input->post("nama_anggota"))),
                    'nik'           => trim(strip_tags($this->input->post("nik"))),
                    'alamat'        => trim(strip_tags($this->input->post("alamat"))),
                    'jk'            => trim(strip_tags($this->input->post("jk"))),
                    'id_kecamatan'  => trim(strip_tags($this->input->post("id_kecamatan"))),
                    'id_kelurahan'  => trim(strip_tags($this->input->post("id_kelurahan"))),
                    'id_data'       => trim(strip_tags($this->input->post("dataname"))),
                    'ktp'           => trim(strip_tags($this->input->post("ktp_old"))),
                    'updated_by'    => $this->session->userdata('sess_moka_aliasname'),
                    'updated_time'  => now()
                 );
            }

            $this->db->where('id_anggota', $this->session->userdata('sess_lockid'));
            $this->db->update('mst_anggota', $insert);
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
            
            $data['template']       ="master/kwt_anggota/edit.php";
            $data['jsFile']         ='kwtAnggotaEdit.js';
            
            $data['GET_SELECTED']   = $this->db->query("SELECT * FROM mst_anggota WHERE id_anggota = '".$this->session->userdata('sess_lockid')."'");
            
            if($data['GET_SELECTED']->num_rows() > 0) {
                $data['template']       ="master/kwt_anggota/edit.php";
            
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
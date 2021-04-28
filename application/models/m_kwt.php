<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kwt extends CI_Model{
    
    var $table = 'mst_kwt';
    var $column_order = array('id_kwt', 'nama_kwt', 'ketua', 'cp', 'status', 'kategori', 'legalitas', 'alamat', 'id_kecamatan', 'id_kelurahan', 'latitude', 'longitude');
    var $order = array('id_kwt', 'nama_kwt', 'ketua', 'cp', 'status', 'kategori', 'legalitas', 'alamat', 'id_kecamatan', 'id_kelurahan', 'latitude', 'longitude');
    
    
    private function _get_data_query(){
        $this->db->from($this->table);
        
        if (isset($_POST['search']['value'])){
            $this->db->like('nama_kwt', $_POST['search']['value']);            
            $this->db->or_like('nama_kwt', $_POST['search']['value']);            
            $this->db->or_like('ketua', $_POST['search']['value']);            
            $this->db->or_like('cp', $_POST['search']['value']);            
            $this->db->or_like('id_kecamatan', $_POST['search']['value']);            
            $this->db->or_like('id_kelurahan', $_POST['search']['value']);            
            $this->db->or_like('alamat', $_POST['search']['value']);            
        }
        
        if (isset($_POST['order'])){
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else {
            $this->db->order_by('nama_kwt', 'ASC');
        }
    
    }
    
    public function getData(){
        
        $this->_get_data_query();
        if ($_POST['length']!=-1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered_data(){
        $this->_get_data_query();
        $query = $this->db->  get();
        return $query->num_rows();
    }
    
    public function count_all_data(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
<?php
class M_gateway extends CI_Model{
	
//Tabel pegawai
var $tabel="tbl_topik";

function __construct()
{
	parent::__construct();
}
	
	
		//Query tampil data pegawai 
	function tampil($limit, $uri)  
    { 
		$this->db->select('*');
		$this->db->order_by('id_topik desc');
		$query = $this->db->get($this->tabel, $limit, $uri);
        	return $query->result();
    }
    
    function ambil($id_topik)
	{  
		$this->db->select('*');
		$this->db->where('id_topik', $id_topik);
		$query = $this->db->get($this->tabel);
		return $query->row();
	}
	
	//Simpan Data
	function simpan_ubah($id_topik)
	{	
		$simpan_data=array(
		'kode'			=> $this->input->post('kode'),
		'deskripsi_topik'	=> $this->input->post('deskripsi_topik'),
		'isi'			=> $this->input->post('isi')
		);
		
		$this->db->where('id_topik', $id_topik);
		$this->db->update($this->tabel, $simpan_data);	
		
	}
	
	function simpan()
	{	
		$simpan_data=array(
		'kode'			=> $this->input->post('kode'),
		'deskripsi_topik'	=> $this->input->post('deskripsi_topik'),
		'isi'			=> $this->input->post('isi')
		);
		
		$this->db->insert($this->tabel, $simpan_data);	
		
	}
	
}
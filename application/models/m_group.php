<?php
class M_group extends CI_Model{
	
	//Tabel pegawai
	var $tabel="groups";
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function get_group()

	{ 	
		$this->db->select('*');
		$query = $this->db->get($this->tabel);
		return $query->result();			

	}
		
	function tampil($limit, $uri)  
    { 
		$this->db->select('*');
		$this->db->order_by('groups.id_group desc');
		$query = $this->db->get($this->tabel, $limit, $uri);
        return $query->result();
    }
	
	// ambil data untuk ubah profil
	function ambil($id_group)
	{  
		$this->db->select('*');
		$this->db->where('id_group', $id_group);
		$query = $this->db->get($this->tabel);
		return $query->row();
	}
	
	//Simpan Data
	function simpan_ubah($id_group)
	{	
		$simpan_data=array(
		'group_name'				=> $this->input->post('group_name'),
		'deskripsi_group'			=> $this->input->post('deskripsi_group')
		);
		
		$this->db->where('id_group', $id_group);
		$this->db->update($this->tabel, $simpan_data);	
		
	}
	
	function simpan()  
	{
		$simpan=array(
		'group_name'				=> $this->input->post('group_name'),
		'deskripsi_group'			=> $this->input->post('deskripsi_group')
		);
		$this->db->insert($this->tabel, $simpan);
	}
	
	//Hapus Data 
	function hapus($id_group)
	{
		$this->db->where('id_group', $id_group);
		$this->db->delete($this->tabel);
	}
}
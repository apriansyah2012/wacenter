<?php
class M_kontak extends CI_Model{
	
	//Tabel pegawai
	var $tabel="contact";
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	
	function simpan_acess($id_contact)

	{
		$simpan_data=array(
		'id_group'		=> $this->input->post('id_group'),
		'id_contact'	=> $id_contact
		);

		$this->db->insert('group_acess', $simpan_data);
	}

	//Hapus Data 
	function hapus_acess($id_acess)
	{
		$this->db->where('id_acess', $id_acess);
		$this->db->delete('group_acess');
	}

		//Query tampil data pegawai 
	function tampil($limit, $uri)  
    { 
		$this->db->select('*');
		//$this->db->join('groups','groups.id_group=contact.id_group');
		$this->db->order_by('contact.id_contact desc');
		$query = $this->db->get($this->tabel, $limit, $uri);
        return $query->result();
    }
		
	// ambil data untuk ubah profil
	function ambil($id_contact)
	{  
		$this->db->select('*');
		//$this->db->join('group_acess','group_acess.id_group=contact.id_group');
		$this->db->where('contact.id_contact', $id_contact);
		
		$query = $this->db->get($this->tabel);
		return $query->row();
	}
	
	//Simpan Data
	function simpan_ubah($id_contact)
	{	
		
		
		
		$simpan_data=array(
		'name'				=> $this->input->post('name'),
		'contact_numb'			=> $this->input->post('contact_numb'),
		//'id_group'			=> $this->input->post('id_group')
		);
		
		$this->db->where('id_contact', $id_contact);
		$this->db->update($this->tabel, $simpan_data);	
		
		
		
		
	}
	
	
	
	//Query cari data pegawai 
	function cari($limit, $uri)  
    { 
		$cari=$this->input->post('cari');
		
		$this->db->select('*');
		//$this->db->join('groups','groups.id_group=contact.id_group');
		$this->db->order_by('contact.id_contact desc');
		$this->db->like('name', $cari);
		$this->db->or_like('contact_numb',$cari);
		$query = $this->db->get($this->tabel, $limit, $uri);
        	return $query->result();
    }
	
	//Simpan Data
	function simpan()
	{	
		$simpan_data=array(
		'name'				=> $this->input->post('name'),
		'contact_numb'		=> $this->input->post('contact_numb'),
		'id_group'			=> $this->input->post('id_group')
		);
		
		$this->db->insert($this->tabel, $simpan_data);	
		
	}
	
	//Hapus Data 
	function hapus($id_contact)
	{
		$this->db->where('id_contact', $id_contact);
		$this->db->delete($this->tabel);

		//hapus di tabel acess

		$this->db->where('id_contact', $id_contact);
		$this->db->delete('group_acess');
	}
}
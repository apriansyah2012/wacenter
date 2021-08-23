<?php
class Muser extends CI_Model{
	
	var $tabel_user="tbl_peg";
	
	
	function __construct()
	{
		parent::__construct();
	}

	function t_profil()
    { 	
		//Ambil Session id pegawai
		$sess_id_peg=$this->session->userdata('id_peg');
		
		$this->db->select('*');
		$this->db->where('tbl_peg.id_peg', $sess_id_peg);
		$query = $this->db->get($this->tabel_user);
		return $query->row();
	}		
	
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	var $tabel_user="user";
	
	
	function __construct()
	{
		parent::__construct();
	}

	public function validasi(){
		
		//VALIDASI ADMIN
		$this->db->where('email',$this->input->post('user'));
		$this->db->where('pass',md5($this->input->post('pass')));
		$this->db->where('sts',1);
		$sql_login=$this->db->get($this->tabel_user);

		if($sql_login->num_rows==1){
		return $sql_login->result_array();
		}
	
	}
	
}

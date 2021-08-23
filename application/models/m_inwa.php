<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class m_inwa extends CI_Model {

		//Tabel 
		var $tabel="whatsapp_inbox";
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			
		}
		
		//Query tampil data masuk WA
		public function tampil($limit, $uri)
		{
			$this->db->select('*');
			$this->db->order_by('id desc');
			$query = $this->db->get('whatsapp_inbox', $limit, $uri);
			return $query->result();
			
		}
		
		//Query cari data 
		function cari($limit, $uri)  
		{ 
			$cari=$this->input->post('cari');
			
			$this->db->select('*');
			$this->db->like('pengirim', $cari);
			$this->db->or_like('pesan',$cari);
			$query = $this->db->get($this->tabel, $limit, $uri);
			return $query->result();
		}
		
			
		function simpan_balasan($pengirim,$id)
		{
			$sess_hp_user=$this->session->userdata('telp');
			
			$simpan=array(
            
			'pengirim'   			=>$pengirim,
			'hp_user'   			=>$sess_hp_user,
			'pesan'				=>$this->input->post('balas_pesan'),
			'sts_jawaban'			=>'1',
			'proses'			=>'Jawaban'
	      		 );
			$this->db->insert('whatsapp_inbox', $simpan);
			
			
			$simpan_ubah=array(
			'sts_jawaban'				=>'1',
			'status_topik'				=>$this->db->insert_id()
			);
			
			$this->db->where('id', $id);
			$this->db->update('whatsapp_inbox', $simpan_ubah);
			
			
		
		}
		
}
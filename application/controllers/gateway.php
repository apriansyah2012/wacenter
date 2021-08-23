<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Gateway extends CI_Controller{

	function __Construct()
    {
        parent ::__construct();
		$this->load->model('m_gateway');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
	


	//Menampilkan data pegawai
	function index()	
    {
		$config = array(                   
                   'base_url'    => site_url() . '/gateway/index',
                   'total_rows'  => $this->db->count_all('tbl_topik'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 20,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['gateway']   = $this->m_gateway->tampil($config['per_page'],$this->uri->segment(3));
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Pengaturan';
		$data['submenu']='Pengaturan User';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Daftar User';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/gateway/gateway';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		
    }
    
    function ubah($id_topik)
	{
		if($_POST == NULL) {
		$data['edit'] = $this->m_gateway->ambil($id_topik);
		
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Kontak';
		$data['submenu']='Ubah Kontak';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Ubah Kode';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/gateway/ed_gateway';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
			$this->m_gateway->simpan_ubah($id_topik);
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil DiUbah ...
					</div>');
			redirect('gateway');
		}
			
	}
	
	
	function tbh()
	{
		if($_POST == NULL) {
		//Konfigurasi title, header
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Kontak';
		$data['submenu']='Ubah Kontak';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Ubah Kode';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/gateway/tbh_gateway';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
		$this->m_gateway->simpan();
			
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Disimpan ...
					</div>');
			redirect('gateway');
		}
		
	}
	
	//Hapus Data 
	function hapus($id_topik)
	{
		$this->db->where('id_topik', $id_topik);
		$this->db->delete('tbl_topik');
		//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil dihapus ...
					</div>');
			redirect('gateway');
	}
	
	
}
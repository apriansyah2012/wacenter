<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Group extends CI_Controller{

	function __Construct()
    {
        parent ::__construct();
		$this->load->model('m_group');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
	function index()	
    {
	
		$config = array(                   
                   'base_url'    => site_url() . '/group/index',
                   'total_rows'  => $this->db->count_all('groups'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['group']   = $this->m_group->tampil($config['per_page'],$this->uri->segment(3));
		
        //Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/group/group';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
	
    }
	
	//Ubah Data 
	function ubah($id_group)
	{
		if($_POST == NULL) {
		$data['edit'] = $this->m_group->ambil($id_group);//AMbil query untuk edit
		
		
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Group';
		$data['submenu']='Ubah Group';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Ubah Group';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/group/ed_group';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
			$this->m_group->simpan_ubah($id_group);
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Di ubah ...
					</div>');
			redirect('group');
		}
			
	}
	
	function tbh()
	{
		if($_POST == NULL) {
		
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Group';
		$data['submenu']='Tambah Group';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Tambah Group';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/group/in_group';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
		$this->load->library('form_validation');
		$config = array(	
			array('field' =>'group_name','label' =>'Nama Group','rules' =>'trim|required'),
			array('field' =>'deskripsi_group','label' =>'Deskripsi Group','rules' =>'trim|required'),
			);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<span style="color:red">','</span>');	
		if ($this->form_validation->run() == FALSE)
		{
		
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Group';
		$data['submenu']='Tambah Group';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Tambah Group';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/group/in_group';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}
		else{
			$this->m_group->simpan();
			
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Disimpan ...
					</div>');
			redirect('group');
		}
		}
	}
	
	//Hapus Data 
	function hapus($id_group)
	{
		$this->m_group->hapus($id_group);
		//Pesan
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>Sukses !</strong> Data Berhasil Di Hapus ...
				</div>');
		redirect('group/index');
	}
	
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Kontak extends CI_Controller{

	function __Construct()
    {
        parent ::__construct();
		$this->load->model('m_kontak');
		$this->load->model('m_group');
		$this->load->model('m_wa');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
	

	function tbh_acess($id_contact)
	{
		$this->m_kontak->simpan_acess($id_contact);
		
		//Pesan
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>Sukses !</strong> Data Berhasil Disimpan ...
				</div>');
		redirect('kontak/index');
	}


	//Hapus Data 
	function hapus_acess($id_acess)
	{
		$this->m_kontak->hapus_acess($id_acess);
		//Pesan
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>Sukses !</strong> Data Berhasil Di Hapus ...
				</div>');
		redirect('kontak');
	}

	//Menampilkan data pegawai
	function index()	
    {
		$config = array(                   
                   'base_url'    => site_url() . '/kontak/index',
                   'total_rows'  => $this->db->count_all('contact'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 20,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['user']   = $this->m_kontak->tampil($config['per_page'],$this->uri->segment(3));
		$data['group']   	= $this->m_group->get_group();
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Pengaturan';
		$data['submenu']='Pengaturan User';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Daftar User';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/user/user';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		
    }
	
	
	function clean()
	{
		$this->db->empty_table('contact');
		redirect('kontak/index');
	}
	
	//Ubah Data 
	function ubah($id_contact)
	{
		if($_POST == NULL) {
		$data['edit'] = $this->m_kontak->ambil($id_contact);//AMbil query untuk edit
		$data['group']   = $this->m_wa->t_group();
		
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Kontak';
		$data['submenu']='Ubah Kontak';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Ubah Kontak';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/user/ed_kontak';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
			$this->m_kontak->simpan_ubah($id_contact);
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil DiUbah ...
					</div>');
			redirect('kontak');
		}
			
	}
	
	function tbh()
	{
		if($_POST == NULL) {
		$data['group']   = $this->m_wa->t_group();
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Kontak';
		$data['submenu']='Tambah Kontak';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Tambah Kontak';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/user/in_kontak';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
		$this->load->library('form_validation');
		$config = array(	
			array('field' =>'name','label' =>'Nama ','rules' =>'trim|required'),
			array('field' =>'contact_numb','label' =>'Nomor HP','rules' =>'trim|required'),
			array('field' =>'id_group','label' =>'ID Group','rules' =>'trim|required'),
			);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<span style="color:red">','</span>');	
		if ($this->form_validation->run() == FALSE)
		{
		$data['group']   = $this->m_wa->t_group();
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Kontak';
		$data['submenu']='Tambah Kontak';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Tambah Kontak';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/user/in_kontak';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}
		else{
			$this->m_kontak->simpan();
			
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Disimpan ...
					</div>');
			redirect('kontak');
		}
		}
	}
	
	//Hapus Data 
	function hapus($id_contact)
	{
		$this->m_kontak->hapus($id_contact);
		//Pesan
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>Sukses !</strong> Data Berhasil Di Hapus ...
				</div>');
		redirect('kontak');
	}
	
	function cari()
	{
		
		$config = array(                   
                   'base_url'    => site_url() . '/kontak/index',
                   'total_rows'  => $this->db->count_all('contact'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['user']   = $this->m_kontak->cari($config['per_page'],$this->uri->segment(3));
		$data['group']   	= $this->m_group->get_group();
		if($data['user']==null) 
		{
			//Konfigurasi title, header
			$data['title']='Aplikasi Broadcast WhatsApp';
			$data['menu']='Pengaturan';
			$data['submenu']='Pengaturan User';
			$data['header']='Aplikasi Broadcast WhatsApp';
			$data['subheader']='Daftar User';
			$data['top_navbar']='menu/top';
			$data['left_navbar']='menu/left';
			$data['navigasi']='menu/navigasi';
			$data['notifikasi'] = '
				<center><div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h3>Peringatan !</h3>
                Data yang anda cari tidak ada atau keywordnya salah<br>
				<a href="'.base_url().'kontak"><span><<< Kembali >>></span></a>
				</center>
             </div>';
			$data['content']='admin/notifikasi';
			$data['footer']='menu/bottom';
			$this->load->view('admin/tmp',$data);
			
		}else {
			
			//Konfigurasi title, header
			$data['title']='Aplikasi Broadcast WhatsApp';
			$data['menu']='Pengaturan';
			$data['submenu']='Pengaturan User';
			$data['header']='Aplikasi Broadcast WhatsApp';
			$data['subheader']='Daftar User';
			$data['top_navbar']='menu/top';
			$data['left_navbar']='menu/left';
			$data['navigasi']='menu/navigasi';
			$data['content']='modul/user/user';
			$data['footer']='menu/bottom';
			$this->load->view('admin/tmp',$data);
		}
		
	}
}
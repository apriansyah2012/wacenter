<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class C_inwa extends CI_Controller{

	function __Construct()
    {
        parent ::__construct();
		$this->load->model('m_inwa');
		$this->load->model('m_wa');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
	function clean()
	{
		$this->db->empty_table('whatsapp_inbox');
		redirect('c_inwa');
	}
	
	function index()	
    {
	
		$config = array(                   
                   'base_url'    => site_url() . '/c_inwa/index',
                   'total_rows'  => $this->db->count_all('whatsapp_inbox'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['inwa']   = $this->m_inwa->tampil($config['per_page'],$this->uri->segment(3));
		
        //Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/inwa/inwa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
	
    }
	
	function cari()
	{
		
		$config = array(                   
                   'base_url'    => site_url() . '/c_inwa/index',
                   'total_rows'  => $this->db->count_all('whatsapp_inbox'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['inwa']   = $this->m_inwa->cari($config['per_page'],$this->uri->segment(3));
		
        
		
		if($data['inwa']==null) 
		{
			//Konfigurasi title, header
			$data['title']='Aplikasi Broadcast WhatsApp';
			$data['menu']='Broadcast';
			$data['submenu']='Broadcast WhatsApp';
			$data['header']='Aplikasi Broadcast WhatsApp';
			$data['subheader']='Broadcast WhatsApp';
			$data['top_navbar']='menu/top';
			$data['left_navbar']='menu/left';
			$data['navigasi']='menu/navigasi';
			$data['notifikasi'] = '
				<center><div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h3>Peringatan !</h3>
                Data yang anda cari tidak ada atau keywordnya salah<br>
				<a href="'.base_url().'c_inwa"><span><<< Kembali >>></span></a>
				</center>
             </div>';
			$data['content']='admin/notifikasi';
			$data['footer']='menu/bottom';
			$this->load->view('admin/tmp',$data);
			
		}else {
			
			//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/inwa/inwa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}
		
	}
	
	function balas($pengirim,$id)
	{
		$this->m_inwa->simpan_balasan($pengirim,$id);
		
		$balasan=$this->input->post('balas_pesan');
					$spasi='
';
				$spasi_2='
				';
		$footer='*#Whatsapp Center #*';
		//Kirim Whatsapp
		$phone=$pengirim;
		$pesan=''.$balasan.' '.$spasi.' '.$footer.''; 
		$this->m_wa->kirimWa($phone,$pesan);
		
		//Ubah STatus
		redirect('c_inwa');
	
	}
	


	
}
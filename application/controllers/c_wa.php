<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class C_wa extends CI_Controller{

	function __Construct()
    {
        parent ::__construct();
		$this->load->model('m_wa');
		$this->load->library('excel');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
		
	function run()
	{
		$this->m_wa->running();
		redirect('c_wa');
	}

	function clean()
	{
		$this->db->empty_table('whatsapp_outbox');
		redirect('c_wa');
	}
	
	function index()	
    {
	
		$config = array(                   
                   'base_url'    => site_url() . '/c_wa/index',
                   'total_rows'  => $this->db->count_all('whatsapp_outbox'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['wa']   = $this->m_wa->tampil($config['per_page'],$this->uri->segment(3));
		
        //Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/wa/wa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
	
    }
	
	function tbh_exel()				
    { 		
			//Konfigurasi title, header
			$data['title']='E-Ofice LPMP D.I. YOGYAKARTA';
			$data['menu']='Broadcast';
			$data['submenu']='Broadcast Whatsap';
			$data['header']='Simpeg';
			$data['subheader']='Broadcast Whatsap';
			$data['top_navbar']='menu/top';
			$data['left_navbar']='menu/left';
			$data['navigasi']='menu/navigasi';
			$data['content']='modul/wa/form_exel';
			$data['footer']='menu/bottom';
			$this->load->view('admin/tmp',$data);
		
	}
	

	public function kirim_exel()
    {
		date_default_timezone_set('Asia/Jakarta');
		$waktu = date("Y-m-d H:i:s");
		$nama_akses=$this->session->userdata('nama');
		
		if(isset($_FILES["userfile"]["name"]))
			{
				$path = $_FILES["userfile"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{   
						$nama		= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$tujuan 	= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$judul		= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$pesan		= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						
						//untuk dikirim
						$data[] = array(
							
							'tanggal'			=> $waktu,
							'tujuan'			=> $tujuan,
							'id_group'			=> 0,
							'interval'			=> 5, 
							'pesan'				=> $pesan,
							'akses'				=> $nama_akses
							
						);
						
						
						
						$spasi='
';
				$spasi_2='
				';
						$nomor=$tujuan;
						$pesan=''.$judul.''.$spasi.'Yth Bpk/Ibu *'.$nama.'*'.$spasi.''.$spasi.''.$pesan; 
						$this->m_wa->kirimWA($nomor,$pesan);
					}
					
					
					
				}
				$this->m_wa->insert($data);
				
				
			} 
         
				
		redirect('c_wa');
    
    }
	
	function tbh()
	{
		if($_POST == NULL) {
		
		$data['contact']   = $this->m_wa->tampil_tbh();
		$data['group']   = $this->m_wa->t_group();
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/wa/form_wa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}else{
		$this->load->library('form_validation');
		$config = array(	
			array('field' =>'pesan','label' =>'Pesan','rules' =>'trim|required'),
			);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<span style="color:red">','</span>');	
		if ($this->form_validation->run() == FALSE)
		{
		
		$data['contact']   = $this->m_wa->tampil_tbh();
		$data['group']   = $this->m_wa->t_group();
		//Konfigurasi title, header
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Broadcast';
		$data['submenu']='Broadcast WhatsApp';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Broadcast WhatsApp';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='modul/wa/form_wa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}
		else{
			$id_group= $this->input->post('id_group');
			if($id_group==NULL){
			$this->m_wa->simpan_wa();//simpan di outbox  db  wa
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Dikirim ...
					</div>');
			redirect('c_wa');
			}else{
			$this->m_wa->simpan_group_wa();//simpan di  outbox  db  wa
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Sukses !</strong> Data Berhasil Dikirim ...
					</div>');
			redirect('c_wa');
			}
			
			
		}
		}	
	}
	
	
	//Hapus Data 
	function hapus($id)
	{
		$this->m_wa->hapus($id);
		//Pesan
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong>Sukses !</strong> Data Berhasil Di Hapus ...
				</div>');
		redirect('c_wa');	
	}
	
	
	function cari()
	{
		
		$config = array(                   
                   'base_url'    => site_url() . '/c_wa/index',
                   'total_rows'  => $this->db->count_all('whatsapp_outbox'),
				   'first_link' =>'Awal',
				   'last_link'  =>'Akhir',
                   'per_page'    => 10,
                   'uri_segment' => 3
                   );
		$this->pagination->initialize($config);
		$data["num"]=$this->uri->segment(3);
		$data['wa']   = $this->m_wa->cari($config['per_page'],$this->uri->segment(3));
		
        
		
		if($data['wa']==null) 
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
				<a href="'.base_url().'c_wa"><span><<< Kembali >>></span></a>
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
		$data['content']='modul/wa/wa';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
		}
		
	}
}
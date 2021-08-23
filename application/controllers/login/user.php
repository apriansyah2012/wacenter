<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __Construct()
    {
        parent ::__construct();
		//Load ke model m_login
		$this->load->model('M_login','',TRUE);
	}
	
	public function index()
	{
		$data['title']='Aplikasi Broadcast WhatsApp';
		$this->load->view('login',$data);
	}
	
	public function login()
	{
		
		$cek_login=$this->M_login->validasi();
		if($cek_login)
		{
		foreach($cek_login as $data_login)
		{
			$id_user=$data_login['id_user'];
			$level=$data_login['level'];
			$nama=$data_login['nama'];
		}
			
			$data_login=array(
			'id_user'=>$id_user,
			'is_logged_in'=> true,
			'namadepan'=>$data_login['namadepan'],
			'nama'=>$data_login['nama'],
			'telp'=>$data_login['telp'],
			'sts'=>$data_login['sts'],
			'level'=>$data_login['level'],
			'email'=>$data_login['email']
			);
			 $this->session->set_userdata($data_login);
			redirect(base_url().'dashboard');
			} else  {
			$data['title']='Aplikasi Broadcast WhatsApp';
			//Pesan
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   <span aria-hidden="true">&times;</span>
				  </button>
				  <strong></strong>Acount anda belum aktif atau username dan password salah !
				</div>');
			$this->load->view('login',$data);
			
			}
	}
		
	public function logout(){
		
		$data = array
            (
				'nik'=>0,
				'nama'=>0,
				'telp'=>0,
				'level'=>0,
				'email'=>0,
				'telp'=>0,
				'status' => FALSE
        );
		
        $this->session->sess_destroy();
        $this->session->unset_userdata($data);
		
		$this->index();
		}
}

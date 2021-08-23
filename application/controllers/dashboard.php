<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	
	
	public  function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->database();
		$this->load->model('m_wa');
		$this->is_logged_in();
	}
	
	public function is_logged_in(){
	
	$is_logged_in=$this->session->userdata('is_logged_in');
		if(!isset($is_logged_in)||$is_logged_in!= true) {
		redirect(base_url());
		} 
	}
	
	
	public function index()
	{	
		$data['device']   = $this->m_wa->device();
		
		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Beranda';
		$data['submenu']='Beranda Anda';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Beranda Anda';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='realtime';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);
	}

	function restart()
	{
		$result = $this->db->query("SELECT * FROM device");
		foreach ($result->result_array() as $id)
		$token=$id['token'];
		$server=$id['server'];

		
		$curl = curl_init();
		//$token = "";

		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $token",
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, "$server/api/device/reconnect?token=$token");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);
		$data['device']   = $this->m_wa->device();
		
		 
		$url="$server/api/device/reconnect?token=$token";
		$get_url = file_get_contents($url);
		$out = json_decode($get_url, true);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			<strong>Restart '.$out['message'].'</strong>
		</div>');


		$data['title']='Aplikasi Broadcast WhatsApp';
		$data['menu']='Beranda';
		$data['submenu']='Beranda Anda';
		$data['header']='Aplikasi Broadcast WhatsApp';
		$data['subheader']='Beranda Anda';
		$data['top_navbar']='menu/top';
		$data['left_navbar']='menu/left';
		$data['navigasi']='menu/navigasi';
		$data['content']='realtime';
		$data['footer']='menu/bottom';
		$this->load->view('admin/tmp',$data);

	}

	function ubah($id_device)
	{

		$simpan_data=array(
			'no_hp'			=>$this->input->POST('no_hp'),
			'server'			=>$this->input->POST('server'),
			'token'			=>$this->input->POST('token')
		);
		$this->db->where('id_device', $id_device);
		$this->db->update('device', $simpan_data);


		$tokennya=$this->input->POST('token');
		$nope=$this->input->POST('no_hp');

		$result = $this->db->query("SELECT * FROM device");
		foreach ($result->result_array() as $id)
		$token=$id['token'];
		$server=$id['server'];

		$curl = curl_init();
		$data = [
			'phone' => $nope,
		];

		
		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $token",
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "$server/api/device/change-sender");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			<strong>Berhasil merubah nomor sender</strong>
		</div>');


		redirect('dashboard');
	}
	
	
}

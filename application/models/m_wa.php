<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class m_wa extends CI_Model {

		//Tabel 
		var $tabel="whatsapp_outbox";
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			
		}
		
		
		//Query tampil data kirim WA
		public function device()
		{
			$this->db->select('*');
			$query = $this->db->get('device');
			return $query->row();
			
		}
		

		function running()
		{
			$program_path = "..\..\gateway\Indevsign\WhatsApp Gateway.exe";
			shell_exec($program_path);
		}
		
		//Insert dari exel 97
		public function insert($data)
	    {
	        $this->db->insert_batch('whatsapp_outbox', $data);
	        return $this->db->insert_id();
	    }
		

		//Query tampil data kirim WA
		public function tampil($limit, $uri)
		{
			$this->db->select('*');
			$this->db->join('contact','contact.contact_numb = whatsapp_outbox.tujuan','left');
			$this->db->join('groups','groups.id_group= whatsapp_outbox.id_group','left');
			$this->db->order_by('id desc');
			$query = $this->db->get('whatsapp_outbox', $limit, $uri);
			return $query->result();
			
		}
		
		
		//Query tampil data group 
		public function t_group()
		{
			$this->db->select('*');
			$query = $this->db->get('groups');
			return $query->result();
			
		}
		
		
		//Query tampil kontak 
		function tampil_tbh()  
		{ 
			
			$id_group = $this->input->post('id_group');
			$this->db->select('*');
			$query = $this->db->get('contact');
			return $query->result();
		}
		
		
		function simpan_wa()  
		{
			date_default_timezone_set('Asia/Jakarta');
			$waktu = date("Y-m-d H:i:s");
			$nama_akses=$this->session->userdata('nama');
		
			//multiple input data 
			$action = $this->input->post('action');
			if ($action == "aksi") {
				$input = $this->input->post('msg');
				
				//POST FORM
				$judul=$this->input->post('judul');
				$isi_pesan=$this->input->post('pesan');
				$spasi='
';
				$spasi_2='
				';

				
				for ($i=0; $i < count($input) ; $i++) 
				{ 
				//Ambil data kontak
				$result = $this->db->query("SELECT * FROM contact where contact.contact_numb=$input[$i]");
				foreach ($result->result_array() as $id)
				$nama=$id['name'];
				$id_group=$id['id_group'];
				
				//Kirim API
				$phone=$input[$i];
				$pesan=''.$judul.''.$spasi.'Yth Bpk/Ibu *'.$nama.'*'.$spasi.''.$spasi.''.$isi_pesan; 
				$this->kirimWa($phone,$pesan);

				$simpan=array(
					'tanggal'			=> $waktu,
					'tujuan'			=> $input[$i],
					'id_group'			=> $id_group,
					'interval'			=> 5, 
					'pesan'				=> $isi_pesan,
					'akses'				=> $nama_akses
				);
					$this->db->insert('whatsapp_outbox', $simpan);
					
				}
			}	
		}
		
		//Simpan data ke tabel WA
		function simpan_group_wa()  
		{	
			
			date_default_timezone_set('Asia/Jakarta');
			$waktu = date("Y-m-d H:i:s");
			$nama_akses=$this->session->userdata('nama');
			
			$action = $this->input->post('action');
			if ($action == "aksi") {
				$input = $this->input->post('id_group');
				
				//POST FORM
				$judul=$this->input->post('judul');
				$isi_pesan=$this->input->post('pesan');
				$spasi='
';
				$spasi_2='
				';

				
				for ($i=0; $i < count($input) ; $i++) 
				{ 

				


				$result = $this->db->query("SELECT * FROM contact 
				INNER JOIN `group_acess`  ON (`group_acess`.`id_contact` = `contact`.`id_contact`)
				WHERE group_acess.id_group=$input[$i]");
				//where contact.id_group=$input[$i]");
				foreach ($result->result_array() as $id){
				$nama=$id['name'];
				$id_group=$id['id_group'];
				$phone=$id['contact_numb'];
				
				//Kirim API
				//$phone=$input[$i];
				$pesan=''.$judul.''.$spasi.'Yth Bpk/Ibu *'.$nama.'*'.$spasi.''.$spasi.''.$isi_pesan; 
				$this->kirimWa($phone,$pesan);		

				$simpan=array(
					'tanggal'			=> $waktu,
					'tujuan'			=> $phone,
					'id_group'			=> $id_group,
					'interval'			=> 5, 
					'pesan'				=> $isi_pesan,
					'akses'				=> $nama_akses					
					);
				$this->db->insert('whatsapp_outbox', $simpan);	
				
				}	
				}
			}
		}
		
		//Hapus Data 
		function hapus($id)
		{
			$this->db->where('id', $id);
			$this->db->delete($this->tabel);
		}
		
		//Query cari data 
		function cari($limit, $uri)  
		{ 
			$cari=$this->input->post('cari');
			
			
			$this->db->select('*');
			$this->db->join('contact','contact.contact_numb = whatsapp_outbox.tujuan');
			$this->db->join('groups','groups.id_group= whatsapp_outbox.id_group');
			$this->db->like('tujuan', $cari);
			$this->db->or_like('pesan',$cari);
			$query = $this->db->get($this->tabel, $limit, $uri);
			return $query->result();
		}
	
	function kirimWa($phone,$pesan)
	{
		
		$result = $this->db->query("SELECT * FROM device");
		foreach ($result->result_array() as $id)
		$token=$id['token'];
		$server=$id['server'];

		
		$curl = curl_init();
		//$token = "";
		$url="$server/send-message";
		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $token",
			)
		);

		$data = [
			'number' => $phone,
			'message' => $pesan,
		];

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);	
	}
	
	/**
	function kirimWa($phone,$pesan)
	{
		$to      = $phone;//Tujuan
		$message = $pesan;//isi pesan
		$url     = 'http://apiwa.lpmpjogja.or.id/api/send.php?key=b3a403fbe15844e62813aa43cc0fb4badf4d12ae';//Parameter ini diubah
		$header  = array(
		    'Content-Type: application/json',
		    'Auth-API4GW: Your apikey'
		);
		$params = [
		    'type'     => 'text',
		    'nomor'       => $to,
		    'msg'  => $message,
		];
		$params_post = json_encode($params, JSON_PRETTY_PRINT);
		$post        = curl_init($url);
		curl_setopt($post, CURLOPT_HTTPHEADER, $header);
		curl_setopt($post, CURLOPT_POSTFIELDS, $params_post);
		curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($post);
		curl_close($post);
		//echo $response;
		
		
	}
	**/	

}
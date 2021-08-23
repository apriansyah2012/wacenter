<?php

function index()	
    {
		$id = $_POST['id'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$status='Pesan Masuk';


		$simpan=array(
			'unik'				=> $id,
			'tanggal'			=> $waktu,
			'pengirim'			=> $phone,
			'pesan'				=> $message,
			'proses'			=> $status
		);
			$this->db->insert('whatsapp_inbox', $simpan);
		
	
    }
    
    ?>
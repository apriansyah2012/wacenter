<?php
			date_default_timezone_set('Asia/Jakarta');
			$log= date("Y-m-d H:i:s");$today= date("Y-m-d");
			
			//Ambil data NIP dari db FTM
			$this->ftm_db = $this->load->database('ftm', true);
			$result = $this->ftm_db->query("SELECT `emp`.`nik` FROM `ftm`.`emp` WHERE phone!=' '");
			foreach ($result->result_array() as $peg)
			{
			//Tampil Data Pegawai dari Aplikasi Absen	
			$nip= ''.$peg['nik'].'';	
			//echo $nip;echo '<br>';
			
			$result = $this->ftm_db->query("SELECT `att_log`.`scan_date`, `emp`.`alias`, `emp`.`phone`
			,`emp`.`pin`, `emp`.`nik`, `att_log`.`att_id`, `att_log`.`status` FROM `ftm`.`att_log`
			INNER JOIN `ftm`.`emp` ON (`att_log`.`pin` = `emp`.`pin`) WHERE nik=$nip
			AND scan_date LIKE '%$today%' AND status=0");
			foreach ($result->result_array() as $scan)
				{
					$waktu = date('d-M-Y H:i:s', strtotime($scan['scan_date'] ));
						  
					$pesan='Terimakasih  *'.$scan['alias'].'* , Anda sudah melakukan Scan Presensi pada *_'.$waktu.'_* ' ;
					$nomor=$scan['phone'];
					$id=$scan['att_id'];
					echo $nomor;echo $pesan;echo '<br>';
					
					//INSERT DATA UNTUK DIKIRIM
					$simpan=array(
						'tanggal'			=> $log,
						'tujuan'			=> $nomor,
						'id_group'			=> 1,
						'interval'			=> 15, 
						'pesan'				=> $pesan,
						'proses'			=> 0          //Jika  0  maka  bisa terkirim kalau satu tidak terkirim  
						);
						$this->db->insert('outbox', $simpan);
					
					
					//UPDATE DATA  YANG SUDAH DIKIRIM DI TABEL OUTBOX DB WA
					$simpan=array(
						'status'			=> 1
						);
						$this->ftm_db->update('att_log', $simpan);
						$this->ftm_db->where('att_id',$id);
					
					
				}
			}
			

?>

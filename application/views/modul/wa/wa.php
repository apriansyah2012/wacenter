
			<div class="row">
			<div class="col-xs-12">
					<?php echo '<div class="pesan">'.$this->session->flashdata('message').'</div>';?>
					<h3 class="header smaller lighter blue"><?php if (isset($subheader)){ echo $subheader; }?></h3>
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<div class="table-header">
					</div>
					<div>

					<hr>
					<th class="left" colspan="9">
					<form class="form-search" action="<?php echo base_url();?>c_wa/cari" method=POST >
					<span class="input-icon">
					<input name="cari"type="text" placeholder="Pencarian......." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>
						
						<div class="widget-toolbar">
						<!--<?php echo'<a href="'.base_url().'c_wa/clean" onclick="return confirm(\'Anda yakin mengosongkan tabel outbox ?\')">
											<button class="btn btn-xs btn-danger" type="button">
												<i class="ace-icon glyphicon glyphicon-trash bigger-110"></i>
												Hapus Data Outbox
											</button>
											</a>';?>-->


							<?php echo'<a href="'.base_url().'format/format_kirim.xls" onclick="return confirm(\'Download format exel ?\')">
											<button class="btn btn-xs btn-success" type="button">
												<i class="ace-icon glyphicon glyphicon-exit bigger-110"></i>
												Format Exel untuk kirim Whatsapp
											</button>
											</a>';?>
						<a href="<?php echo base_url(); ?>c_wa/tbh_exel" data-action="collapse"><button class="btn btn-xs btn-success" type="button">
							<i class="ace-icon glyphicon glyphicon-plus bigger-110"></i>
							Kirim exel
						</button></a>
						<a href="<?php echo base_url(); ?>c_wa/tbh" data-action="collapse"><button class="btn btn-xs btn-primary" type="button">
							<i class="ace-icon glyphicon glyphicon-plus bigger-110"></i>
							Kirim WhatsApp
						</button></a>
						<a href="javascript:history.back()" class="btn btn-xs btn-warning" type="reset" data-action="collapse">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Kembali
						</button></a>
						</div>
					</form>	
					
					<hr>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover" >
							<thead class="h6">
								<tr>
									  <th width="50">No</th>
									  <th>Nama</th>
									  <th>Tujuan</th>
									  <th>Pesan</th>
									  <th>Waktu</th>
									  <th>Status</th>
									  <th>Group</th>
									  <th>Akses</th>
									  <th colspan="2" class="center" width="40">Aksi</th>
								</tr>
							</thead>
								
							<tbody class="h6" >
							<?php $no=$num+1; foreach($wa as $s){?>
							<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $s->name ?></td>
									<td><?php echo $s->tujuan ?></td>
									<td><?php echo $s->pesan ?></td>
									<td><?php echo $s->tanggal ?></td>
									<td><?php if($s->proses==1){echo '<label class="btn btn-xs btn-success" type="label">Terkirim</label>';}else if ($s->proses==2){echo '<label class="btn btn-xs btn-danger" type="label">Gagal !</label>';} ?></td>
									<td><?php echo $s->group_name?></td>
									<td><?php echo $s->akses?></td>
									<?php echo'
									<td width="50"><a class="blue" href="'.base_url().'c_wa/hapus/'.$s->id.'" onclick="return confirm(\'Anda yakin menghapus daftar ini ?\')"  ><i class="fa fa-fw fa-trash-o"></i></a></td>
									';?>
								</tr>
							<?php $no++;}?>
							</tbody>
						</table>
					</div><?php echo $this->pagination->create_links();?>
				</div>
				
			</div>
<!--untuk memanggil js blink di asset-->						
<script src="<?php echo base_url();?>assets/blink/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url();?>assets/blink/js/smart.js"></script>
<style>
.pesan{
display: none;
width: 100%;
}
</style>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script>
	//angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
			$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
		setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
</script>

<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>
</div>


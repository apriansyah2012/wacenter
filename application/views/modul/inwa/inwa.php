<meta http-equiv="refresh" content="240" />
<meta http-equiv="refresh" content="600" >
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
					<th class="left" colspan="9">
					<form class="form-search" action="<?php echo base_url();?>c_inwa/cari" method=POST >
					<span class="input-icon">
					<input name="cari"type="text" placeholder="Pencarian......." class="nav-search-input" id="nav-search-input" autocomplete="off" />
						<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>
						
						<div class="widget-toolbar">
						
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
									  <th>Pengirim</th>
									  <th>Pesan</th>
									  <th>Waktu</th>
									  <th>User</th>
								</tr>
							</thead>
								
							<tbody class="h6" >
							<?php $no=$num+1; foreach($inwa as $s){?>
							<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $s->pengirim ?>
									<!-- Button trigger modal -->
									<?php if($s->sts_jawaban==0){?>
									<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#jawab_<?php echo $s->pengirim; ?>_<?php echo $s->id;?>" style="border-radius: 50px; background-color: #f00505; color: #ffffff; border: none;">
									  Jawab Pesan
									</button>
									<?php } else { ?>
									
									<?php echo '<label class="btn btn-sm btn-success" style="border-radius: 50px; background-color: #f00505; color: #ffffff; border: none;">Sudah dijawab</label>';?>
									
									<?php } ?>
									<!-- Modal -->
									<div class="modal fade" id="jawab_<?php echo $s->pengirim;?>_<?php echo $s->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									 <div class="modal-dialog modal-lg">
									    <div class="modal-content">
									      <div class="modal-header">
									      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									        <h5 class="modal-title" id="exampleModalLabel">Balas Pesan dari nomor <?php echo $s->pengirim;?></h5>
									        
									      </div>
									      	<?php echo form_open_multipart('c_inwa/balas/'.$s->pengirim.'/'.$s->id.''); ?>
									      <div class="modal-body">
									        
									        
									        <!--Form jawaban-->
									        		
										<div class="box-body table-responsive no-padding">
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
										
											<tr>
												<th><h5>Pesan Masuk</H5></th>
												<th><textarea  rows=10 cols="80%"><?php echo $s->pesan ?></textarea></th>
											</tr>
											<tr>
												<th><h5>Balas Pesan</H5></th>
												<th><textarea name="balas_pesan" rows=10 cols="80%"></textarea></th>
											</tr>
											
										</table>
									        </div>
									        
									        
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									        <button type="submit" class="btn btn-primary" >Kirim</button>
									      </div>
									      </form>
									    </div>
									  </div>
									</div>
									</td>
									<td><?php echo $s->pesan ?><br>
									<?php $result =$this->db->query("SELECT * FROM whatsapp_inbox WHERE whatsapp_inbox.status_topik=$s->id");
									$nom=1;
									foreach ($result->result_array() as $x){?>
									<?php echo $x['pesan'];?>
									
									<?php $nom ++;} ?>
									</td>
									<td><?php echo $s->tanggal ?></td>
									<td><?php echo $s->hp_user ?><br><?php echo $s->proses ?></td>
								</tr>
							<?php $no++;}?>
							</tbody>
						</table>
					</div><?php echo $this->pagination->create_links();?>
				</div>
				
			</div>
<!--untuk memanggil js blink di asset-->	
<script >
function cek_karakter(form) {
maks =1500; // max character
if (form.pesan.value.length >= maks) {
var message = "0 Character Left ! "; //alert if character limit reacher
alert(message);
form.pesan.value = form.pesan.value.substring(0, maks); //trim the textarea
}
else {
form.total.value = maks - form.pesan.value.length;} //count the character
}

</script>					
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
</div>

